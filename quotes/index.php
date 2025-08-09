<?php
require __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'toggle_save') {
    $token = $_POST['csrf'] ?? '';
    if (validate_csrf($token)) {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) toggle_favorite($id);
    }
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
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
        $hay = mb_strtolower($q['content'] . ' ' . $q['nick'] . ' ' . implode(' ', $q['tags']), 'UTF-8');
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
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Kotokk - Discover and add quotes</title>
<link rel="stylesheet" href="styles.css">
<meta name="description" content="Add, discover, view and save quotes!" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="icon" type="image/png" href="photos/website-icon.jpg" />
</head>
<body>
<header class="site-header">
  <h1>Discover Quotes</h1>
  <nav><a href="add_quote.php">Add Quote</a> · <a href="favorites.php">My Favorites</a></nav>
</header>

<main>
  <form method="get" action="index.php" class="search-form card">
    <input type="text" name="q" placeholder="Search quotes, nicks or tags" value="<?= htmlspecialchars($query, ENT_QUOTES, 'UTF-8') ?>">
    <button type="submit">Search</button>
    <?php if ($filterTag): ?>
      <a class="clear" href="index.php">Clear tag filter</a>
    <?php endif; ?>
  </form>

  <?php if (!empty($allTags)): ?>
    <section class="tags-bar card">
      <?php foreach ($allTags as $tag => $count): ?>
        <a class="tag-pill<?= $filterTag === $tag ? ' active' : '' ?>" href="?tag=<?= urlencode($tag) ?>"><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?> <span class="tag-count"><?= $count ?></span></a>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>

  <?php if (empty($quotes)): ?>
    <div class="card empty">No quotes found.</div>
  <?php else: ?>
    <ul class="quotes-list">
      <?php foreach ($quotes as $q): ?>
        <li class="quote-card">
          <blockquote><?= nl2br(htmlspecialchars($q['content'], ENT_QUOTES, 'UTF-8')) ?></blockquote>
          <div class="meta">
            <span class="nick">— <?= htmlspecialchars($q['nick'], ENT_QUOTES, 'UTF-8') ?></span>
            <span class="date"><?= htmlspecialchars(date('Y-m-d H:i', strtotime($q['created_at'] ?? '')), ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="tags">
            <?php foreach ($q['tags'] ?? [] as $t): ?>
              <a class="tag-pill small" href="?tag=<?= urlencode($t) ?>"><?= htmlspecialchars($t, ENT_QUOTES, 'UTF-8') ?></a>
            <?php endforeach; ?>
          </div>
          <div class="actions">
            <form method="post" action="index.php" class="inline-form">
              <input type="hidden" name="csrf" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
              <input type="hidden" name="action" value="toggle_save">
              <input type="hidden" name="id" value="<?= (int)$q['id'] ?>">
              <button type="submit" class="save-btn"><?= in_array($q['id'], $favs, true) ? 'Unsave' : 'Save' ?></button>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</main>
</body>
</html>