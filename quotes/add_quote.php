<?php
require __DIR__ . '/functions.php';

$lang = (string)($_GET['lang'] ?? 'en');
$lang = in_array($lang, ['en', 'pl'], true) ? $lang : 'en';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf'] ?? '';
    if (!validate_csrf($token)) {
        $message = t('invalid_csrf', $lang);
    } else {
        $nick = trim((string)($_POST['nick'] ?? ''));
        $tagsRaw = trim((string)($_POST['tags'] ?? ''));
        $content = trim((string)($_POST['content'] ?? ''));
        if ($nick === '' || $content === '') {
            $message = t('required_fields', $lang);
        } else {
            $tags = $tagsRaw === '' ? [] : explode(',', $tagsRaw);
            add_quote($nick, $tags, $content, $lang);
            header('Location: index.php?added=1&lang=' . urlencode($lang));
            exit;
        }
    }
}
$token = csrf_token();
?>
<!doctype html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars(t('add_title', $lang), ENT_QUOTES, 'UTF-8') ?></title>
<link rel="stylesheet" href="styles.css">
<link rel="icon" type="image/png" href="photos/website-icon.png" />
</head>
<body>
<header class="site-header">
  <h1><?= htmlspecialchars(t('add_h1', $lang), ENT_QUOTES, 'UTF-8') ?></h1>
  <nav><a href="index.php?lang=<?= urlencode($lang) ?>"><?= htmlspecialchars(t('header_h1', $lang), ENT_QUOTES, 'UTF-8') ?></a> · <a href="favorites.php?lang=<?= urlencode($lang) ?>"><?= htmlspecialchars(t('nav_favs', $lang), ENT_QUOTES, 'UTF-8') ?></a></nav>
</header>

<main>
  <?php if ($message): ?>
    <div class="flash"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
  <?php endif; ?>
  <form method="post" action="add_quote.php?lang=<?= urlencode($lang) ?>" class="card form-card">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
    <label>
      <?= htmlspecialchars(t('nick_label', $lang), ENT_QUOTES, 'UTF-8') ?>
      <input type="text" name="nick" required maxlength="80" autocomplete="off">
    </label>

    <label>
      <?= htmlspecialchars(t('tags_label', $lang), ENT_QUOTES, 'UTF-8') ?>
      <input type="text" name="tags" maxlength="200" placeholder="<?= htmlspecialchars(t('tags_placeholder', $lang), ENT_QUOTES, 'UTF-8') ?>">
    </label>

    <label>
      <?= htmlspecialchars(t('content_label', $lang), ENT_QUOTES, 'UTF-8') ?>
      <textarea name="content" rows="5" required maxlength="1000"></textarea>
    </label>

    <div class="form-actions">
      <button type="submit"><?= htmlspecialchars(t('add_button', $lang), ENT_QUOTES, 'UTF-8') ?></button>
      <a class="button-link" href="index.php?lang=<?= urlencode($lang) ?>"><?= htmlspecialchars(t('cancel', $lang), ENT_QUOTES, 'UTF-8') ?></a>
    </div>
  </form>
</main>
<script>
if(!document.cookie.match(/(^|;\s*)tz=/)){try{var tz=Intl.DateTimeFormat().resolvedOptions().timeZone;document.cookie='tz='+encodeURIComponent(tz)+';path=/';location.reload()}catch(e){}}
</script>
</body>
</html>
