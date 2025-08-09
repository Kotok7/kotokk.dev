<?php
require __DIR__ . '/functions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf'] ?? '';
    if (!validate_csrf($token)) {
        $message = 'Invalid CSRF token.';
    } else {
        $nick = trim((string)($_POST['nick'] ?? ''));
        $tagsRaw = trim((string)($_POST['tags'] ?? ''));
        $content = trim((string)($_POST['content'] ?? ''));
        if ($nick === '' || $content === '') {
            $message = 'Nick and Content are required.';
        } else {
            $tags = $tagsRaw === '' ? [] : explode(',', $tagsRaw);
            add_quote($nick, $tags, $content);
            header('Location: index.php?added=1');
            exit;
        }
    }
}
$token = csrf_token();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Add Quote</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="site-header">
  <h1>Add a New Quote</h1>
  <nav><a href="index.php">Home</a> · <a href="favorites.php">My Favorites</a></nav>
</header>

<main>
  <?php if ($message): ?>
    <div class="flash"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
  <?php endif; ?>
  <form method="post" action="add_quote.php" class="card form-card">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
    <label>
      Nick
      <input type="text" name="nick" required maxlength="80" autocomplete="off">
    </label>

    <label>
      Tags (comma-separated)
      <input type="text" name="tags" maxlength="200" placeholder="e.g. life,inspiration">
    </label>

    <label>
      Content
      <textarea name="content" rows="5" required maxlength="1000"></textarea>
    </label>

    <div class="form-actions">
      <button type="submit">Add Quote</button>
      <a class="button-link" href="index.php">Cancel</a>
    </div>
  </form>
</main>
</body>
</html>