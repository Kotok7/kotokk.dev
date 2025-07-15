<?php
require 'lib/utils.php';
$all = load_quizzes();
$id = $_GET['id'] ?? '';
$quiz = array_values(array_filter($all, fn($q)=>$q['id']===$id))[0] ?? exit('Not found');
?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?=htmlspecialchars($quiz['title'])?></title><link rel="stylesheet" href="assets/styles.css">
</head><body>
<div class="container">
  <header>
    <h1><?=htmlspecialchars($quiz['title'])?></h1>
    <p>By <strong><?=htmlspecialchars($quiz['author'])?></strong></p>
    <div id="timer">Time left: <span id="time">05:00</span></div>
    <a class="btn" href="index.php">Back</a>
  </header>
  <form id="quiz-form">
    <?php foreach($quiz['questions'] as $i=>$q): ?>
      <div class="question-block" data-index="<?=$i?>">
        <h3><?=$i+1?>. <?=htmlspecialchars($q['question'])?></h3>
        <?php if($q['type']==='single'): ?>
          <?php foreach($q['options'] as $j=>$opt): ?>
            <label><input type="radio" name="q<?=$i?>" value="<?=$j?>"><?=$opt?></label><br>
          <?php endforeach;?>
        <?php elseif($q['type']==='multiple'): ?>
          <?php foreach($q['options'] as $j=>$opt): ?>
            <label><input type="checkbox" name="q<?=$i?>" value="<?=$j?>"><?=$opt?></label><br>
          <?php endforeach;?>
        <?php else: ?>
          <input type="text" name="q<?=$i?>" placeholder="Your answer"><br>
        <?php endif;?>
        <button type="button" class="btn flag-btn">Flag</button>
      </div>
    <?php endforeach;?>
    <button class="btn" type="submit">Submit</button>
  </form>
  <div id="result"></div>
</div>
<script defer src="assets/main.js"></script>
</body></html>