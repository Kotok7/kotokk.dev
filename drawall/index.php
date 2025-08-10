<?php
$lang = isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'pl';
$trans = [
  'pl' => [
    'title' => 'Drawall',
    'meta' => 'Ściana gdzie każdy może rysować co tylko chce!',
    'color' => 'Kolor',
    'size' => 'Grubość',
    'pen' => 'Długopis',
    'eraser' => 'Gumka',
    'connected' => 'Status połączenia',
    'new' => "Nowych stroke'ów",
    'cofnij' => 'Cofnij'
  ],
  'en' => [
    'title' => 'Drawall',
    'meta' => 'Wall where everyone can draw whatever they want!',
    'color' => 'Color',
    'size' => 'Size',
    'pen' => 'Pen',
    'eraser' => 'Eraser',
    'connected' => 'Connection',
    'new' => 'New strokes',
    'cofnij' => 'Undo'
  ]
];
$t = $trans[$lang];
?>
<!doctype html>
<html lang="<?php echo $lang ?>">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title><?php echo htmlspecialchars($t['title'], ENT_QUOTES) ?></title>
<link rel="stylesheet" href="styles.css">
<link rel="icon" type="image/png" href="photos/website-icon.png" />
 <meta name="description" content="<?php echo htmlspecialchars($t['meta'], ENT_QUOTES) ?>" />
</head>
<body>
  <h2 id="title"><?php echo htmlspecialchars($t['title'], ENT_QUOTES) ?></h2>
  <div class="controls">
    <label>Zoom: 
  <input id="zoom" type="range" min="0.2" max="3" step="0.05" value="0.5">
  <span id="zoomVal">50%</span>
</label>
    <label><?php echo htmlspecialchars($t['size'], ENT_QUOTES) ?>: <input id="size" type="range" min="1" max="60" value="6"></label>
    <label><?php echo htmlspecialchars($t['color'], ENT_QUOTES) ?>: <input id="color" type="color" value="#000000"></label>
    <button id="undoBtn" class="tool-btn"><?php echo htmlspecialchars($t['cofnij'], ENT_QUOTES) ?></button>
    <button id="penBtn" class="tool-btn"><?php echo htmlspecialchars($t['pen'], ENT_QUOTES) ?></button>
    <button id="eraserBtn" class="tool-btn"><?php echo htmlspecialchars($t['eraser'], ENT_QUOTES) ?></button>
    <div class="lang">
      <a href="?lang=pl">PL</a> | <a href="?lang=en">EN</a>
    </div>
  </div>
<div class="board-wrap">
  <canvas id="board"></canvas>
</div>
  <div class="info">
    <?php echo htmlspecialchars($t['connected'], ENT_QUOTES) ?>: <span id="status">—</span>
    <?php echo htmlspecialchars($t['new'], ENT_QUOTES) ?>: <span id="newCount">0</span>
  </div>
  <script>const TRANSLATIONS = <?php echo json_encode($t, JSON_UNESCAPED_UNICODE) ?>;</script>
</script>
  <script src="app.js"></script>
</body>
</html>
