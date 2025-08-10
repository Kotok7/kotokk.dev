<?php
declare(strict_types=1);
$dataFile = __DIR__ . '/data/draw.json';
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
$after = isset($_GET['after']) ? max(0,intval($_GET['after'])) : 0;
if (!file_exists($dataFile)) { echo json_encode(['strokes'=>[], 'total'=>0]); exit; }
$fp = fopen($dataFile, 'r');
if (!$fp) { echo json_encode(['strokes'=>[], 'total'=>0]); exit; }
flock($fp, LOCK_SH);
$contents = stream_get_contents($fp);
flock($fp, LOCK_UN);
fclose($fp);
$data = json_decode($contents, true);
if (!is_array($data)) $data = [];
$total = count($data);
$start = max(0, $after);
$subset = array_slice($data, $start);
echo json_encode(['strokes'=>$subset, 'total'=>$total]);