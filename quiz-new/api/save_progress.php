<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$file = __DIR__ . '/progress.json';
$all = file_exists($file)
    ? json_decode(file_get_contents($file), true)
    : [];
$all[] = [
    'author'    => $data['author'] ?? 'anonymous',
    'quiz_id'   => $data['quiz_id']   ?? '',
    'answers'   => $data['answers']   ?? [],
    'timestamp' => date('c')
];
file_put_contents($file, json_encode($all, JSON_PRETTY_PRINT));
echo json_encode(['status'=>'ok']);