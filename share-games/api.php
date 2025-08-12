<?php
require_once __DIR__ . '/translations.php';
header('Content-Type: application/json; charset=utf-8');
$dataDir = __DIR__ . '/data';
$postsFile = $dataDir . '/posts.json';
$reactionsFile = $dataDir . '/reactions.json';
@mkdir($dataDir, 0755, true);
if (!file_exists($postsFile)) file_put_contents($postsFile, "[]");
if (!file_exists($reactionsFile)) file_put_contents($reactionsFile, "{}");
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$action = $input['action'] ?? ($_GET['action'] ?? null);
if ($action === 'get_posts') {
    $posts = json_decode(file_get_contents($postsFile), true) ?: [];
    $reactions = json_decode(file_get_contents($reactionsFile), true) ?: [];
    $user_id = $_COOKIE['user_id'] ?? null;
    foreach ($posts as &$p) {
        $pid = $p['id'];
        $likes = 0; $dislikes = 0; $user_reaction = 0;
        if (isset($reactions[$pid]) && is_array($reactions[$pid])) {
            foreach ($reactions[$pid] as $r) {
                if ($r == 1) $likes++;
                if ($r == -1) $dislikes++;
            }
            if ($user_id && isset($reactions[$pid][$user_id])) $user_reaction = (int)$reactions[$pid][$user_id];
        }
        $p['likes'] = $likes;
        $p['dislikes'] = $dislikes;
        $p['user_reaction'] = $user_reaction;
    }
    echo json_encode(['ok' => true, 'posts' => $posts], JSON_UNESCAPED_UNICODE);
    exit;
}
if ($action === 'react') {
    $post_id = (int)($input['post_id'] ?? 0);
    $reaction = (int)($input['reaction'] ?? 0);
    if (!in_array($reaction, [1, -1])) {
        echo json_encode(['ok'=>false, 'msg'=>t('error_generic')], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $user_id = $_COOKIE['user_id'] ?? null;
    if (!$user_id) {
        echo json_encode(['ok'=>false, 'msg'=>t('error_generic')], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $fp = fopen($reactionsFile, 'c+');
    if (!$fp) {
        echo json_encode(['ok'=>false,'msg'=>t('error_generic')], JSON_UNESCAPED_UNICODE);
        exit;
    }
    flock($fp, LOCK_EX);
    $raw = stream_get_contents($fp);
    $reactions = $raw ? json_decode($raw, true) : [];
    if (!is_array($reactions)) $reactions = [];
    if (!isset($reactions[$post_id])) $reactions[$post_id] = [];
    $prev = $reactions[$post_id][$user_id] ?? 0;
    if ($prev === $reaction) {
        unset($reactions[$post_id][$user_id]);
    } else {
        $reactions[$post_id][$user_id] = $reaction;
    }
    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($reactions, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    $likes = 0; $dislikes = 0;
    if (isset($reactions[$post_id]) && is_array($reactions[$post_id])) {
        foreach ($reactions[$post_id] as $r) {
            if ($r == 1) $likes++;
            if ($r == -1) $dislikes++;
        }
    }
    $user_reaction = $reactions[$post_id][$user_id] ?? 0;
    echo json_encode(['ok'=>true,'post_id'=>$post_id,'likes'=>$likes,'dislikes'=>$dislikes,'user_reaction'=>$user_reaction], JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode(['ok'=>false,'msg'=>t('error_generic')], JSON_UNESCAPED_UNICODE);
exit;