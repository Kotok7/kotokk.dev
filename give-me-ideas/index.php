<?php
session_start();
if(!isset($_SESSION['uid'])) $_SESSION['uid'] = uniqid('u', true);
if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'en';
if(isset($_GET['lang'])) {
    $l = $_GET['lang'] === 'pl' ? 'pl' : 'en';
    $_SESSION['lang'] = $l;
    header('Location: index.php');
    exit;
}
$translations = [
    'en' => [
        'page_title' => 'What website would you like me to build?',
        'meta_desc' => "I didn't have an idea for a website so I created this one - add your idea!",
        'short_description' => "I didn't have an idea for a website so I created this one - add your idea!",
        'form_title' => 'Title',
        'form_description' => 'Description',
        'form_tags' => 'Tags (comma separated)',
        'form_submit' => 'Add idea',
        'no_ideas' => 'No ideas yet.',
        'up' => 'Up',
        'down' => 'Down',
        'votes' => 'Votes',
        'switch' => 'Przetłumacz na Polski'
    ],
    'pl' => [
        'page_title' => 'Jaką stronę chciałbyś abym stworzył?',
        'meta_desc' => 'Nie miałem pomysłu na stronę internetową dlatego stworzyłem tę - dodaj swój pomysł!',
        'short_description' => 'Nie miałem pomysłu na stronę internetową dlatego stworzyłem tę - dodaj swój pomysł!',
        'form_title' => 'Tytuł',
        'form_description' => 'Opis',
        'form_tags' => 'Tagi (oddzielone przecinkami)',
        'form_submit' => 'Dodaj pomysł',
        'no_ideas' => 'Brak pomysłów.',
        'up' => 'Głos w górę',
        'down' => 'Głos w dół',
        'votes' => 'Głosy',
        'switch' => 'Translate to English'
    ]
];
$t = $translations[$_SESSION['lang']];
$dataDir = __DIR__ . '/data';
if(!is_dir($dataDir)) mkdir($dataDir, 0777, true);
$ideasFile = $dataDir . '/ideas.json';
if(!file_exists($ideasFile)) file_put_contents($ideasFile, json_encode([], JSON_PRETTY_PRINT));
function read_json($file) {
    $c = file_get_contents($file);
    $d = json_decode($c, true);
    return is_array($d) ? $d : [];
}
function write_json($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    if($action === 'add') {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $tagsRaw = trim($_POST['tags'] ?? '');
        if($title !== '') {
            $ideas = read_json($ideasFile);
            $id = uniqid('p', true);
            $tags = array_values(array_filter(array_map('trim', explode(',', $tagsRaw))));
            $ideas[] = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'tags' => $tags,
                'created_at' => date('c'),
                'voters' => new stdClass()
            ];
            for($i=0;$i<count($ideas);$i++) {
                if($ideas[$i]['id'] === $id) {
                    if($ideas[$i]['voters'] instanceof stdClass) $ideas[$i]['voters'] = new stdClass();
                    break;
                }
            }
            write_json($ideasFile, $ideas);
        }
    } elseif($action === 'vote' && isset($_POST['post_id'], $_POST['type'])) {
        $postId = $_POST['post_id'];
        $type = $_POST['type'] === 'down' ? 'down' : 'up';
        $uid = $_SESSION['uid'];
        $ideas = read_json($ideasFile);
        foreach($ideas as $k => $idea) {
            if($idea['id'] === $postId) {
                $voters = is_object($idea['voters']) ? (array)$idea['voters'] : (is_array($idea['voters']) ? $idea['voters'] : []);
                $current = isset($voters[$uid]) ? $voters[$uid] : null;
                if($current === $type) {
                    unset($voters[$uid]);
                } else {
                    $voters[$uid] = $type;
                }
                $ideas[$k]['voters'] = $voters;
                break;
            }
        }
        write_json($ideasFile, $ideas);
    }
    header('Location: index.php');
    exit;
}
$ideas = read_json($ideasFile);
function count_votes($voters) {
    $arr = is_object($voters) ? (array)$voters : (is_array($voters) ? $voters : []);
    $up = 0;
    $down = 0;
    foreach($arr as $r) {
        if($r === 'up') $up++;
        elseif($r === 'down') $down++;
    }
    return ['up' => $up, 'down' => $down];
}
?>
<!doctype html>
<html lang="<?php echo htmlspecialchars($_SESSION['lang']); ?>">
<head>
<title><?php echo htmlspecialchars($t['page_title']); ?></title>
<link rel="icon" href="photos/website-icon.png" type="image/png">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
<meta name="description" content="<?= htmlspecialchars($t['meta_desc'], ENT_QUOTES) ?>">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$current = isset($_SESSION['lang']) && $_SESSION['lang'] === 'en' ? 'en' : 'pl';
$target = $current === 'en' ? 'pl' : 'en';
$img = $current === 'en' ? 'photos/poland.png' : 'photos/united-states.png';
$alt = $current === 'en' ? 'Polish flag' : 'US flag';
?>
<style>
.lang-switch{background:transparent;border:0;padding:0;cursor:pointer;display:inline-flex;align-items:center;justify-content:center}
.lang-switch img{display:block;width:35px;height:35px;object-fit:cover}
.lang-switch:focus{outline:4px solid #66a;outline-offset:4px}
</style>

<button type="button" class="lang-switch" onclick="window.location.href='?lang=<?php echo $target; ?>'" aria-label="<?php echo $current === 'en' ? 'Switch to Polish' : 'Switch to English'; ?>">
  <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($alt); ?>" width="30" height="30">
</button>
<h1><?php echo htmlspecialchars($t['page_title']); ?></h1>
<p><?php echo htmlspecialchars($t['short_description']); ?></p>
<form method="post" style="margin-bottom:20px;">
<input type="hidden" name="action" value="add">
<label><?php echo htmlspecialchars($t['form_title']); ?>: <input type="text" name="title" required></label><br>
<label><?php echo htmlspecialchars($t['form_description']); ?>:<br><textarea name="description" rows="4" cols="50"></textarea></label><br>
<label><?php echo htmlspecialchars($t['form_tags']); ?>: <input type="text" name="tags"></label><br>
<button type="submit"><?php echo htmlspecialchars($t['form_submit']); ?></button>
</form>
<?php if(empty($ideas)): ?>
<p><?php echo htmlspecialchars($t['no_ideas']); ?></p>
<?php else: ?>
<?php foreach($ideas as $idea): ?>
<div style="border:1px solid #000;padding:8px;margin-bottom:10px;">
<h2><?php echo htmlspecialchars($idea['title']); ?></h2>
<p><?php echo nl2br(htmlspecialchars($idea['description'])); ?></p>
<?php if(!empty($idea['tags'])): ?>
<p><?php foreach($idea['tags'] as $tag): ?><span style="margin-right:6px;"><?php echo htmlspecialchars($tag); ?></span><?php endforeach; ?></p>
<?php endif; ?>
<?php $votes = count_votes($idea['voters']); ?>
<p style="padding-bottom: 10px;"><?php echo htmlspecialchars($t['votes']); ?>: <?php echo $votes['up'] - $votes['down']; ?> (<?php echo $votes['up']; ?> + / <?php echo $votes['down']; ?> -)</p>
<form method="post" style="display:inline;margin-right:8px;">
<input type="hidden" name="action" value="vote">
<input type="hidden" name="post_id" value="<?php echo htmlspecialchars($idea['id']); ?>">
<input type="hidden" name="type" value="up">
<button type="submit"><?php echo htmlspecialchars($t['up']); ?></button>
</form>
<form method="post" style="display:inline;">
<input type="hidden" name="action" value="vote">
<input type="hidden" name="post_id" value="<?php echo htmlspecialchars($idea['id']); ?>">
<input type="hidden" name="type" value="down">
<button type="submit"><?php echo htmlspecialchars($t['down']); ?></button>
</form>
</div>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>