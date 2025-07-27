<?php

$jsonFile = __DIR__ . '/daily.json';
$today    = (new DateTime('now', new DateTimeZone('Europe/Warsaw')))->format('Y-m-d');

if (!file_exists($jsonFile)) {
    file_put_contents($jsonFile, json_encode(['date'=>$today,'visits'=>0], JSON_PRETTY_PRINT));
}

$data = json_decode(file_get_contents($jsonFile), true);
if ($data['date'] !== $today) {
    $data['date']   = $today;
    $data['visits'] = 0;
}

$data['visits']++;
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

$dailyVisits     = $data['visits'];
$isFirstVisitor  = ($dailyVisits === 1);

return compact('dailyVisits','isFirstVisitor');
