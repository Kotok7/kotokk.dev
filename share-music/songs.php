<?php
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
}
if ($_SERVER['REQUEST_METHOD']=='OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit;
}
define('DATA_DIR', __DIR__.'/data');
define('DATA_FILE', DATA_DIR.'/songs.json');
define('MAX_TITLE_LENGTH',100);
define('MAX_AUTHOR_LENGTH',100);
define('MAX_DESCRIPTION_LENGTH',100);
define('MAX_NICKNAME_LENGTH',50);
define('MAX_SONGS_COUNT',1000);
function initializeDataStructure(): void {
    if(!is_dir(DATA_DIR)) mkdir(DATA_DIR,0755,true);
    if(!file_exists(DATA_FILE)) file_put_contents(DATA_FILE,json_encode([],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),LOCK_EX);
}
function loadSongs(): array {
    $c=file_get_contents(DATA_FILE);
    $s=json_decode($c,true);
    return is_array($s)?$s:[];
}
function saveSongs(array $s): void {
    file_put_contents(DATA_FILE,json_encode($s,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),LOCK_EX);
}
function validateAndSanitizeInput(array $d): array {
    $e=[];
    $t=trim($d['title']??'');
    if($t==='') $e[]='Title is required';
    elseif(mb_strlen($t)>MAX_TITLE_LENGTH) $e[]='Title too long';
    $a=trim($d['author']??'');
    if($a==='') $e[]='Author is required';
    elseif(mb_strlen($a)>MAX_AUTHOR_LENGTH) $e[]='Author too long';
    $desc=trim($d['description']??'');
    if(mb_strlen($desc)>MAX_DESCRIPTION_LENGTH) $e[]='Description too long';
    $link=trim($d['link']??'');
    if($link!=''&&!filter_var($link,FILTER_VALIDATE_URL)) $e[]='Invalid song link';
    $cover=trim($d['cover']??'');
    if($cover!=''&&!filter_var($cover,FILTER_VALIDATE_URL)) $e[]='Invalid cover URL';
    $nick=trim($d['nickname']??'');
    if($nick==='') $e[]='Nickname is required';
    elseif(mb_strlen($nick)>MAX_NICKNAME_LENGTH) $e[]='Nickname too long';
    $genres=trim($d['genres']??'');
    $tagList = $genres!=='' 
        ? array_values(array_filter(array_map('trim',explode(',',$genres))))
        : [];
    if($tagList!==array_unique($tagList)) $e[]='Duplicate genres';
    if($e) throw new InvalidArgumentException(implode(', ',$e));
    return [
        'title'=>htmlspecialchars($t,ENT_QUOTES|ENT_HTML5,'UTF-8'),
        'author'=>htmlspecialchars($a,ENT_QUOTES|ENT_HTML5,'UTF-8'),
        'description'=>htmlspecialchars($desc,ENT_QUOTES|ENT_HTML5,'UTF-8'),
        'link'=>$link,
        'cover'=>$cover,
        'nickname'=>htmlspecialchars($nick,ENT_QUOTES|ENT_HTML5,'UTF-8'),
        'genres'=>$tagList
    ];
}
function handleError(Exception $ex,int $sc=500): void {
    http_response_code($sc);
    echo json_encode(['error'=>$ex->getMessage(),'timestamp'=>date('c')]);
    exit;
}
try {
    initializeDataStructure();
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            echo json_encode(loadSongs());
            break;
        case 'POST':
            $in=file_get_contents('php://input');
            $d=json_decode($in,true);
            if(json_last_error()!==JSON_ERROR_NONE) throw new InvalidArgumentException('Invalid JSON');
            if(isset($d['id'],$d['rating'])) {
                $s=loadSongs();
                foreach($s as&$song){
                    if($song['id']===$d['id']){
                        $r=(int)$d['rating'];
                        if($r<1||$r>5) throw new InvalidArgumentException('Invalid rating');
                        if(!isset($song['ratings'])||!is_array($song['ratings'])) $song['ratings']=[];
                        $song['ratings'][]=$r;
                    }
                }
                saveSongs($s);
                echo json_encode($s);
                break;
            }
            $v=validateAndSanitizeInput($d);
            $s=loadSongs();
            if(count($s)>=MAX_SONGS_COUNT) throw new Exception('Maximum number of songs reached');
            $new=[
                'id'=>uniqid('song_',true),
                'title'=>$v['title'],
                'author'=>$v['author'],
                'description'=>$v['description'],
                'link'=>$v['link'],
                'cover'=>$v['cover'],
                'nickname'=>$v['nickname'],
                'genres'=>$v['genres'],
                'ratings'=>[],
                'added'=>date('Y-m-d'),
                'added_timestamp'=>time()
            ];
            array_unshift($s,$new);
            saveSongs($s);
            http_response_code(201);
            echo json_encode($s);
            break;
        default:
            http_response_code(405);
            echo json_encode(['error'=>'Method not allowed']);
    }
} catch(InvalidArgumentException $e){
    handleError($e,400);
} catch(Exception $e){
    handleError($e,500);
}
