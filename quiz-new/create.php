<?php require 'lib/utils.php'; ?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Create Quiz</title><link rel="stylesheet" href="assets/styles.css">
</head><body>
<div class="container">
  <header><h1>Create New Quiz</h1><a class="btn" href="index.php">Back</a></header>
  <form id="create-form">
    <div class="form-group"><label for="author">Your Name</label><input id="author" name="author" type="text" required></div>
    <div class="form-group"><label for="title">Title</label><input id="title" name="title" type="text" minlength="3" required></div>
    <div class="form-group"><label for="description">Description</label><textarea id="description" name="description" rows="2"></textarea></div>
    <div class="form-group"><label for="tags">Tags (comma‑separated)</label><input id="tags" name="tags" type="text"></div>
    <div id="questions"></div>
    <button type="button" id="add-q-btn" class="btn">Add Question</button>
    <button type="submit" class="btn">Save Quiz</button>
  </form>
</div>
<script defer src="assets/main.js"></script>
</body></html>