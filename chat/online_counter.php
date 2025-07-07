<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
$filename = __DIR__ . '/online_users.json';
$timeout = 300;

if (file_exists($filename)) {
    $fp = fopen($filename, 'r+');
    if (flock($fp, LOCK_SH)) {
        $raw   = stream_get_contents($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
        $data = json_decode($raw, true);
        if (!is_array($data)) {
            $data = [];
        }
    } else {
        fclose($fp);
        $data = [];
    }
} else {
    $data = [];
}

$sessionId = session_id();
$data[$sessionId] = time();

foreach ($data as $sid => $lastSeen) {
    if (time() - $lastSeen > $timeout) {
        unset($data[$sid]);
    }
}

$fp2 = fopen($filename, 'w');
if ($fp2) {
    if (flock($fp2, LOCK_EX)) {
        fwrite($fp2, json_encode($data));
        fflush($fp2);
        flock($fp2, LOCK_UN);
    }
    fclose($fp2);
}

$response = [
    'online'    => count($data),
    'timestamp' => time()
];

echo json_encode($response);
exit;