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
define('MAX_NICKNAME_LENGTH', 50);
define('MAX_SONGS_COUNT', 1000);
function initializeDataStructure(): void {
    if (!is_dir(DATA_DIR)) mkdir(DATA_DIR, 0755, true);
    if (!file_exists(DATA_FILE)) file_put_contents(DATA_FILE, json_encode([], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function loadSongs(): array {
    $content = file_get_contents(DATA_FILE);
    $songs = json_decode($content, true);
    return is_array($songs) ? $songs : [];
}
function saveSongs(array $songs): void {
    file_put_contents(DATA_FILE, json_encode($songs, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function validateAndSanitizeInput(array $data): array {
    $errors = [];
    $title = trim($data['title'] ?? '');
    if ($title === '') $errors[] = 'Title is required';
    elseif (mb_strlen($title) > MAX_TITLE_LENGTH) $errors[] = 'Title too long';
    $author = trim($data['author'] ?? '');
    if ($author === '') $errors[] = 'Author is required';
    elseif (mb_strlen($author) > MAX_AUTHOR_LENGTH) $errors[] = 'Author too long';
    $description = trim($data['description'] ?? '');
    if (mb_strlen($description) > MAX_DESCRIPTION_LENGTH) $errors[] = 'Description too long';
    $link = trim($data['link'] ?? '');
    if ($link !== '' && !filter_var($link, FILTER_VALIDATE_URL)) $errors[] = 'Invalid song link';
    $cover = trim($data['cover'] ?? '');
    if ($cover !== '' && !filter_var($cover, FILTER_VALIDATE_URL)) $errors[] = 'Invalid cover URL';
    $nickname = trim($data['nickname'] ?? '');
    if ($nickname === '') $errors[] = 'Nickname is required';
    elseif (mb_strlen($nickname) > MAX_NICKNAME_LENGTH) $errors[] = 'Nickname too long';
    if ($errors) throw new InvalidArgumentException(implode(', ', $errors));
    return [
        'title'       => htmlspecialchars($title, ENT_QUOTES|ENT_HTML5, 'UTF-8'),
        'author'      => htmlspecialchars($author, ENT_QUOTES|ENT_HTML5, 'UTF-8'),
        'description' => htmlspecialchars($description, ENT_QUOTES|ENT_HTML5, 'UTF-8'),
        'link'        => $link,
        'cover'       => $cover,
        'nickname'    => htmlspecialchars($nickname, ENT_QUOTES|ENT_HTML5, 'UTF-8'),
    ];
}
function handleError(Exception $e, int $statusCode = 500): void {
    http_response_code($statusCode);
    echo json_encode(['error'=>$e->getMessage(),'timestamp'=>date('c')]);
    exit;
}
try {
    initializeDataStructure();
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            echo json_encode(loadSongs());
            break;
        case 'POST':
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) throw new InvalidArgumentException('Invalid JSON');
            if (isset($data['id'], $data['rating'])) {
                $songs = loadSongs();
                foreach ($songs as &$song) {
                    if ($song['id'] === $data['id']) {
                        $r = (int)$data['rating'];
                        if ($r < 1 || $r > 5) throw new InvalidArgumentException('Invalid rating');
                        if (!isset($song['ratings']) || !is_array($song['ratings'])) $song['ratings'] = [];
                        $song['ratings'][] = $r;
                    }
                }
                saveSongs($songs);
                echo json_encode($songs);
                break;
            }
            $v = validateAndSanitizeInput($data);
            $songs = loadSongs();
            if (count($songs) >= MAX_SONGS_COUNT) throw new Exception('Maximum number of songs reached');
            $newSong = [
                'id'               => uniqid('song_', true),
                'title'            => $v['title'],
                'author'           => $v['author'],
                'description'      => $v['description'],
                'link'             => $v['link'],
                'cover'            => $v['cover'],
                'nickname'         => $v['nickname'],
                'ratings'          => [],
                'added'            => date('Y-m-d'),
                'added_timestamp'  => time()
            ];
            array_unshift($songs, $newSong);
            saveSongs($songs);
            http_response_code(201);
            echo json_encode($songs);
            break;
        default:
            http_response_code(405);
            echo json_encode(['error'=>'Method not allowed']);
            break;
    }
} catch (InvalidArgumentException $e) {
    handleError($e, 400);
} catch (Exception $e) {
    handleError($e, 500);
}
