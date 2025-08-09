<?php
require __DIR__ . '/functions.php';

$lang = (string)($_GET['lang'] ?? 'en');
$lang = in_array($lang, ['en', 'pl'], true) ? $lang : 'en';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'toggle_save') {
    $token = $_POST['csrf'] ?? '';
    if (validate_csrf($token)) {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) toggle_favorite($id);
    }
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? ('favorites.php?lang=' . urlencode($lang))));
    exit;
}

$all = load_quotes();
$favIds = get_favorites();
$favs = array_values(array_filter($all, fn($q)=>in_array($q['id'] ?? 0, $favIds, true)));
usort($favs, fn($a,$b)=>strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
$token = csrf_token();

$tz = $_COOKIE['tz'] ?? ($_GET['tz'] ?? 'UTC');
if (!in_array($tz, timezone_identifiers_list(), true)) $tz = 'UTC';
?>
<!doctype html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars(t('favorites_title', $lang), ENT_QUOTES, 'UTF-8') ?></title>
<link rel="stylesheet" href="styles.css">
<link rel="icon" type="image/png" href="photos/website-icon.png" />
</head>
<body>
<header class="site-header">
  <h1><?= htmlspecialchars(t('favorites_title', $lang), ENT_QUOTES, 'UTF-8') ?></h1>
  <nav><a href="index.php?lang=<?= urlencode($lang) ?>"><?= htmlspecialchars(t('header_h1', $lang), ENT_QUOTES, 'UTF-8') ?></a> · <a href="add_quote.php?lang=<?= urlencode($lang) ?>"><?= htmlspecialchars(t('nav_add', $lang), ENT_QUOTES, 'UTF-8') ?></a></nav>
</header>

<main>
  <?php if (empty($favs)): ?>
    <div class="card empty"><?= htmlspecialchars(t('favorites_none', $lang), ENT_QUOTES, 'UTF-8') ?></div>
  <?php else: ?>
    <ul class="quotes-list">
      <?php foreach ($favs as $q): ?>
        <li class="quote-card">
          <blockquote><?= nl2br(htmlspecialchars(get_translated($q['content'] ?? '', $lang), ENT_QUOTES, 'UTF-8')) ?></blockquote>
          <div class="meta">
            <span class="nick">— <?= htmlspecialchars(get_translated($q['nick'] ?? '', $lang), ENT_QUOTES, 'UTF-8') ?></span>
            <span class="date"><?= htmlspecialchars(format_datetime_for_tz($q['created_at'] ?? '', $tz), ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="tags">
            <?php foreach ($q['tags'] ?? [] as $t): ?>
              <a class="tag-pill small" href="index.php?tag=<?= urlencode($t) ?>&lang=<?= urlencode($lang) ?>"><?= htmlspecialchars($t, ENT_QUOTES, 'UTF-8') ?></a>
            <?php endforeach; ?>
          </div>
          <div class="actions">
            <form method="post" action="favorites.php" class="inline-form">
              <input type="hidden" name="csrf" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
              <input type="hidden" name="action" value="toggle_save">
              <input type="hidden" name="id" value="<?= (int)$q['id'] ?>">
              <input type="hidden" name="lang" value="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>">
              <button type="submit" class="save-btn"><?= htmlspecialchars(t('unsave', $lang), ENT_QUOTES, 'UTF-8') ?></button>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</main>
<script>
if(!document.cookie.match(/(^|;\s*)tz=/)){try{var tz=Intl.DateTimeFormat().resolvedOptions().timeZone;document.cookie='tz='+encodeURIComponent(tz)+';path=/';location.reload()}catch(e){}}
</script>
</body>
</html>
