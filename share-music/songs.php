<?php
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit(0);
}

define('DATA_DIR', __DIR__ . '/data');
define('DATA_FILE', DATA_DIR . '/songs.json');
define('MAX_TITLE_LENGTH', 100);
define('MAX_AUTHOR_LENGTH', 100);
define('MAX_DESCRIPTION_LENGTH', 100);
define('MAX_SONGS_COUNT', 1000);

function initializeDataStructure(): void {
    if (!is_dir(DATA_DIR)) {
        if (!mkdir(DATA_DIR, 0755, true)) {
            throw new Exception('Cannot create data directory');
        }
    }
    if (!file_exists(DATA_FILE)) {
        $initialData = [];
        if (file_put_contents(DATA_FILE, json_encode($initialData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX) === false) {
            throw new Exception('Cannot create data file');
        }
    }
}

function loadSongs(): array {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $content = file_get_contents(DATA_FILE);
    if ($content === false) {
        throw new Exception('Cannot read data file');
    }
    $songs = json_decode($content, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('JSON parsing error: ' . json_last_error_msg());
    }
    return is_array($songs) ? $songs : [];
}

function saveSongs(array $songs): void {
    $json = json_encode($songs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        throw new Exception('JSON serialization error');
    }
    if (file_put_contents(DATA_FILE, $json, LOCK_EX) === false) {
        throw new Exception('Cannot save data');
    }
}

function validateAndSanitizeInput(array $data): array {
    $errors = [];

    $title = trim($data['title'] ?? '');
    if (empty($title)) {
        $errors[] = 'Title is required';
    } elseif (mb_strlen($title) > MAX_TITLE_LENGTH) {
        $errors[] = 'Title is too long (max ' . MAX_TITLE_LENGTH . ' characters)';
    }

    $author = trim($data['author'] ?? '');
    if (empty($author)) {
        $errors[] = 'Author is required';
    } elseif (mb_strlen($author) > MAX_AUTHOR_LENGTH) {
        $errors[] = 'Author name is too long (max ' . MAX_AUTHOR_LENGTH . ' characters)';
    }

    $description = trim($data['description'] ?? '');
    if (mb_strlen($description) > MAX_DESCRIPTION_LENGTH) {
        $errors[] = 'Description is too long (max ' . MAX_DESCRIPTION_LENGTH . ' characters)';
    }

    $link = trim($data['link'] ?? '');
    if (!empty($link) && !filter_var($link, FILTER_VALIDATE_URL)) {
        $errors[] = 'The provided link has an invalid format';
    }

    $cover = trim($data['cover'] ?? '');
    if (!empty($cover) && !filter_var($cover, FILTER_VALIDATE_URL)) {
        $errors[] = 'The provided cover URL has an invalid format';
    }

    if (!empty($errors)) {
        throw new InvalidArgumentException(implode(', ', $errors));
    }

    return [
        'title'       => htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        'author'      => htmlspecialchars($author, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        'description' => htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        'link'        => $link,
        'cover'       => $cover
    ];
}

function handleError(Exception $e, int $statusCode = 500): void {
    http_response_code($statusCode);
    $errorResponse = [
        'error'     => $e->getMessage(),
        'timestamp' => date('c')
    ];
    echo json_encode($errorResponse);
    error_log("Songs API Error: " . $e->getMessage());
}

try {
    initializeDataStructure();
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            echo json_encode(loadSongs());
            break;
        case 'POST':
            $input = file_get_contents('php://input');
            if ($input === false) {
                throw new Exception('Cannot read input data');
            }
            $data = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Invalid JSON format: ' . json_last_error_msg());
            }
            $validatedData = validateAndSanitizeInput($data);
            $songs = loadSongs();
            if (count($songs) >= MAX_SONGS_COUNT) {
                throw new Exception('Maximum number of songs reached (' . MAX_SONGS_COUNT . ')');
            }
            $newSong = [
                'id'              => uniqid('song_', true),
                'title'           => $validatedData['title'],
                'author'          => $validatedData['author'],
                'description'     => $validatedData['description'],
                'link'            => $validatedData['link'],
                'cover'           => $validatedData['cover'],
                'added'           => date('Y-m-d'),
                'added_timestamp' => time()
            ];
            array_unshift($songs, $newSong);
            saveSongs($songs);
            http_response_code(201);
            echo json_encode($songs);
            break;
        default:
            http_response_code(405);
            echo json_encode([
                'error'           => 'Method ' . $_SERVER['REQUEST_METHOD'] . ' is not supported',
                'allowed_methods' => ['GET', 'POST']
            ]);
            break;
    }
} catch (InvalidArgumentException $e) {
    handleError($e, 400);
} catch (Exception $e) {
    handleError($e, 500);
}
