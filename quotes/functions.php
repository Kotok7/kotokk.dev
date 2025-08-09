<?php
session_start();

function data_file(): string {
    $dir = __DIR__ . '/data';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    return $dir . '/quotes.json';
}

function load_quotes(): array {
    $file = data_file();
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    $json = file_get_contents($file);
    $arr = json_decode($json, true);
    return is_array($arr) ? $arr : [];
}

function save_quotes(array $quotes): void {
    $file = data_file();
    $fh = fopen($file, 'c+');
    if ($fh === false) return;
    flock($fh, LOCK_EX);
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, json_encode($quotes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
}

function add_quote(string $nick, array $tags, string $content): int {
    $quotes = load_quotes();
    $ids = array_map(fn($q)=>$q['id'] ?? 0, $quotes);
    $nextId = $ids ? max($ids) + 1 : 1;
    $cleanTags = array_values(array_filter(array_map('trim', $tags), fn($t)=>$t !== ''));
    $quote = [
        'id' => $nextId,
        'nick' => trim($nick),
        'tags' => $cleanTags,
        'content' => trim($content),
        'created_at' => date('c')
    ];
    array_unshift($quotes, $quote);
    save_quotes($quotes);
    return $nextId;
}

function toggle_favorite(int $id): void {
    if (!isset($_SESSION['favorites'])) $_SESSION['favorites'] = [];
    if (in_array($id, $_SESSION['favorites'], true)) {
        $_SESSION['favorites'] = array_values(array_diff($_SESSION['favorites'], [$id]));
    } else {
        $_SESSION['favorites'][] = $id;
    }
}

function get_favorites(): array {
    return $_SESSION['favorites'] ?? [];
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf(?string $token): bool {
    return !empty($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
}