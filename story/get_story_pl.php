<?php
header('Content-Type: application/json; charset=utf-8');
$storyFile = __DIR__ . '/story-pl.json';
if (!file_exists($storyFile)) {
    file_put_contents($storyFile, json_encode(['sentences' => []], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
echo file_get_contents($storyFile);