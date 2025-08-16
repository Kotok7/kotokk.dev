<?php
require_once 'translations.php';
$lang = 'pl';
if (isset($_POST['lang']) && in_array($_POST['lang'], ['pl','en'])) $lang = $_POST['lang'];
function respond($params = []) {
    global $lang;
    $qs = [];
    if (!empty($params)) {
        foreach ($params as $k=>$v) $qs[] = urlencode($k).'='.urlencode($v);
    }
    header('Location: index.php?lang='.urlencode($lang).(count($qs)?'&'.implode('&',$qs):''));
    exit;
}
$name = trim($_POST['name'] ?? '');
$type = trim($_POST['type'] ?? '');
$platform = trim($_POST['platform'] ?? '');
$description = trim($_POST['description'] ?? '');
$link = trim($_POST['link'] ?? '');
if ($name === '' || $type === '') {
    respond(['error' => 'required']);
}
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
$allowedTypes = ['image/jpeg','image/png','image/gif','image/webp'];
$uploadedFileNames = [];
if (!empty($_FILES['images']) && is_array($_FILES['images']['tmp_name'])) {
    $maxFiles = 6;
    $countFiles = count(array_filter($_FILES['images']['tmp_name']));
    if ($countFiles > $maxFiles) {
        respond(['error'=>'too_many_files']);
    }
    for ($i=0;$i<count($_FILES['images']['tmp_name']);$i++) {
        if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) continue;
        $tmp = $_FILES['images']['tmp_name'][$i];
        $mime = @mime_content_type($tmp);
        if (!in_array($mime, $allowedTypes)) {
            respond(['error'=>'invalid_file']);
        }
        $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
        $safeName = bin2hex(random_bytes(8)) . '.' . ($ext ? preg_replace('/[^A-Za-z0-9]/', '', $ext) : 'img');
        $dest = $uploadDir . '/' . $safeName;
        if (move_uploaded_file($tmp, $dest)) {
            $uploadedFileNames[] = $safeName;
        }
    }
}
$dataFile = __DIR__ . '/apps.json';
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([], JSON_PRETTY_PRINT));
}
$fp = fopen($dataFile, 'c+');
if (!$fp) {
    respond(['error'=>'cant_write']);
}
flock($fp, LOCK_EX);
$contents = stream_get_contents($fp);
$existing = json_decode($contents, true);
if (!is_array($existing)) $existing = [];
$new = [
    'name' => $name,
    'type' => $type,
    'platform' => $platform,
    'description' => $description,
    'link' => $link,
    'images' => $uploadedFileNames,
    'created_at' => gmdate('c')
];
$existing[] = $new;
rewind($fp);
ftruncate($fp, 0);
fwrite($fp, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
flock($fp, LOCK_UN);
fclose($fp);
respond(['ok' => 1]);