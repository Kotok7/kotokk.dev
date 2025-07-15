<?php
function load_quizzes(): array {
  $f = __DIR__ . '/../api/quizzes.json';
  return file_exists($f)
    ? json_decode(file_get_contents($f), true)['quizzes']
    : [];
}

function save_quizzes(array $q): bool {
  $f = __DIR__ . '/../api/quizzes.json';
  return file_put_contents($f, json_encode(['quizzes'=>$q], JSON_PRETTY_PRINT)) !== false;
}

function generate_uuid(): string {
  return sprintf(
    '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    random_int(0, 0xffff), random_int(0, 0xffff),
    random_int(0, 0xffff),
    random_int(0, 0x0fff) | 0x4000,
    random_int(0, 0x3fff) | 0x8000,
    random_int(0, 0xffff), random_int(0, 0xffff), random_int(0, 0xffff)
  );
}

function sanitize(string $s): string {
  return htmlspecialchars(trim($s), ENT_QUOTES, 'UTF-8');
}