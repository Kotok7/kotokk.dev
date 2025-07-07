<?php
date_default_timezone_set('Europe/Warsaw');
header('Content-Type: application/json; charset=UTF-8');

$msgFile = __DIR__ . '/messages/messages-pl.json';
if (!file_exists($msgFile)) {
    echo json_encode([]);
    exit;
}

$messages = json_decode(file_get_contents($msgFile), true) ?: [];
usort($messages, function($a, $b){
    return $a['id'] <=> $b['id'];
});
echo json_encode($messages);