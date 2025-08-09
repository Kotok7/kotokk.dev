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
    $redirect = $_SERVER['HTTP_REFERER'] ?? ('index.php?lang=' . urlencode($lang));
    header('Location: ' . $redirect);
    exit;
}

$allQuotes = load_quotes();

$filterTag = trim((string)($_GET['tag'] ?? ''));
$query = trim((string)($_GET['q'] ?? ''));

$quotes = array_filter($allQuotes, function($q) use ($filterTag, $query) {
    if ($filterTag !== '') {
        if (!in_array($filterTag, $q['tags'] ?? [], true)) return false;
    }
    if ($query !== '') {
        $hay = mb_strtolower((is_array($q['content']) ? implode(' ', $q['content']) : $q['content']) . ' ' . (is_array($q['nick']) ? implode(' ', $q['nick']) : $q['nick']) . ' ' . implode(' ', $q['tags'] ?? []), 'UTF-8');
        if (mb_strpos($hay, mb_strtolower($query, 'UTF-8')) === false) return false;
    }
    return true;
});

usort($quotes, fn($a,$b)=>strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));

$favs = get_favorites();
$token = csrf_token();
$allTags = [];
foreach ($allQuotes as $q) {
    foreach ($q['tags'] ?? [] as $t) $allTags[$t] = ($allTags[$t] ?? 0) + 1;
}
arsort($allTags);

$tz = $_COOKIE['tz'] ?? ($_GET['tz'] ?? 'UTC');
if (!in_array($tz, timezone_identifiers_list(), true)) $tz = 'UTC';
?>
<!doctype html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars(t('title', $lang), ENT_QUOTES, 'UTF-8') ?></title>
<link rel="stylesheet" href="styles.css">
<meta name="description" content="<?= htmlspecialchars(t('meta_description', $lang), ENT_QUOTES, 'UTF-8') ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="icon" type="image/png" href="photos/website-icon.png" />
</head>
<body>
<header class="site-header">
  <h1><?= htmlspecialchars(t('header_h1', $lang), ENT_QUOTES, 'UTF-8') ?></h1>
  <nav>
    <a href="<?= htmlspecialchars('add_quote.php?lang=' . urlencode($lang), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(t('nav_add', $lang), ENT_QUOTES, 'UTF-8') ?></a> ·
    <a href="<?= htmlspecialchars('favorites.php?lang=' . urlencode($lang), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(t('nav_favs', $lang), ENT_QUOTES, 'UTF-8') ?></a>
    <span class="lang-switch" style="margin-left:1rem">
      <a href="<?= htmlspecialchars((($_SERVER['PHP_SELF'] ?? 'index.php') . '?' . http_build_query(array_merge($_GET, ['lang' => $lang === 'en' ? 'pl' : 'en']))), ENT_QUOTES, 'UTF-8') ?>" class="lang-btn"><?= htmlspecialchars(t('lang_switch', $lang), ENT_QUOTES, 'UTF-8') ?></a>
    </span>
  </nav>
</header>

<main>
  <form method="get" action="index.php" class="search-form card">
    <input type="hidden" name="lang" value="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="q" placeholder="<?= htmlspecialchars(t('search_placeholder', $lang), ENT_QUOTES, 'UTF-8') ?>" value="<?= htmlspecialchars($query, ENT_QUOTES, 'UTF-8') ?>">
    <button type="submit"><?= htmlspecialchars(t('search_btn', $lang), ENT_QUOTES, 'UTF-8') ?></button>
    <?php if ($filterTag): ?>
      <a class="clear" href="index.php?lang=<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(t('clear_tag_filter', $lang), ENT_QUOTES, 'UTF-8') ?></a>
    <?php endif; ?>
  </form>

  <?php if (!empty($allTags)): ?>
    <section class="tags-bar card">
      <?php foreach ($allTags as $tag => $count): ?>
        <a class="tag-pill<?= $filterTag === $tag ? ' active' : '' ?>" href="?tag=<?= urlencode($tag) ?>&lang=<?= urlencode($lang) ?>"><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?> <span class="tag-count"><?= $count ?></span></a>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>

  <?php if (empty($quotes)): ?>
    <div class="card empty"><?= htmlspecialchars(t('no_quotes', $lang), ENT_QUOTES, 'UTF-8') ?></div>
  <?php else: ?>
    <ul class="quotes-list">
      <?php foreach ($quotes as $q): ?>
        <li class="quote-card">
          <blockquote><?= nl2br(htmlspecialchars(get_translated($q['content'] ?? '', $lang), ENT_QUOTES, 'UTF-8')) ?></blockquote>
          <div class="meta">
            <span class="nick">— <?= htmlspecialchars(get_translated($q['nick'] ?? '', $lang), ENT_QUOTES, 'UTF-8') ?></span>
            <span class="date"><?= htmlspecialchars(format_datetime_for_tz($q['created_at'] ?? '', $tz), ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="tags">
            <?php foreach ($q['tags'] ?? [] as $t): ?>
              <a class="tag-pill small" href="?tag=<?= urlencode($t) ?>&lang=<?= urlencode($lang) ?>"><?= htmlspecialchars($t, ENT_QUOTES, 'UTF-8') ?></a>
            <?php endforeach; ?>
          </div>
          <div class="actions">
            <form method="post" action="index.php" class="inline-form">
              <input type="hidden" name="csrf" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
              <input type="hidden" name="action" value="toggle_save">
              <input type="hidden" name="id" value="<?= (int)$q['id'] ?>">
              <input type="hidden" name="lang" value="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>">
              <button type="submit" class="save-btn"><?= in_array($q['id'], $favs, true) ? htmlspecialchars(t('unsave', $lang), ENT_QUOTES, 'UTF-8') : htmlspecialchars(t('save', $lang), ENT_QUOTES, 'UTF-8') ?></button>
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
<script src="popup.js"></script>
</body>
</html>
