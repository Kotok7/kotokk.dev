<?php
$lang_code = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'      => 'en',
        'meta_desc'      => 'Brilliant tutorial how to be a dev like Kotokk',
        'title'          => 'Kotokk - How to Be a Dev Like Me',
        'translate'      => 'Przetłumacz na Polski',
        'main_heading'   => 'How to Be a Dev Like Me',
        'subtitle'       => 'A slightly exaggerated but definitely accurate guide to being a developer like Kotokk',
        'steps' => [
            1 => ['title' => 'Start Your Day with Caffeine',
                  'desc'  => "Coffee isn't just a beverage, it's a <span class=\"highlight\">lifestyle</span>. The more expensive and complicated your coffee setup, the better developer you'll be. Scientific fact. <s>I don't actually drink coffee, that's why i suck</s>"],
            2 => ['title' => 'Stare at the Screen in Confusion',
                  'desc'  => 'Spend at least 30 minutes every morning staring at your own code from yesterday, wondering who wrote this mess and why they hate you so much.'],
            3 => ['title' => 'Google Everything',
                  'desc'  => 'True developers don\'t memorize; they Google. If you\'re not searching "how to center a div" at least once a week, are you even coding?'],
            4 => ['title' => 'Stack Overflow is Your Best Friend',
                  'desc'  => 'Copy and paste code from Stack Overflow without fully understanding it. If it works, you\'re a genius! If it doesn\'t, blame the original poster.'],
            5 => ['title' => 'Install ChatGPT',
                  'desc'  => 'Install ChatGPT on your computer to ask "how to center a div" faster'],
            6 => ['title' => 'Change Your Theme Constantly',
                  'desc'  => 'Spend more time customizing your IDE theme than actually writing code. Dark mode is not just a preference; it\'s your personality now. That\'s because white attracts bugs'],
            7 => ['title' => 'Blame the Framework',
                  'desc'  => 'When something doesn\'t work, it\'s never your fault. It\'s a bug in the framework, the language, or possibly the universe itself.'],
            8 => ['title' => 'Collect Stickers',
                  'desc'  => 'Your laptop is not complete without at least 20 tech stickers (Scratch sticker required). Your coding ability is directly proportional to how many stickers you have.'],
            9 => ['title' => 'Overcomplicate Simple Tasks',
                  'desc'  => 'Need to display a simple list? Better use a state management library, three custom hooks, and a microservice architecture. Just to be safe.'],
        ],
        'quote'          => '“I don\'t always test my code, but when I do, I do it in production.”',
        'footer'         => '© 2025 kotokk.dev | Caffeine-Powered Development',
        'btn_text'       => 'Buy Me a Coffee',
        'alert_message'  => 'I don\'t know backend, so you can\'t☕',
        'back_button'    => 'Back to main page',
    ],
    'pl' => [
        'html_lang'      => 'pl',
        'meta_desc'      => 'Świetny poradnik jak zostać developerem jak Kotokk',
        'title'          => 'Kotokk - Jak zostać programistą jak ja',
        'translate'      => 'Translate to English',
        'main_heading'   => 'Jak zostać programistą jak ja',
        'subtitle'       => 'Trochę przesadzony, ale w 100% trafny przewodnik po byciu deweloperem jak Kotokk',
        'steps' => [
            1 => ['title' => 'Zacznij dzień od kofeiny',
                  'desc'  => 'Kawa to nie tylko napój, to <span class="highlight">styl życia</span>. Im droższy i bardziej skomplikowany twój zestaw do kawy, tym lepszym programistą będziesz. Fakt naukowy.'],
            2 => ['title' => 'Wpatruj się w ekran z konsternacją',
                  'desc'  => 'Spędź co najmniej 30 minut każdego ranka, wpatrując się w swój kod z wczoraj, zastanawiając się, kto go napisał i dlaczego każdy cię nienawidzi.'],
            3 => ['title' => 'Google’uj wszystko',
                  'desc'  => 'Prawdziwi deweloperzy nie zapamiętują; oni Googlują. Jeśli nie wyszukujesz „jak wycentrować div” przynajmniej raz w tygodniu, czy w ogóle kodujesz?'],
            4 => ['title' => 'Stack Overflow to twój najlepszy przyjaciel',
                  'desc'  => 'Kopiuj i wklejaj kod ze Stack Overflow bez pełnego zrozumienia. Jeśli działa, jesteś geniuszem! Jeśli nie, obwiniaj autora kodu.'],
            5 => ['title' => 'Zainstaluj ChatGPT',
                  'desc'  => 'Zainstaluj ChatGPT na kompie, żeby szybciej pytać „jak wycentrować div”'],
            6 => ['title' => 'Ciągle zmieniaj motyw',
                  'desc'  => 'Spędzaj więcej czasu na dostosowywaniu motywu IDE niż na pisaniu kodu. Tryb ciemny to nie tylko preferencja; to twoja osobowość. To dlatego, że biały przyciąga bugi.'],
            7 => ['title' => 'Winić framework',
                  'desc'  => 'Gdy coś nie działa, to nigdy nie twoja wina. To błąd w frameworku, języku albo we wszechświecie.'],
            8 => ['title' => 'Zbieraj naklejki',
                  'desc'  => 'Twój laptop nie jest kompletny bez przynajmniej 20 naklejek (Naklejka scratch obowiązkowa). Twoje umiejętności są wprost proporcjonalne do liczby naklejek.'],
            9 => ['title' => 'Utrudniaj proste zadania',
                  'desc'  => 'Potrzebujesz wyświetlić prostą listę? Lepiej użyć biblioteki do zarządzania stanem, trzech hooków i mikroserwisów. Dla pewności.'],
        ],
        'quote'          => '„Nie zawsze testuję kod, ale gdy to robię, robię to w produkcji.”',
        'footer'         => '© 2025 kotokk.dev | Zasilane kofeiną',
        'btn_text'       => 'Postaw mi kawę',
        'alert_message'  => 'Nie znam backendu, więc nie możesz☕',
        'back_button'    => 'Wróć do strony głównej',
    ],
];

if (!isset($translations[$lang_code])) {
    $lang_code = 'en';
}
$t = $translations[$lang_code];
?>
<!DOCTYPE html>
<html lang="<?= $t['html_lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $t['meta_desc'] ?>" />
    <title><?= $t['title'] ?></title>
    <link rel="icon" type="image/png" href="website-icon.png" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <div class="floating-elements">
            <div class="floating-element" style="top: 10%; left: 10%; font-size: 2rem;">{ }</div>
            <div class="floating-element" style="top: 20%; left: 70%; font-size: 1.8rem;">< /></div>
            <div class="floating-element" style="top: 70%; left: 20%; font-size: 1.5rem;">#</div>
            <div class="floating-element" style="top: 60%; left: 80%; font-size: 2.2rem;">;</div>
            <div class="floating-element" style="top: 40%; left: 40%; font-size: 2rem;">$</div>
            <div class="floating-element" style="top: 30%; left: 90%; font-size: 1.7rem;">()</div>
        </div>
        <div class="header-content">
                                                  <button onclick="window.location.href='/index.php'" class="back-button">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m12 19-7-7 7-7"/>
    <path d="M19 12H5"/>
  </svg>
<?= htmlspecialchars($t['back_button'], ENT_QUOTES) ?>
</button><br>
            <a href="?lang=<?= $lang_code === 'pl' ? 'en' : 'pl' ?>">
                <img src="<?= $lang_code === 'pl' ? 'united-states.png' : 'poland.png' ?>"
                     alt="<?= $t['translate'] ?>"
                     title="<?= $t['translate'] ?>"
                     loading="lazy"
                     style="width: 30px; height: 30px;">
            </a>
            <h1><?= $t['main_heading'] ?></h1>
            <p class="subtitle"><?= $t['subtitle'] ?></p>
        </div>
    </header>

    <main>
        <?php foreach ($t['steps'] as $num => $step): ?>
        <div class="step-container">
            <span class="step-number"><?= $num ?></span>
            <h2><?= $step['title'] ?></h2>
            <div class="step-content">
                <p><?= $step['desc'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="dev-quote">
            <?= $t['quote'] ?>
        </div>
    </main>

    <footer>
        <p><?= $t['footer'] ?></p>
        <button class="coffee-btn" onclick="pokazAlert()"><?= $t['btn_text'] ?></button>
        <script>
          function pokazAlert() {
            alert("<?= $t['alert_message'] ?>");
          }
        </script>
    </footer>
    <script src="script.js"></script>
</body>
</html>