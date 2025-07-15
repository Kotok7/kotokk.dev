<?php
require 'lib/utils.php';
$id = $_GET['id'] ?? '';
$all = load_quizzes();
foreach ($all as $k=>$q) {
  if ($q['id']===$id && $q['author']===$_GET['author']) {
    array_splice($all,$k,1);
    save_quizzes($all);
    break;
  }
}
header('Location: index.php');