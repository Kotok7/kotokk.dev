<?php
session_start();

$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['pl', 'en'], true) ? $_GET['lang'] : 'en';
$otherLang = $lang === 'pl' ? 'en' : 'pl';

define('DATA_FILE', __DIR__ . '/data/projects.json');
define('PHOTOS_DIR', __DIR__ . '/photos/');

initializeDirectories();

function initializeDirectories() {
    $dataDir = dirname(DATA_FILE);
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    if (!file_exists(DATA_FILE)) {
        file_put_contents(DATA_FILE, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    }
    
    if (!is_dir(PHOTOS_DIR)) {
        mkdir(PHOTOS_DIR, 0755, true);
    }
}

function getTranslations(): array {
    return [
        'en' => [
            'title' => 'Share sites',
            'meta' => 'Share interesting sites with other people or rate and explore other sites!',
            'translate' => 'Translate to Polish',
            'share_your_site' => 'Share interesting sites with others!',
            'site_title' => 'Site Title',
            'description' => 'Description',
            'url_placeholder' => 'URL (https://...)',
            'add_project' => 'Add',
            'added' => 'Added',
            'visit' => 'Visit',
            'terms_of_service' => 'Terms of Service',
            'accept_terms' => 'I accept the Terms of Service',
            'close' => 'Close',
            'terms_content' => 'By using this website you agree to the following terms:
1. You are responsible for the content you share
2. Do not share illegal, harmful, or inappropriate content
3. Respect intellectual property rights
4. I reserve the right to remove any content
5. Use this service at your own risk
6. I am not responsible for external links
7. This website was created to share other websites.
7.1. Do not share links to discord servers or files
8. These terms may change at any time',
            'error_required_fields' => 'All fields except photo are required and URL must be valid.',
            'error_accept_terms' => 'You must accept the Terms of Service.',
            'file_too_large' => 'Photo must be 2MB or smaller.',
            'invalid_image' => 'Uploaded file is not a valid image.',
            'invalid_extension' => 'Photo extension is not allowed.',
            'error_saving' => 'An error occurred while saving the data.',
        ],
        'pl' => [
            'title' => 'Udostępniaj strony',
            'meta' => 'Udostępniaj ciekawe strony internetowe z innymi ludźmi, oraz oceniaj i odkrywaj nowe strony internetowe!',
            'translate' => 'Przetłumacz na angielski',
            'share_your_site' => 'Udostępnij ciekawe strony z innymi!',
            'site_title' => 'Tytuł strony',
            'description' => 'Opis',
            'url_placeholder' => 'Adres URL (https://...)',
            'add_project' => 'Dodaj',
            'added' => 'Dodano',
            'visit' => 'Odwiedź',
            'terms_of_service' => 'Regulamin',
            'accept_terms' => 'Akceptuję Regulamin',
            'close' => 'Zamknij',
            'terms_content' => 'Korzystając z tej strony zgadzasz się na następujące warunki:
1. Jesteś odpowiedzialny za treści które udostępniasz
2. Nie udostępniaj nielegalnych, szkodliwych lub nieodpowiednich treści
3. Szanuj prawa autorskie
4. Zastrzegam sobie prawo do usunięcia dowolnych treści
5. Korzystasz z serwisu na własne ryzyko
6. Nie ponoszę odpowiedzialności za zewnętrzne linki
7. Ta strona została stworzona do udostępniania innych stron internetowych
7.1. Zakazuje się udostępniania linków do serverów discord i plików
8. Regulamin może ulec zmianie w dowolnym momencie',
            'error_required_fields' => 'Wszystkie pola oprócz zdjęcia są wymagane, a URL musi być poprawny.',
            'error_accept_terms' => 'Musisz zaakceptować Regulamin.',
            'file_too_large' => 'Zdjęcie musi mieć maksymalnie 2MB.',
            'invalid_image' => 'Przesłany plik nie jest obrazem.',
            'invalid_extension' => 'Rozszerzenie zdjęcia jest niedozwolone.',
            'error_saving' => 'Wystąpił błąd podczas zapisywania danych.',
        ],
    ];
}

function t(string $key, string $lang): string {
    $all = getTranslations();
    return $all[$lang][$key] ?? $key;
}

function handleVoteSubmission($lang) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        return;
    }
    
    $voteType = $_POST['vote_type'] ?? '';
    $voteId = $_POST['id'] ?? '';
    
    $json = @file_get_contents(DATA_FILE);
    $projects = json_decode($json, true);
    
    if (!is_array($projects)) {
        return;
    }
    
    if (!isset($_SESSION['votes'])) {
        $_SESSION['votes'] = [];
    }
    
    $existing = $_SESSION['votes'][$voteId] ?? null;
    
    foreach ($projects as &$p) {
        if (isset($p['id']) && $p['id'] === $voteId) {
            updateVotes($p, $voteType, $existing, $voteId);
            break;
        }
    }
    
    unset($p);
    file_put_contents(DATA_FILE, json_encode($projects, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    
    redirectToMain($lang);
}

function updateVotes(&$project, $voteType, $existing, $voteId) {
    if ($existing === null) {
        if ($voteType === 'up') {
            $project['upvotes'] = intval($project['upvotes'] ?? 0) + 1;
            $_SESSION['votes'][$voteId] = 'up';
        } elseif ($voteType === 'down') {
            $project['downvotes'] = intval($project['downvotes'] ?? 0) + 1;
            $_SESSION['votes'][$voteId] = 'down';
        }
    } elseif ($existing !== $voteType) {
        if ($voteType === 'up') {
            $project['upvotes'] = intval($project['upvotes'] ?? 0) + 1;
            $project['downvotes'] = max(0, intval($project['downvotes'] ?? 0) - 1);
            $_SESSION['votes'][$voteId] = 'up';
        } elseif ($voteType === 'down') {
            $project['downvotes'] = intval($project['downvotes'] ?? 0) + 1;
            $project['upvotes'] = max(0, intval($project['upvotes'] ?? 0) - 1);
            $_SESSION['votes'][$voteId] = 'down';
        }
    }
}

function handleProjectSubmission($lang) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        return 'error_required_fields';
    }
    
    if (!isset($_POST['accept_terms'])) {
        return 'error_accept_terms';
    }
    
    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $urlRaw = trim($_POST['url'] ?? '');
    
    $validationError = validateProjectData($title, $desc, $urlRaw);
    if ($validationError) {
        return $validationError;
    }
    
    $photoError = handlePhotoUpload($photoFilename);
    if ($photoError) {
        return $photoError;
    }
    
    $saveError = saveProject($title, $desc, $urlRaw, $photoFilename);
    if ($saveError) {
        return $saveError;
    }
    
    redirectToMain($lang);
    return '';
}

function validateProjectData($title, $desc, $urlRaw) {
    $urlValid = filter_var($urlRaw, FILTER_VALIDATE_URL) ?: '';
    $scheme = $urlValid ? strtolower(parse_url($urlValid, PHP_URL_SCHEME) ?? '') : '';
    
    if ($title === '' || $desc === '' || $urlValid === '' || !in_array($scheme, ['http', 'https'], true)) {
        return 'error_required_fields';
    }
    
    return null;
}

function handlePhotoUpload(&$photoFilename) {
    $photoFilename = '';
    
    if (empty($_FILES['photo']['name']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $tmp = $_FILES['photo']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $allowed = ['png', 'jpg', 'jpeg', 'gif'];
    
    if (!in_array($ext, $allowed, true)) {
        return 'invalid_extension';
    }
    
    $info = @getimagesize($tmp);
    if ($info === false) {
        return 'invalid_image';
    }
    
    if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
        return 'file_too_large';
    }
    
    $photoFilename = uniqid('img_', true) . '.' . $ext;
    if (!move_uploaded_file($tmp, PHOTOS_DIR . $photoFilename)) {
        error_log("Failed to move uploaded file");
        return 'invalid_image';
    }
    
    return null;
}

function saveProject($title, $desc, $url, $photoFilename) {
    $json = @file_get_contents(DATA_FILE);
    $projects = json_decode($json, true);
    
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($projects)) {
        $projects = [];
    }
    
    $newEntry = [
        'id' => uniqid('', true),
        'title' => htmlspecialchars($title, ENT_QUOTES),
        'description' => htmlspecialchars($desc, ENT_QUOTES),
        'url' => $url,
        'photo' => $photoFilename,
        'added' => date('Y-m-d'),
        'upvotes' => 0,
        'downvotes' => 0,
    ];
    
    array_unshift($projects, $newEntry);
    
    $written = file_put_contents(DATA_FILE, json_encode($projects, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    if ($written === false) {
        error_log("Failed to write to " . DATA_FILE);
        return 'error_saving';
    }
    
    return null;
}

function redirectToMain($lang) {
    $redirectUrl = basename(__FILE__) . '?lang=' . urlencode($lang);
    header('Location: ' . $redirectUrl);
    exit;
}

function loadAndPrepareProjects() {
    $json = @file_get_contents(DATA_FILE);
    $projects = json_decode($json, true);
    
    if (!is_array($projects)) {
        $projects = [];
    }
    
    $changed = false;
    foreach ($projects as &$p) {
        if (!isset($p['id'])) {
            $p['id'] = uniqid('', true);
            $p['upvotes'] = 0;
            $p['downvotes'] = 0;
            $changed = true;
        } else {
            if (!isset($p['upvotes'])) {
                $p['upvotes'] = 0;
                $changed = true;
            }
            if (!isset($p['downvotes'])) {
                $p['downvotes'] = 0;
                $changed = true;
            }
        }
    }
    
    unset($p);
    
    if ($changed) {
        file_put_contents(DATA_FILE, json_encode($projects, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    }
    
    usort($projects, function($a, $b) {
        return intval($b['upvotes'] ?? 0) <=> intval($a['upvotes'] ?? 0);
    });
    
    return $projects;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'vote') {
        handleVoteSubmission($lang);
    } else {
        $error = handleProjectSubmission($lang);
    }
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(16));
$projects = loadAndPrepareProjects();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Kotokk - <?= htmlspecialchars(t('title', $lang), ENT_QUOTES) ?></title>
    <link rel="stylesheet" href="styles.css">
    <meta name="description" content="<?= htmlspecialchars(t('meta', $lang), ENT_QUOTES) ?>">
    <link rel="icon" type="image/png" href="website-icon.png">
</head>
<body>
    <div class="lang-switch">
        <a href="?lang=<?= htmlspecialchars($otherLang, ENT_QUOTES) ?>">
            <img src="<?= $otherLang === 'pl' ? 'poland.png' : 'united-states.png' ?>"
                 alt="<?= htmlspecialchars(t('translate', $lang), ENT_QUOTES) ?>"
                 title="<?= htmlspecialchars(t('translate', $lang), ENT_QUOTES) ?>"
                 width="30" height="30" loading="lazy">
        </a>
    </div>
                             <button onclick="window.location.href='/index.php'" class="terms-btn" style="margin-left: 20px; margin-bottom: 20px;">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m12 19-7-7 7-7"/>
    <path d="M19 12H5"/>
  </svg>
Back to main page
</button>
    <div class="container">
        <header>
            <h1><?= htmlspecialchars(t('share_your_site', $lang), ENT_QUOTES) ?></h1>
            <button class="terms-btn" onclick="showTerms()"><?= htmlspecialchars(t('terms_of_service', $lang), ENT_QUOTES) ?></button>
        </header>

        <?php if ($error): ?>
            <div class="error-message">
                <?= htmlspecialchars(t($error, $lang), ENT_QUOTES) ?>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" class="project-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>">
            
            <div class="form-group">
                <input type="text" name="title" 
                       placeholder="<?= htmlspecialchars(t('site_title', $lang), ENT_QUOTES) ?>" 
                       required 
                       value="<?= htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES) ?>">
            </div>
            
            <div class="form-group">
                <textarea name="description" 
                          placeholder="<?= htmlspecialchars(t('description', $lang), ENT_QUOTES) ?>" 
                          rows="3" 
                          required><?= htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES) ?></textarea>
            </div>
            
            <div class="form-group">
                <input type="url" name="url" 
                       placeholder="<?= htmlspecialchars(t('url_placeholder', $lang), ENT_QUOTES) ?>" 
                       required 
                       value="<?= htmlspecialchars($_POST['url'] ?? '', ENT_QUOTES) ?>">
            </div>
            
            <div class="form-group">
                <input type="file" name="photo" accept="image/*" class="file-input">
            </div>
            
            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="accept_terms" required>
                    <?= htmlspecialchars(t('accept_terms', $lang), ENT_QUOTES) ?>
                </label>
            </div>
            
            <button type="submit" class="submit-btn"><?= htmlspecialchars(t('add_project', $lang), ENT_QUOTES) ?></button>
        </form>

        <div class="projects">
            <?php foreach ($projects as $p): ?>
                <div class="project-card">
                    <?php if (!empty($p['photo'])): ?>
                        <img src="photos/<?= htmlspecialchars($p['photo'], ENT_QUOTES) ?>" 
                             alt="" 
                             class="project-image" 
                             loading="lazy">
                    <?php endif; ?>
                    
                    <div class="project-badge">
                        <?= htmlspecialchars(t('added', $lang), ENT_QUOTES) ?>: <?= htmlspecialchars($p['added'], ENT_QUOTES) ?>
                    </div>
                    
                    <div class="project-content">
                        <h3><?= htmlspecialchars($p['title'], ENT_QUOTES) ?></h3>
                        <p><?= htmlspecialchars($p['description'], ENT_QUOTES) ?></p>
                                                <p class="project-url">
    <p href="<?= htmlspecialchars($p['url'], ENT_QUOTES) ?>"
       target="_blank"
       rel="noopener">
       <?= htmlspecialchars($p['url'], ENT_QUOTES) ?>
                    </p>
</p>
                        <a href="<?= htmlspecialchars($p['url'], ENT_QUOTES) ?>" 
                           class="project-link" 
                           target="_blank" 
                           rel="noopener"><?= htmlspecialchars(t('visit', $lang), ENT_QUOTES) ?></a>
                        <div class="votes">
                            <form method="post" class="vote-form">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>">
                                <input type="hidden" name="action" value="vote">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($p['id'], ENT_QUOTES) ?>">
                                <input type="hidden" name="vote_type" value="up">
                                <button type="submit" class="vote-btn upvote">
                                    👍 <?= intval($p['upvotes'] ?? 0) ?>
                                </button>
                            </form>
                            
                            <form method="post" class="vote-form">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>">
                                <input type="hidden" name="action" value="vote">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($p['id'], ENT_QUOTES) ?>">
                                <input type="hidden" name="vote_type" value="down">
                                <button type="submit" class="vote-btn downvote">
                                    👎 <?= intval($p['downvotes'] ?? 0) ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="hideTerms()">&times;</span>
            <h2><?= htmlspecialchars(t('terms_of_service', $lang), ENT_QUOTES) ?></h2>
            <div class="terms-text">
                <?= nl2br(htmlspecialchars(t('terms_content', $lang), ENT_QUOTES)) ?>
            </div>
            <button class="close-btn" onclick="hideTerms()"><?= htmlspecialchars(t('close', $lang), ENT_QUOTES) ?></button>
        </div>
    </div>

    <script>
        function showTerms() {
            document.getElementById('termsModal').style.display = 'block';
        }

        function hideTerms() {
            document.getElementById('termsModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('termsModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
