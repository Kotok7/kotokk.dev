<?php
require __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'toggle_save') {
    $token = $_POST['csrf'] ?? '';
    if (validate_csrf($token)) {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) toggle_favorite($id);
    }
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'favorites.php'));
    exit;
}

$all = load_quotes();
$favIds = get_favorites();
$favs = array_values(array_filter($all, fn($q)=>in_array($q['id'] ?? 0, $favIds, true)));
usort($favs, fn($a,$b)=>strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
$token = csrf_token();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>My Favorite Quotes</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="site-header">
  <h1>My Favorites</h1>
  <nav><a href="index.php">Home</a> · <a href="add_quote.php">Add Quote</a></nav>
</header>

<main>
  <?php if (empty($favs)): ?>
    <div class="card empty">You haven't saved any quotes yet.</div>
  <?php else: ?>
    <ul class="quotes-list">
      <?php foreach ($favs as $q): ?>
        <li class="quote-card">
          <blockquote><?= nl2br(htmlspecialchars($q['content'], ENT_QUOTES, 'UTF-8')) ?></blockquote>
          <div class="meta">
            <span class="nick">— <?= htmlspecialchars($q['nick'], ENT_QUOTES, 'UTF-8') ?></span>
            <span class="date"><?= htmlspecialchars(date('Y-m-d H:i', strtotime($q['created_at'] ?? '')), ENT_QUOTES, 'UTF-8') ?></span>
          </div>
          <div class="tags">
            <?php foreach ($q['tags'] ?? [] as $t): ?>
              <a class="tag-pill small" href="index.php?tag=<?= urlencode($t) ?>"><?= htmlspecialchars($t, ENT_QUOTES, 'UTF-8') ?></a>
            <?php endforeach; ?>
          </div>
          <div class="actions">
            <form method="post" action="favorites.php" class="inline-form">
              <input type="hidden" name="csrf" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
              <input type="hidden" name="action" value="toggle_save">
              <input type="hidden" name="id" value="<?= (int)$q['id'] ?>">
              <button type="submit" class="save-btn">Unsave</button>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</main>
</body>
</html>