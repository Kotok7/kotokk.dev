<?php
header('Content-Type: application/json; charset=utf-8');
$storyFile = __DIR__ . '/story.json';
$ipFile = __DIR__ . '/ip_cooldowns.json';
$cooldown = 3600;
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$sentence = isset($_POST['sentence']) ? trim($_POST['sentence']) : '';
if ($sentence === '') {
    echo json_encode(['ok' => false, 'error' => 'Empty sentence']);
    exit;
}
if (mb_strlen($sentence) > 500) {
    echo json_encode(['ok' => false, 'error' => 'Sentence too long (max 500 chars)']);
    exit;
}
if (!file_exists($ipFile)) file_put_contents($ipFile, json_encode(new stdClass()));
if (!file_exists($storyFile)) file_put_contents($storyFile, json_encode(['sentences' => []], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$now = time();
$fh = fopen($ipFile, 'c+');
if ($fh === false) {
    echo json_encode(['ok' => false, 'error' => 'Cannot open cooldown file']);
    exit;
}
if (!flock($fh, LOCK_EX)) {
    fclose($fh);
    echo json_encode(['ok' => false, 'error' => 'Lock error']);
    exit;
}
rewind($fh);
$raw = stream_get_contents($fh);
$ipData = json_decode($raw, true);
if (!is_array($ipData)) $ipData = [];
$last = isset($ipData[$ip]) ? (int)$ipData[$ip] : 0;
if ($now - $last < $cooldown) {
    $remaining = $cooldown - ($now - $last);
    flock($fh, LOCK_UN);
    fclose($fh);
    echo json_encode(['ok' => false, 'error' => 'cooldown', 'remaining' => $remaining]);
    exit;
}
$ipData[$ip] = $now;
ftruncate($fh, 0);
rewind($fh);
fwrite($fh, json_encode($ipData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
fflush($fh);
flock($fh, LOCK_UN);
fclose($fh);
$fh2 = fopen($storyFile, 'c+');
if ($fh2 === false) {
    echo json_encode(['ok' => false, 'error' => 'Cannot open story file']);
    exit;
}
if (!flock($fh2, LOCK_EX)) {
    fclose($fh2);
    echo json_encode(['ok' => false, 'error' => 'Lock error']);
    exit;
}
rewind($fh2);
$raw2 = stream_get_contents($fh2);
$data = json_decode($raw2, true);
if (!is_array($data)) $data = ['sentences' => []];
$entry = ['sentence' => $sentence, 'timestamp' => $now];
$data['sentences'][] = $entry;
ftruncate($fh2, 0);
rewind($fh2);
fwrite($fh2, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
fflush($fh2);
flock($fh2, LOCK_UN);
fclose($fh2);
echo json_encode(['ok' => true, 'entry' => $entry]);
exit;