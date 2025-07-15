<?php
$lang_code = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'        => 'en',
        'title'            => 'Kotokk - Unfinished projects',
        'meta_description' => 'All the unfinished projects, that will be avaiable on the main page soon!',
        'translate'        => 'Translate to Polish',
        'main_title'       => 'Unfinished projects',
        'subtitle'         => 'All the unfinished projects, that will be avaiable on the main page soon!',
        'footer'           => 'All rights reserved.',
        'pusheen_title'    => 'PusheenWeb',
        'pusheen_desc'     => 'Cute website about Pusheen',
        'pusheen_link'     => 'Visit Site',
        'lumi_title'       => 'LumiBoard',
        'lumi_desc'        => 'Lumiboard is a sleek, web-based dashboard displaying time, weather, calendar, and more in a minimalist, modern interface.',
        'lumi_link'        => 'See now',
        'back'             => 'Back to main page',
    ],

    'pl' => [
        'html_lang'        => 'pl',
        'title'            => 'Kotokk - Nieukończone projekty',
        'meta_description' => 'Nieukończone projekty które wkrótce będą dostępne na stronie głównej!',
        'translate'        => 'Przetłumacz na angielski',
        'main_title'       => 'Nieukończone projekty',
        'subtitle'         => 'Nieukończone projekty które wkrótce będą dostępne na stronie głównej!',
        'footer'           => 'Wszelkie prawa zastrzeżone',
        'pusheen_title'    => 'PusheenWeb',
        'pusheen_desc'     => 'Urocza strona o Pusheenie',
        'pusheen_link'     => 'Odwiedź stronę',
        'lumi_title'       => 'LumiBoard',
        'lumi_desc'        => 'Lumiboard to elegancki, internetowy pulpit wyświetlający godzinę, pogodę, kalendarz i inne informacje w minimalistycznym, nowoczesnym interfejsie.',
        'lumi_link'        => 'Zobacz teraz',
        'back'             => 'Wróć do strony głównej',

    ],
];

$t = $translations[$lang_code] ?? $translations['en'];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($t['html_lang'], ENT_QUOTES) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= htmlspecialchars($t['title'], ENT_QUOTES) ?></title>
  <meta name="description" content="<?= htmlspecialchars($t['meta_description'], ENT_QUOTES) ?>">
  <link rel="icon" href="photos/website-icon.png" type="image/png">
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<header>
  <a href="?lang=<?= $lang_code === 'pl' ? 'en' : 'pl' ?>">
    <img src="photos/<?= $lang_code === 'pl' ? 'united-states.png' : 'poland.png' ?>"
         alt="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
         title="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
         width="30" height="30" loading="lazy">
  </a>
                    <button onclick="window.location.href='/'" class="back-button">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m12 19-7-7 7-7"/>
    <path d="M19 12H5"/>
  </svg>
<?= htmlspecialchars($t['back'], ENT_QUOTES) ?>
</button>
  <div class="header-content">
        <h1><?= htmlspecialchars($t['main_title'], ENT_QUOTES) ?><span class="cursor"></span></h1>
        <p><?= htmlspecialchars($t['subtitle'], ENT_QUOTES) ?></p>
  </div>
  <div id="codeParticles" class="header-animation"></div>
</header>
<main>
  <div class="projects-grid">

    <div class="project-card">
      <img src="photos/pusheenweb.png" alt="<?= htmlspecialchars($t['pusheen_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
      <div class="project-content">
        <h3><?= htmlspecialchars($t['pusheen_title'], ENT_QUOTES) ?></h3>
        <p><?= htmlspecialchars($t['pusheen_desc'], ENT_QUOTES) ?></p>
        <a href="pusheenweb/index.html" class="project-link"><?= htmlspecialchars($t['pusheen_link'], ENT_QUOTES) ?></a>
      </div>
    </div>

      <div class="project-card">
      <img src="photos/lumiboard.png" alt="<?= htmlspecialchars($t['lumi_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
      <div class="project-content">
        <h3><?= htmlspecialchars($t['lumi_title'], ENT_QUOTES) ?></h3>
        <p><?= htmlspecialchars($t['lumi_desc'], ENT_QUOTES) ?></p>
        <a href="lumiboard/index.html" class="project-link"><?= htmlspecialchars($t['lumi_link'], ENT_QUOTES) ?></a>
      </div>
    </div>
  </div>
</main>

<footer>
  <p>&copy; 2025 <a style="color: #3557b3ff;" href="https://kotokk.dev">kotokk.dev</a><br><?= $t['footer'] ?>  </p>
</footer>
</body>
</html>
