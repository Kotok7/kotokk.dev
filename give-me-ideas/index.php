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
        'short_description' => "I didn't have an idea for a website so I created this one - add your idea!",
        'form_title' => 'Title',
        'form_description' => 'Description',
        'form_tags' => 'Tags (comma separated)',
        'form_submit' => 'Add idea',
        'no_ideas' => 'No ideas yet.',
        'up' => 'Up',
        'down' => 'Down',
        'votes' => 'Votes',
        'switch' => 'Polish',
        'sort_label' => 'Sort by',
        'sort_score' => 'Highest score',
        'sort_newest' => 'Newest'
    ],
    'pl' => [
        'page_title' => 'Jaką stronę chciałbyś abym stworzył?',
        'short_description' => 'Nie miałem pomysłu na stronę internetową dlatego stworzyłem tę - dodaj swój pomysł!',
        'form_title' => 'Tytuł',
        'form_description' => 'Opis',
        'form_tags' => 'Tagi (oddzielone przecinkami)',
        'form_submit' => 'Dodaj pomysł',
        'no_ideas' => 'Brak pomysłów.',
        'up' => 'Głos w górę',
        'down' => 'Głos w dół',
        'votes' => 'Głosy',
        'switch' => 'English',
        'sort_label' => 'Sortuj',
        'sort_score' => 'Największa ocena',
        'sort_newest' => 'Najnowszy post'
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
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'vote') {
    $postId = $_POST['post_id'] ?? '';
    $type = ($_POST['type'] ?? '') === 'down' ? 'down' : 'up';
    $uid = $_SESSION['uid'];
    $ideas = read_json($ideasFile);
    foreach($ideas as $k => $idea) {
        if($idea['id'] === $postId) {
            $voters = is_array($idea['voters']) ? $idea['voters'] : (is_object($idea['voters']) ? (array)$idea['voters'] : []);
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
    header('Location: index.php');
    exit;
}
if(isset($_GET['action']) && $_GET['action'] === 'api') {
    $op = $_GET['op'] ?? '';
    header('Content-Type: application/json; charset=utf-8');
    if($op === 'list') {
        $sort = $_GET['sort'] ?? 'score';
        $ideas = read_json($ideasFile);
        foreach($ideas as $k => $idea) {
            $voters = is_array($idea['voters']) ? $idea['voters'] : (is_object($idea['voters']) ? (array)$idea['voters'] : []);
            $up = 0; $down = 0;
            foreach($voters as $v) { if($v === 'up') $up++; elseif($v === 'down') $down++; }
            $ideas[$k]['score'] = $up - $down;
            $ideas[$k]['up'] = $up;
            $ideas[$k]['down'] = $down;
            $ideas[$k]['your_vote'] = isset($voters[$_SESSION['uid']]) ? $voters[$_SESSION['uid']] : null;
        }
        if($sort === 'newest') {
            usort($ideas, function($a,$b){ return strtotime($b['created_at']) <=> strtotime($a['created_at']); });
        } else {
            usort($ideas, function($a,$b){ return ($b['score'] ?? 0) <=> ($a['score'] ?? 0); });
        }
        echo json_encode($ideas);
        exit;
    } elseif($op === 'vote' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $postId = $_POST['post_id'] ?? '';
        $type = ($_POST['type'] ?? '') === 'down' ? 'down' : 'up';
        $uid = $_SESSION['uid'];
        $ideas = read_json($ideasFile);
        foreach($ideas as $k => $idea) {
            if($idea['id'] === $postId) {
                $voters = is_array($idea['voters']) ? $idea['voters'] : (is_object($idea['voters']) ? (array)$idea['voters'] : []);
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
        foreach($ideas as $k => $idea) {
            if($idea['id'] === $postId) {
                $voters = is_array($idea['voters']) ? $idea['voters'] : (is_object($idea['voters']) ? (array)$idea['voters'] : []);
                $up = 0; $down = 0;
                foreach($voters as $v) { if($v === 'up') $up++; elseif($v === 'down') $down++; }
                $resp = ['id'=>$postId,'up'=>$up,'down'=>$down,'score'=>$up-$down,'your_vote'=>isset($voters[$_SESSION['uid']])?$voters[$_SESSION['uid']]:null];
                echo json_encode($resp);
                exit;
            }
        }
        echo json_encode(['error'=>'not found']);
        exit;
    }
    echo json_encode([]);
    exit;
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
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
            'voters' => []
        ];
        write_json($ideasFile, $ideas);
    }
    header('Location: index.php');
    exit;
}
$ideas = read_json($ideasFile);
function count_votes($voters) {
    $arr = is_array($voters) ? $voters : (is_object($voters) ? (array)$voters : []);
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
<label style="margin-left:20px;"><?php echo htmlspecialchars($t['sort_label']); ?>:
<select id="sort-select">
<option value="score"><?php echo htmlspecialchars($t['sort_score']); ?></option>
<option value="newest"><?php echo htmlspecialchars($t['sort_newest']); ?></option>
</select>
</label>
<div id="ideas-container" style="margin-top:20px;">
<?php if(empty($ideas)): ?>
<p><?php echo htmlspecialchars($t['no_ideas']); ?></p>
<?php else: ?>
<?php foreach($ideas as $idea): ?>
<?php $votes = count_votes($idea['voters']); ?>
<div class="idea" data-id="<?php echo htmlspecialchars($idea['id']); ?>" style="border:1px solid #000;padding:8px;margin-bottom:10px;">
<h2><?php echo htmlspecialchars($idea['title']); ?></h2>
<p><?php echo nl2br(htmlspecialchars($idea['description'])); ?></p>
<?php if(!empty($idea['tags'])): ?>
<p><?php foreach($idea['tags'] as $tag): ?><span style="margin-right:6px;"><?php echo htmlspecialchars($tag); ?></span><?php endforeach; ?></p>
<?php endif; ?>
<p class="votes"><?php echo htmlspecialchars($t['votes']); ?>: <?php echo $votes['up'] - $votes['down']; ?> (<?php echo $votes['up']; ?> + / <?php echo $votes['down']; ?> -)</p><br>
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
</div>
<script>
window.T = <?php echo json_encode($t, JSON_UNESCAPED_UNICODE); ?>;
function createIdeaHTML(idea) {
    var tagsHtml = '';
    if(idea.tags && idea.tags.length) {
        for(var i=0;i<idea.tags.length;i++){
            tagsHtml += '<span style="margin-right:6px;">'+escapeHtml(idea.tags[i])+'</span>';
        }
    }
    var score = (idea.up||0) - (idea.down||0);
    var your = idea.your_vote || null;
    var upLabel = escapeHtml(window.T.up);
    var downLabel = escapeHtml(window.T.down);
    var votesLabel = escapeHtml(window.T.votes);
    var html = '';
    html += '<div class="idea" data-id="'+escapeHtml(idea.id)+'" style="border:1px solid #000;padding:8px;margin-bottom:10px;">';
    html += '<h2>'+escapeHtml(idea.title)+'</h2>';
    html += '<p>'+nl2br(escapeHtml(idea.description||''))+'</p>';
    if(tagsHtml) html += '<p>'+tagsHtml+'</p>';
    html += '<p class="votes">'+votesLabel+': '+score+' ('+(idea.up||0)+' + / '+(idea.down||0)+' -)</p>';
    html += '<form method="post" style="display:inline;margin-right:8px;">';
    html += '<input type="hidden" name="action" value="vote">';
    html += '<input type="hidden" name="post_id" value="'+escapeHtml(idea.id)+'">';
    html += '<input type="hidden" name="type" value="up">';
    html += '<button type="submit">'+upLabel+'</button>';
    html += '</form>';
    html += '<form method="post" style="display:inline;">';
    html += '<input type="hidden" name="action" value="vote">';
    html += '<input type="hidden" name="post_id" value="'+escapeHtml(idea.id)+'">';
    html += '<input type="hidden" name="type" value="down">';
    html += '<button type="submit">'+downLabel+'</button>';
    html += '</form>';
    html += '</div>';
    return html;
}
function escapeHtml(s){
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
}
function nl2br(s){
    return s.replace(/\n/g,'<br>');
}
function fetchList(sort){
    var url = 'index.php?action=api&op=list&sort='+encodeURIComponent(sort);
    fetch(url).then(function(r){ return r.json(); }).then(function(data){
        var cont = document.getElementById('ideas-container');
        if(!data || !data.length){
            cont.innerHTML = '<p>'+escapeHtml(window.T.no_ideas)+'</p>';
            return;
        }
        var out = '';
        for(var i=0;i<data.length;i++) out += createIdeaHTML(data[i]);
        cont.innerHTML = out;
    }).catch(function(e){});
}
document.addEventListener('DOMContentLoaded', function(){
    var select = document.getElementById('sort-select');
    select.addEventListener('change', function(){
        fetchList(this.value);
    });
});
</script>
</body>
</html>
