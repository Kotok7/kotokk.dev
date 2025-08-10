<?php
declare(strict_types=1);
$dataFile = __DIR__ . '/data/draw.json';
header('Content-Type: application/json');
$raw = file_get_contents('php://input');
if (!$raw) { http_response_code(400); echo json_encode(['status'=>'error']); exit; }
$payload = json_decode($raw, true);
if (!is_array($payload) || !isset($payload['owner'])) { http_response_code(400); echo json_encode(['status'=>'error']); exit; }
$owner = substr((string)$payload['owner'], 0, 128);
if (!file_exists($dataFile)) { echo json_encode(['status'=>'ok','removed'=>false,'total'=>0]); exit; }
$fp = fopen($dataFile, 'c+');
if (!$fp) { http_response_code(500); echo json_encode(['status'=>'error']); exit; }
flock($fp, LOCK_EX);
fseek($fp, 0);
$contents = stream_get_contents($fp);
$data = json_decode($contents, true);
if (!is_array($data)) $data = [];
$found = false;
for ($i = count($data) - 1; $i >= 0; $i--) {
    if (isset($data[$i]['owner']) && $data[$i]['owner'] === $owner) {
        array_splice($data, $i, 1);
        $found = true;
        break;
    }
}
ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($data));
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);
echo json_encode(['status'=>'ok','removed'=>$found,'total'=>count($data)]);