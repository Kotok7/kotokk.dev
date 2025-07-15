<?php
require __DIR__ . '/../lib/utils.php';
header('Content-Type: application/json');
echo json_encode(['quizzes' => load_quizzes()]);