<?php
date_default_timezone_set('Europe/Warsaw');
header('Content-Type: application/json; charset=UTF-8');

$cdFile      = __DIR__ . '/messages/cooldowns.json';
$nickFile    = __DIR__ . '/messages/ip_nicks.json';
$msgFile     = __DIR__ . '/messages/messages.json';
if (!is_dir(__DIR__ . '/messages')) mkdir(__DIR__ . '/messages', 0755, true);
if (!is_dir(__DIR__ . '/uploads'))  mkdir(__DIR__ . '/uploads', 0755, true);

$token = $_POST['cf-turnstile-response'] ?? '';
if (!$token) {
    echo json_encode(['success'=>false,'error'=>'captcha','error_msg'=>'Please complete the captcha.']);
    exit;
}
$ch = curl_init('https://challenges.cloudflare.com/turnstile/v0/siteverify');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'secret'   => '0x4AAAAAABd4n_sUopYnvC-_vAt_A4emJLU',
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ])
]);
$resp = json_decode(curl_exec($ch), true);
curl_close($ch);
if (empty($resp['success'])) {
    echo json_encode(['success'=>false,'error'=>'captcha','error_msg'=>'Verification failed. Try refreshing the page.']);
    exit;
}

$ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$nick    = $_COOKIE['blog_nick'] ?? trim($_POST['nick'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!isset($_COOKIE['blog_nick'])) {
    if (strlen($nick)>=2 && strlen($nick)<=20) {
        setcookie('blog_nick', $nick, time()+30*24*3600, '/');
        $_COOKIE['blog_nick'] = $nick;
        $col = preg_match('/^#[0-9A-Fa-f]{6}$/', ($_POST['nick_color'] ?? ''))
             ? $_POST['nick_color'] : '#000000';
        setcookie('blog_nick_color', $col, time()+30*24*3600, '/');
        $_COOKIE['blog_nick_color'] = $col;
    } else {
        echo json_encode(['success'=>false,'error'=>'length','error_msg'=>'Nick must be 2–20 characters.']);
        exit;
    }
}

if (strlen($message)<3 || strlen($message)>200) {
    echo json_encode(['success'=>false,'error'=>'length','error_msg'=>'Message must be 3–200 characters.']);
    exit;
}

if (!file_exists($cdFile)) file_put_contents($cdFile,'{}');
$cd  = json_decode(file_get_contents($cdFile), true) ?: [];
$now = time();
if (isset($cd[$ip]) && $now - $cd[$ip] < 2) {
    echo json_encode(['success'=>false,'error'=>'delay','error_msg'=>'Please wait 2 seconds before sending another message.']);
    exit;
}
$cd[$ip] = $now;
file_put_contents($cdFile, json_encode($cd, JSON_PRETTY_PRINT));

if (!file_exists($nickFile)) file_put_contents($nickFile,'{}');
$ipN = json_decode(file_get_contents($nickFile), true) ?: [];
if (!isset($ipN[$ip])) {
    $ipN[$ip] = $nick;
    file_put_contents($nickFile, json_encode($ipN, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
} else {
    $nick = $ipN[$ip];
}

$photoFilename = '';
if (!empty($_FILES['photo']) && $_FILES['photo']['error']!==UPLOAD_ERR_NO_FILE) {
    $f = $_FILES['photo'];
    if ($f['error']!==UPLOAD_ERR_OK) {
        echo json_encode(['success'=>false,'error'=>'file','error_msg'=>'Photo upload error.']);
        exit;
    }
    if ($f['size']>20*1024*1024) {
        echo json_encode(['success'=>false,'error'=>'file_size','error_msg'=>'Photo max 20 MB.']);
        exit;
    }
    $mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $f['tmp_name']);
    $allowedImg = ['image/jpeg'=>'jpg','image/png'=>'png','image/gif'=>'gif'];
    if (!isset($allowedImg[$mime])) {
        echo json_encode(['success'=>false,'error'=>'file_type','error_msg'=>'Only JPG, PNG and GIF formats are allowed.']);
        exit;
    }
    $ext = $allowedImg[$mime];
    $base = time().'_'.bin2hex(random_bytes(4));
    $photoFilename = "$base.$ext";
    move_uploaded_file($f['tmp_name'], __DIR__."/uploads/$photoFilename");
}

$voiceFilename = '';
if (!empty($_FILES['voice']) && $_FILES['voice']['error']!==UPLOAD_ERR_NO_FILE) {
    $f = $_FILES['voice'];
    if ($f['error']!==UPLOAD_ERR_OK) {
        echo json_encode(['success'=>false,'error'=>'voice_file','error_msg'=>'Audio upload error.']);
        exit;
    }
    if ($f['size']>20*1024*1024) {
        echo json_encode(['success'=>false,'error'=>'voice_size','error_msg'=>'Audio max 20 MB.']);
        exit;
    }
    $mime = explode(';', finfo_file(finfo_open(FILEINFO_MIME_TYPE), $f['tmp_name']))[0];
    $allowedAudio = ['audio/mpeg'=>'mp3','audio/ogg'=>'ogg','audio/wav'=>'wav','audio/webm'=>'webm','audio/mp4'=>'m4a'];
    if (!isset($allowedAudio[$mime])) {
        echo json_encode(['success'=>false,'error'=>'voice_type','error_msg'=>'Only MP3, OGG, WAV, WEBM and MP4 formats are allowed.']);
        exit;
    }
    $ext = $allowedAudio[$mime];
    $base = time().'_'.bin2hex(random_bytes(4));
    $voiceFilename = "$base.$ext";
    move_uploaded_file($f['tmp_name'], __DIR__."/uploads/$voiceFilename");
}

if (!file_exists($msgFile)) file_put_contents($msgFile,'[]');
$msgs = json_decode(file_get_contents($msgFile), true) ?: [];

$newId   = $msgs ? max(array_column($msgs,'id'))+1 : 1;
$replyTo = isset($_POST['reply_to']) && is_numeric($_POST['reply_to'])
           ? (int)$_POST['reply_to'] : null;

$entry = [
    'id'       => $newId,
    'nick'     => htmlspecialchars($nick, ENT_QUOTES, 'UTF-8'),
    'color'    => $_COOKIE['blog_nick_color'] ?? '#000000',
    'text'     => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
    'date'     => date('Y-m-d H:i:s'),
    'photo'    => $photoFilename,
    'voice'    => $voiceFilename,
    'reply_to' => $replyTo
];

$msgs[] = $entry;
file_put_contents($msgFile, json_encode($msgs, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
echo json_encode(['success'=>true,'last_id'=>$newId]);
exit;