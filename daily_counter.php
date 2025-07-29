<?php
$jsonFile = __DIR__ . '/daily.json';
$tz       = new DateTimeZone('Europe/Warsaw');
$today    = (new DateTime('now', $tz))->format('Y-m-d');

if (!file_exists($jsonFile)) {
    file_put_contents($jsonFile, json_encode([
        'date'   => $today,
        'visits' => 0,
        'ips'    => []
    ], JSON_PRETTY_PRINT));
}

$data = json_decode(file_get_contents($jsonFile), true);
if (!is_array($data) ||
    !isset($data['date'], $data['visits'], $data['ips']) ||
    !is_array($data['ips'])
) {
    $data = [
        'date'   => $today,
        'visits' => 0,
        'ips'    => []
    ];
}

if ($data['date'] !== $today) {
    $data = [
        'date'   => $today,
        'visits' => 0,
        'ips'    => []
    ];
}

$ip = $_SERVER['REMOTE_ADDR'] ?? '';

if ($ip !== '' && !in_array($ip, $data['ips'], true)) {
    $data['ips'][]  = $ip;
    $data['visits'] = $data['visits'] + 1;
}

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

return [
    'dailyVisits'    => $data['visits'],
    'isFirstVisitor' => ($data['visits'] === 1)
];
