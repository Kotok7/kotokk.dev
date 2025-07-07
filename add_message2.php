<?php
$turnstile_secret   = '0x4AAAAAABd4n_sUopYnvC-_vAt_A4emJLU';
$turnstile_response = $_POST['cf-turnstile-response'] ?? '';

if (!$turnstile_response) {
    header("Location: /index.php?msg_error=recaptcha#leave-message");
    exit;
}

$ch = curl_init("https://challenges.cloudflare.com/turnstile/v0/siteverify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'secret'   => $turnstile_secret,
    'response' => $turnstile_response,
]));
$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response);
if (!$response_data || !$response_data->success) {
    header("Location: /index.php?msg_error=recaptcha#leave-message");
    exit;
}

date_default_timezone_set('Europe/Warsaw');
$ip  = $_SERVER['REMOTE_ADDR'];
$now = time();

if (isset($_COOKIE['blog_nick'])) {
    $nick = trim($_COOKIE['blog_nick']);
} else {
    $nick = trim($_POST['nick'] ?? '');
    if (strlen($nick) >= 2 && strlen($nick) <= 20) {
        setcookie('blog_nick', $nick, time() + 30*24*3600, '/');
        $_COOKIE['blog_nick'] = $nick;
    } else {
        header("Location: index.php?msg_error=length#leave-message");
        exit;
    }
}

$message = trim($_POST['message'] ?? '');
$message = str_replace(
    ["'", '"', '<', '>', ']', '[', '}', '{', '^', ';'],
    '',
    $message
);

if (strlen($message) < 3 || strlen($message) > 100) {
    header("Location: index.php?msg_error=length#leave-message");
    exit;
}

$dir      = __DIR__ . '/messages';
$cdFile   = "$dir/cooldowns.json";
$nickFile = "$dir/ip_nicks.json";
$msgFile  = "$dir/messages2.json";

if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

if (!file_exists($cdFile)) {
    file_put_contents($cdFile, '{}');
}
$cooldowns = json_decode(file_get_contents($cdFile), true) ?: [];
if (isset($cooldowns[$ip]) && ($now - $cooldowns[$ip] < 600)) {
    header("Location: index.php?msg_error=delay#leave-message");
    exit;
}
$cooldowns[$ip] = $now;
file_put_contents($cdFile, json_encode($cooldowns, JSON_PRETTY_PRINT));

if (!file_exists($nickFile)) {
    file_put_contents($nickFile, '{}');
}
$ipNicks = json_decode(file_get_contents($nickFile), true) ?: [];
if (isset($ipNicks[$ip]) && $ipNicks[$ip] !== $nick) {
    header("Location: index.php?msg_error=delay#leave-message");
    exit;
}
$ipNicks[$ip] = $nick;
file_put_contents($nickFile, json_encode($ipNicks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

if (!file_exists($msgFile)) {
    file_put_contents($msgFile, '[]');
}
$messages = json_decode(file_get_contents($msgFile), true) ?: [];
$messages[] = [
    'nick' => htmlspecialchars($nick, ENT_QUOTES, 'UTF-8'),
    'text' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
    'date' => date('Y-m-d H:i:s'),
];
file_put_contents($msgFile, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header("Location: index.php#leave-message");
exit;
?>