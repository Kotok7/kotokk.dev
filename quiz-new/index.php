<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'lib/utils.php';

$all = load_quizzes();
if (!is_array($all)) {
    $all = [];
}

$tags = [];
foreach ($all as $q) {
    if (!empty($q['tags']) && is_array($q['tags'])) {
        $tags = array_merge($tags, $q['tags']);
    }
}
$tags = array_unique($tags);

$filter = $_GET['tag'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>QuizHub</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<div class="container">

  <header>
    <h1>QuizHub</h1>
    <a class="btn" href="create.php">Create Quiz</a>
    <a class="btn" href="leaderboard.php">Leaderboard</a>
  </header>

  <div class="form-group">
    <label for="tag-filter">Filter by Tag:</label>
    <select id="tag-filter" onchange="location.href='?tag='+encodeURIComponent(this.value)">
      <option value="">— all —</option>
      <?php foreach ($tags as $t): ?>
        <option value="<?=htmlspecialchars($t)?>" <?= $t === $filter ? 'selected' : '' ?>>
          <?=htmlspecialchars($t)?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="quiz-grid">
    <?php
      $found = false;
      foreach ($all as $q) {
        if ($filter && (!isset($q['tags']) || !in_array($filter, $q['tags']))) {
          continue;
        }
        $found = true;
    ?>
      <div class="quiz-card">
        <h2><?=htmlspecialchars($q['title'])?></h2>
        <p>By <strong><?=htmlspecialchars($q['author'])?></strong>
           on <?=date('Y-m-d', strtotime($q['created_at']))?></p>
        <?php if (!empty($q['tags'])): ?>
          <p>Tags: <?=implode(', ', array_map('htmlspecialchars', $q['tags']))?></p>
        <?php endif; ?>
        <a class="btn" href="quiz.php?id=<?=urlencode($q['id'])?>">Take Quiz</a>
        <a class="btn" href="edit.php?id=<?=urlencode($q['id'])?>">Edit</a>
        <a class="btn" href="delete.php?id=<?=urlencode($q['id'])?>&amp;author=<?=urlencode($q['author'])?>"
           onclick="return confirm('Delete this quiz?')">Delete</a>
      </div>
    <?php } ?>

    <?php if (!$found): ?>
      <p>No quizzes found<?= $filter ? " for tag “{$filter}”" : "" ?>.</p>
    <?php endif; ?>
  </div>

</div>
</body>
</html>