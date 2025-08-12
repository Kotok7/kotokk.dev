<?php
require_once __DIR__ . '/translations.php';
$dataDir = __DIR__ . '/data';
$uploadsDir = __DIR__ . '/uploads';
@mkdir($dataDir, 0755, true);
@mkdir($uploadsDir, 0755, true);
$postsFile = $dataDir . '/posts.json';
$title = trim($_POST['title'] ?? '');
$platform = trim($_POST['platform'] ?? '');
$description = trim($_POST['description'] ?? '');
if ($title === '') {
    header('Location: index.php');
    exit;
}
$allowedMime = ['image/jpeg','image/png','image/gif','image/webp'];
$screens = [];
if (!empty($_FILES['screenshots']) && is_array($_FILES['screenshots']['tmp_name'])) {
    $files = $_FILES['screenshots'];
    $count = count($files['tmp_name']);
    for ($i=0;$i<$count && count($screens) < 5;$i++) {
        if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;
        if ($files['size'][$i] > 2 * 1024 * 1024) continue;
        $info = @getimagesize($files['tmp_name'][$i]);
        if (!$info || !in_array($info['mime'], $allowedMime)) continue;
        $ext = '';
        switch ($info['mime']) {
            case 'image/jpeg': $ext = 'jpg'; break;
            case 'image/png': $ext = 'png'; break;
            case 'image/gif': $ext = 'gif'; break;
            case 'image/webp': $ext = 'webp'; break;
            default: $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
        }
        try {
            $rand = bin2hex(random_bytes(6));
        } catch (Exception $e) {
            $rand = uniqid();
        }
        $name = time() . '_' . $rand . '.' . ($ext ?: 'jpg');
        $dest = $uploadsDir . '/' . $name;
        if (move_uploaded_file($files['tmp_name'][$i], $dest)) {
            $screens[] = 'uploads/' . $name;
        }
    }
}
$posts = [];
if (file_exists($postsFile)) {
    $raw = file_get_contents($postsFile);
    $posts = json_decode($raw, true) ?: [];
}
$maxId = 0;
foreach ($posts as $p) if (isset($p['id']) && $p['id'] > $maxId) $maxId = $p['id'];
$newId = $maxId + 1;
$date = new DateTimeImmutable('now', new DateTimeZone('UTC'));
$newPost = [
    'id' => $newId,
    'title' => $title,
    'platform' => $platform,
    'description' => $description,
    'screenshots' => $screens,
    'created_at' => $date->format(DateTime::ATOM)
];
$posts[] = $newPost;
$temp = json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
file_put_contents($postsFile, $temp, LOCK_EX);
header('Location: index.php');
exit;