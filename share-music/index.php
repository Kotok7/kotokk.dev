<?php
$lang_code = $_GET['lang'] ?? 'en';
$translations = [
    'en' => [
        'html_lang'    => 'en',
        'title'        => 'Kotokk - Share and discover music!',
        'meta_desc'    => 'Share your favourite songs and discover new music!',
        'translate'    => 'Przetłumacz na Polski',
        'back_button'  => 'Back to main page',
        'share_song'   => 'Share songs',
        'enter_name'   => 'Enter song title...',
        'song_name'    => 'Song title',
        'enter_artist' => 'Enter artist name...',
        'song_artist'  => 'Song artist',
        'enter_desc'   => 'Enter song description...',
        'song_desc'    => 'Song description (optional)',
        'song_link'    => 'Link to the song (automatically generated)',
        'add'          => 'Add',
        'song_list'    => 'List of shared songs',
        'listen'       => '🎧 Listen',
    ],
    'pl' => [
        'html_lang'    => 'pl',
        'title'        => 'Kotokk - Udostępnij i odkrywaj muzykę!',
        'meta_desc'    => 'Udostępnij swoje ulubione piosenki i odkrywaj nową muzykę!',
        'translate'    => 'Translate to English',
        'back_button'  => 'Wróć do strony głównej',
        'share_song'   => 'Udostępnij piosenki',
        'enter_name'   => 'Wpisz tytuł piosenki...',
        'song_name'    => 'Tytuł piosenki',
        'enter_artist' => 'Wpisz nazwę artysty...',
        'song_artist'  => 'Artysta piosenki',
        'enter_desc'   => 'Wpisz opis piosenki...',
        'song_desc'    => 'Opis piosenki (opcjonalne)',
        'song_link'    => 'Link do piosenki (automatycznie wygenerowane)',
        'add'          => 'Dodaj',
        'song_list'    => 'Lista dodanych piosenek',
        'listen'       => '🎧 Posłuchaj',
    ]
];
if (!isset($translations[$lang_code])) {
    $lang_code = 'en';
}
$t = $translations[$lang_code];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($t['html_lang'], ENT_QUOTES) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['title'], ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc'], ENT_QUOTES) ?>">
    <link rel="icon" type="image/png" href="photos/website-icon.png" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="container">
        <div class="header">
            <button onclick="window.location.href='index.php'" class="back-button">
                ← <?= htmlspecialchars($t['back_button'], ENT_QUOTES) ?>
            </button>
            <a href="?lang=<?= $lang_code==='pl'?'en':'pl' ?>">
                <img src="<?= $lang_code==='pl'?'photos/united-states.png':'photos/poland.png' ?>"
                     alt="<?= $t['translate'] ?>" title="<?= $t['translate'] ?>"
                     width="30">
            </a>
            <h1><?= htmlspecialchars($t['share_song'], ENT_QUOTES) ?> 🎵</h1>
        </div>
        <div class="content">
     <form id="songForm">
  <div class="form-group">
    <label for="title"><?= htmlspecialchars($t['song_name'], ENT_QUOTES) ?> *</label>
    <input type="text" id="title" name="title" required placeholder="<?= htmlspecialchars($t['enter_name'], ENT_QUOTES) ?>">
  </div>

  <div class="form-group">
    <label for="author"><?= htmlspecialchars($t['song_artist'], ENT_QUOTES) ?> *</label>
    <input type="text" id="author" name="author" required placeholder="<?= htmlspecialchars($t['enter_artist'], ENT_QUOTES) ?>">
  </div>

  <div class="form-group">
    <label for="nickname">Your nickname *</label>
    <input type="text" id="nickname" name="nickname" required placeholder="Enter your nickname...">
  </div>

  <div class="form-group">
    <label for="description"><?= htmlspecialchars($t['song_desc'], ENT_QUOTES) ?></label>
    <textarea id="description" name="description" rows="3"
      placeholder="<?= htmlspecialchars($t['enter_desc'], ENT_QUOTES) ?>"></textarea>
  </div>

  <div class="form-group">
    <label for="link"><?= htmlspecialchars($t['song_link'], ENT_QUOTES) ?></label>
    <input type="url" id="link" name="link" placeholder="https://" readonly>
  </div>

  <input type="hidden" id="cover" name="cover">
  <button type="submit" class="submit-btn" id="submitBtn"><?= htmlspecialchars($t['add'], ENT_QUOTES) ?></button>
</form>
            <div id="cover-preview" style="margin-top:10px;"></div>
            <div id="message-container"></div>
            <h2>📋 <?= htmlspecialchars($t['song_list'], ENT_QUOTES) ?></h2>
            <ul id="songsList" class="songs-list"></ul>
        </div>
    </div>
<script>
    const LISTEN_LABEL = <?= json_encode($t['listen'], JSON_UNESCAPED_UNICODE) ?>;
  </script>
    <script src="script.js"></script>
</body>
</html>
