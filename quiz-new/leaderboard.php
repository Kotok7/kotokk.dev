<?php
require 'lib/utils.php';
$prog = file_exists('api/progress.json')
  ? json_decode(file_get_contents('api/progress.json'), true)
  : [];
$scores = [];
foreach ($prog as $p) {
  $quiz = array_values(array_filter(load_quizzes(), fn($q)=>$q['id']===$p['quiz_id']))[0] ?? null;
  if (!$quiz) continue;
  $correct = 0;
  foreach ($p['answers'] as $i=>$ans) {
    $type = $quiz['questions'][$i]['type'];
    if ($type==='text') {
      if (preg_match('/'.$quiz['questions'][$i]['answer'].'/i', $ans)) $correct++;
    } elseif ($type==='multiple') {
      $ansArr = array_map('intval', explode(',', $ans));
      if (array_diff($ansArr, $quiz['questions'][$i]['answer'])===array_diff($quiz['questions'][$i]['answer'],$ansArr))
        $correct++;
    } else {
      if ((int)$ans === $quiz['questions'][$i]['answer']) $correct++;
    }
  }
  $au = $p['author'];
  $scores[$au] = max($scores[$au] ?? 0, $correct);
}
arsort($scores);
?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Leaderboard</title><link rel="stylesheet" href="assets/styles.css">
</head><body>
<div class="container">
  <header><h1>Leaderboard</h1><a class="btn" href="index.php">Back</a></header>
  <ol>
    <?php foreach($scores as $u=>$s): ?>
      <li><?=htmlspecialchars($u)?> — <?= $s ?> pts</li>
    <?php endforeach; ?>
  </ol>
</div>
</body></html>