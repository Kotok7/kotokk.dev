<?php
declare(strict_types=1);
$dataDir = __DIR__ . '/data';
$dataFile = $dataDir . '/draw.json';
header('Content-Type: application/json');
if (!is_dir($dataDir)) mkdir($dataDir, 0755, true);
$raw = file_get_contents('php://input');
if (!$raw) { http_response_code(400); echo json_encode(['status'=>'error']); exit; }
$payload = json_decode($raw, true);
if (!is_array($payload) || !isset($payload['stroke'])) { http_response_code(400); echo json_encode(['status'=>'error']); exit; }
$stroke = $payload['stroke'];
if (!isset($stroke['points']) || !is_array($stroke['points']) || count($stroke['points']) < 2) { http_response_code(400); echo json_encode(['status'=>'error']); exit; }
$color = isset($stroke['color']) ? substr((string)$stroke['color'],0,32) : '#000';
$size = isset($stroke['size']) ? (int)$stroke['size'] : 6;
$tool = isset($stroke['tool']) && $stroke['tool'] === 'eraser' ? 'eraser' : 'pen';
$points = [];
foreach ($stroke['points'] as $p) {
    if (!is_array($p) || count($p) < 2) continue;
    $x = floatval($p[0]);
    $y = floatval($p[1]);
    $points[] = [$x, $y];
}
if (count($points) < 2) { http_response_code(400); echo json_encode(['status'=>'error']); exit; }
$owner = isset($stroke['owner']) ? substr((string)$stroke['owner'], 0, 128) : null;
$clean = ['points'=>$points,'color'=>$color,'size'=>$size,'tool'=>$tool,'ts'=>time()];
if ($owner !== null && $owner !== '') $clean['owner'] = $owner;
$max = 8000;
if (!file_exists($dataFile)) file_put_contents($dataFile, json_encode([]), LOCK_EX);
$fp = fopen($dataFile, 'c+');
if (!$fp) { http_response_code(500); echo json_encode(['status'=>'error']); exit; }
flock($fp, LOCK_EX);
fseek($fp, 0);
$contents = stream_get_contents($fp);
$data = json_decode($contents, true);
if (!is_array($data)) $data = [];
$data[] = $clean;
if (count($data) > $max) $data = array_slice($data, -$max);
ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($data));
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);
echo json_encode(['status'=>'ok','total'=>count($data)]);
