<?php
require 'lib/utils.php';
$all = load_quizzes();
$id = $_GET['id'] ?? '';
$quiz = array_values(array_filter($all, fn($q)=>$q['id']===$id))[0] ?? exit('Not found');
?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Quiz</title><link rel="stylesheet" href="assets/styles.css">
</head><body>
<div class="container">
  <header><h1>Edit Quiz</h1><a class="btn" href="index.php">Back</a></header>
  <form method="post" action="api/save_quiz.php?id=<?=$quiz['id']?>">
    <div class="form-group"><label>Your Name</label><input type="text" value="<?=htmlspecialchars($quiz['author'])?>" readonly></div>
    <div class="form-group"><label>Title</label><input name="title" type="text" value="<?=htmlspecialchars($quiz['title'])?>" required></div>
    <div class="form-group"><label>Description</label><textarea name="description" rows="2"><?=htmlspecialchars($quiz['description'])?></textarea></div>
    <div class="form-group"><label>Tags</label><input name="tags" type="text" value="<?=implode(', ',$quiz['tags'])?>"></div>
    <?php foreach($quiz['questions'] as $i=>$q): ?>
      <div class="question-block">
        <h3>Question <?=($i+1)?></h3>
        <div class="form-group"><label>Type</label>
          <select name="q<?=$i?>_type">
            <option <?= $q['type']==='single'?'selected':''?> value="single">Single</option>
            <option <?= $q['type']==='multiple'?'selected':''?> value="multiple">Multiple</option>
            <option <?= $q['type']==='text'?'selected':''?> value="text">Text</option>
          </select>
        </div>
        <div class="form-group"><input name="q<?=$i?>_text" type="text" value="<?=htmlspecialchars($q['question'])?>" required></div>
        <?php if($q['type']!=='text'): foreach($q['options'] as $j=>$opt): ?>
          <div class="form-group"><input name="q<?=$i?>_opt<?=$j?>" type="text" value="<?=htmlspecialchars($opt)?>" required></div>
        <?php endforeach; endif; ?>
        <?php if($q['type']!=='text'): ?>
          <div class="form-group"><label>Correct <?= $q['type']==='multiple'?'Indices (comma)':'Index (0-'.(count($q['options'])-1).')'?></label>
            <input name="q<?=$i?>_answer" type="text" value="<?=is_array($q['answer'])?implode(',',$q['answer']):$q['answer']?>" required>
          </div>
        <?php else: ?>
          <div class="form-group"><label>Answer Regex</label><input name="q<?=$i?>_answer" type="text" value="<?=htmlspecialchars($q['answer'])?>" required></div>
        <?php endif;?>
      </div>
    <?php endforeach;?>
    <button class="btn" type="submit">Save Changes</button>
  </form>
</div>
</body></html>