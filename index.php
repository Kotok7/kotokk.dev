<?php
date_default_timezone_set('Europe/Warsaw');
$polishHour = (int) date('G');

  $counter = include __DIR__ . '/daily_counter.php';
  $dailyVisits    = $counter['dailyVisits'];
  $isFirstVisitor = $counter['isFirstVisitor'];

$lang_code = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'        => 'en',
        'title'            => 'Kotokk - My portfolio',
        'meta_description' => 'My portfolio',
        'translate'        => 'Przetłumacz na Polski',
        'unique_visitors'  => 'Unique visitors:',
        'main_title'       => 'My Portfolio',
        'subtitle'         => 'Content Creator | Fullstack web developer',
        'facts_title'      => 'Programming Quotes, Jokes & Facts',
        'facts_title2'     => 'Random quote or joke',
        'facts_desc'       => 'Interesting quotes, funny jokes and facts you did not know!',
        'facts_link'       => 'Explore',
        'facts_error'      => 'Message must be between 3 and 100 characters long.',
        'wait'             => 'You must wait 10 minutes before sending another message, and until the verification is complete.',
        'message_leave'    => 'Leave your message here',
        'message_letknow'  => 'Tell me what could i change on my website or just say hi!',
        'nick'             => 'Your nick',
        'about_title'      => 'About Me (recommended)',
        'about_desc'       => 'Learn about who I am, what tools do i use and more',
        'about_link'       => 'View Profile',
        'cyber_title'      => 'Pentesting devices',
        'cyber_desc'       => 'All of my devices I use and share on TikTok',
        'cyber_link'       => 'Learn More',
        'dev_title'        => 'How to be like me',
        'dev_desc'         => 'How to become the best developer in the world',
        'dev_link'         => 'Start Learning',
        'blog_title'       => 'My blog',
        'blog_desc'        => 'Blog where I share topics and insights that interest me.',
        'blog_link'        => 'Read now',
        'other_title'      => 'Unfinished projects',
        'other_desc'       => 'All the unfinished projects, that will be avaiable on the main page soon! Or maybe they will not...',
        'other_link'       => 'See now',
        'quiz_title'       => 'Quiz about me',
        'quiz_desc'        => 'A web quiz that tests how well you know my programming preferences, favorite languages and more!',
        'quiz_link'        => 'Solve',
        'chat_title'       => 'Live Chat',
        'chat_desc'        => 'A simple real-time web chat with live user count, image and voice messages sharing!',
        'chat_link'        => 'Start texting',
        'quantum_title'    => 'Quantum tools',
        'quantum_desc'     => 'A simple website with some shitty "tools": age calculator, fake server stats, name checker, weather app and a calculator. The program was originally written in Python and later rewritten as a web version.',
        'quantum_link'     => 'Take a look',
        'share_title'      => 'Share sites',
        'share_desc'       => 'Share interesting sites with other people or rate and explore other sites!',
        'share_link'       => 'Discover',
        'screentime_title' => 'iOS screentime emulator',
        'screentime_desc'  => 'This website emulates the iOS screen time page on a website so you can get your screen time password from your parent.',
        'screentime_link'  => 'Emulate',
        'music_title'      => 'Share and discover songs',
        'music_desc'       => 'Share your favourite songs and discover new music!',
        'music_link'       => 'Discover',
        'convert_title'    => 'Time Converter',
        'convert_desc'     => 'Quickly convert seconds, minutes, hours, days, months, and years – for example, find out how many seconds are in a year or how many days are in a month.',
        'convert_link'     => 'Convert',
        'quotes_title'     => 'Add and discover quotes!',
        'quotes_desc'      => 'Add, discover, view and save quotes!',
        'quotes_link'      => 'Discover',
        'story_title'      => 'Collaborative Story',
        'story_desc'       => 'Everyone adds one sentence and has a one-hour cooldown.',
        'story_link'       => 'Read',
        'draw_title'       => 'Drawall',
        'draw_desc'        => 'Wall where everyone can draw whatever they want!',
        'draw_link'        => 'Draw',
        'footer'           => 'All rights reserved.<br>Thanks to <a href="https://about-tymianekk.netlify.app" target="_blank">@tymianekk_</a> for help and ideas.<br> Icons from <a href="https://flaticon.com" target="_blank">Flaticon</a>.',
        'time'             => 'Time in my country:',
        'temp'             => 'Temperature in my city:',
        'my_desc'          => 'I am a teenager from Kraśnik, Poland, who loves programming!<br>Pronouns: he/him<br>Programming languages: HTML, CSS, Javascript, PHP and Python<br>kotokk.dev is my main project<br>More about me below',
        'add_button'       => 'Add',
        'sort_select1'     => 'Most interesting (default)',
        'sort_select2'     => 'Last updated',
        'donate'           => 'Donate me',
        'donate2'          => 'Crypto adresses (click to copy)',
        'btc_message'      => 'Bitcoin adress: ',
        'btc_adress'       => 'bc1qf250fv8zhhhrg092n9jrgt5dfahpztjrxup78t',
        'eth_message'      => 'Etherium adress: ',
        'eth_adress'       => '0x0F3aeA458DA2186fbeEDcDAe529f73ae2D11A1d7',
        'xrp_message'      => 'XRP adress: ',
        'xrp_adress'       => 'rfnx4UoHkUWRsycfSGJMT9cfJapZ31Poqy',
        'sol_message'      => 'Solana adress: ',
        'sol_adress'       => '91gvsiPKbAGa4khrqK663gjSoPQRMNaNKVXFFHe9Tz2Y',
        'doge_message'     => 'Doge adress: ',
        'doge_adress'      => 'DMoJwdVT4KkaLAvArfZ5M2zfmFtzXADL4N',
        'pepe_message'     => 'Pepe adress: ',
        'pepe_adress'      => '0x0F3aeA458DA2186fbeEDcDAe529f73ae2D11A1d7',
        'ltc_message'      => 'Litecoin adress: ',
        'ltc_adress'       => 'LeXnrUNr2syu8gAPKLQowvhVv6Dzf7bPRZ',
        'bnc_message'      => 'Binance adress: ',
        'bnc_adress'       => '0x0F3aeA458DA2186fbeEDcDAe529f73ae2D11A1d7',
        'copied_crypto'    => 'Copied',
        'polish_room'      => 'Polish room',
        'english_room'     => 'English room',
        'discord_note'     => 'Note: ',
        'discord_status'   => 'Status: ',
        'github1'          => 'Now on GitHub',
        'github2'          => 'View source and contribute',
        'changelog'        => '<ul><li>Added "donate me" option with crypto adresses</li><li>Added 404 not found site</li><li>Added new iOS screen time emulator to the main page</li><li>Added a small badge on the top</li><li>Added Binance crypto adress</li><li>Added a popup informing that the site is on GitHub</li><li>Added GitHub widget</li></ul>',
        'star_github'      => 'Star on GitHub!',
        'last_updated'     => 'Last updated: ',
        'checking_commit'  => 'Checking last commit...',
        'show_more'        => 'Show more',
        'show_less'        => 'Show less',
        'commit_loading'   => 'Loading...',
        'sleeping'         => [
            'question' => 'Am I sleeping right now?',
            'yes'      => 'Yes💤',
            'no'       => 'No🚀',
        ],
        'daily_visits_label'   => 'Visits today:',
        'first_visit_title'    => '🎉 You are the first visitor today!',
        'first_visit_message'  => 'Thank you for being here first.',
        'first_visit_close'    => 'Close',
    ],

    'pl' => [
        'html_lang'        => 'pl',
        'title'            => 'Kotokk - Moje portfolio',
        'meta_description' => 'Moje portfolio',
        'translate'        => 'Przetłumacz na angielski',
        'unique_visitors'  => 'Unikalni odwiedzający:',
        'main_title'       => 'Moje Portfolio',
        'subtitle'         => 'Twórca treści | Fullstack web developer',
        'facts_title'      => 'Cytaty, żarty i ciekawostki programistyczne (brak tłumaczenia)',
        'facts_title2'     => 'Losowy cytat lub żart (tylko po angielsku)',
        'facts_desc'       => 'Ciekawe cytaty, śmieszne żarty i fakty, których nie znałeś!',
        'facts_link'       => 'Eksploruj',
        'facts_error'      => 'Wiadomość musi mieć od 3 do 100 znaków.',
        'wait'             => 'Musisz odczekać 10 minut przed wpisaniem kolejnej wiadomości oraz poczekać na zakończenie weryfikacji.',
        'message_leave'    => 'Zostaw swoją wiadomość tutaj',
        'message_letknow'  => 'Powiedz co mógłbym zmienić na stronie lub po prostu się przywitaj!',
        'nick'             => 'Twój pseudonim',
        'about_title'      => 'O mnie (rekomendowane)',
        'about_desc'       => 'Dowiedz się kim jestem, jakich narzędzi używam i więcej',
        'about_link'       => 'Zobacz profil',
        'cyber_title'      => 'Narzędzia pentestingu',
        'cyber_desc'       => 'Wszystkie narzędzia, których używam i którymi dzielę się na TikToku',
        'cyber_link'       => 'Dowiedz się więcej',
        'dev_title'        => 'Jak być jak ja',
        'dev_desc'         => 'Jak zostać najlepszym programistą na świecie',
        'dev_link'         => 'Zacznij naukę',
        'blog_title'       => 'Mój blog',
        'blog_desc'        => 'Blog, gdzie dzielę się tematami i przemyśleniami, które mnie interesują.',
        'blog_link'        => 'Czytaj',
        'other_title'      => 'Nieukończone projekty',
        'other_desc'       => 'Nieukończone projekty które wkrótce będą dostępne na stronie głównej! Albo może i nie będą...',
        'other_link'       => 'Zobacz',
        'quiz_title'       => 'Quiz o mnie',
        'quiz_desc'        => 'Quiz internetowy, który sprawdzi, jak dobrze znasz moje preferencje programistyczne, ulubione języki i więcej!',
        'quiz_link'        => 'Rozwiąż',
        'chat_title'       => 'Live Chat',
        'chat_desc'        => 'Prosty czat internetowy w czasie rzeczywistym z opcjonalnym udostępnianiem obrazów, wiadomości głosowych i licznikiem aktywnych użytkowników na żywo!',
        'chat_link'        => 'Zacznij pisać',
        'quantum_title'    => 'Narzędzia kwantowe',
        'quantum_desc'     => 'Prosta strona internetowa z paroma "narzędziami": kalkulatorem wieku, fałszywymi statystykami serwera, sprawdzaczem imion, aplikacją pogodową i kalkulatorem. Program został przepisany z wersji w Pythonie na HTML.',
        'quantum_link'     => 'Przejrzyj',
        'share_title'      => 'Udostępniaj strony internetowe',
        'share_desc'       => 'Udostępniaj ciekawe strony internetowe z innymi ludźmi, oraz oceniaj i odkrywaj nowe strony internetowe!',
        'share_link'       => 'Odkryj',
        'screentime_title' => 'Emulator czasu przed ekranem iOS',
        'screentime_desc'  => 'Ta strona internetowa emuluje stronę czasu przed ekranem z iOS, abyś mógł uzyskać hasło do czasu przed ekranem od swojego rodzica.',
        'screentime_link'  => 'Emuluj',
        'music_title'      => 'Udostępniaj i odkrywaj piosenki',
        'music_desc'       => 'Udostępniaj swoje ulubione piosenki i odkrywaj nową muzykę!',
        'music_link'       => 'Posłuchaj',
        'convert_title'    => 'Konwerter czasu',
        'convert_desc'     => 'Szybko zamieniaj sekundy, minuty, godziny, dni, miesiące i lata – np. sprawdź, ile sekund ma rok lub ile dni ma miesiąc.',
        'convert_link'     => 'Konwertuj',
        'quotes_title'     => 'Dodawaj i odkrywaj cytaty!',
        'quotes_desc'      => 'Dodawaj, odkrywaj, oglądaj i zapisuj cytaty!',
        'quotes_link'      => 'Odkrywaj',
        'story_title'      => 'Wspólna opowieść',
        'story_desc'       => 'Każdy dodaje po jednym zdaniu i ma cooldown na godzinę.',
        'story_link'       => 'Przeczytaj',
        'draw_title'       => 'Drawall',
        'draw_desc'        => 'Ściana gdzie każdy może rysować co tylko chce!',
        'draw_link'        => 'Rysuj',
        'footer'           => 'Wszelkie prawa zastrzeżone.<br>Podziękowania dla <a href="https://about-tymianekk.netlify.app" target="_blank">@tymianekk_</a> za pomysły i pomoc.<br> Ikony z <a href="https://flaticon.com" target="_blank">Flaticon</a>.',
        'time'             => 'Czas w moim kraju:',
        'temp'             => 'Temperatura w moim mieście:',
        'my_desc'          => 'Jestem nastolatkiem z Kraśnika w Polsce, który uwielbia programować!<br>Zaimki: on/jego<br>Języki programowania: HTML, CSS, Javascript, PHP i Python<br>kotokk.dev to mój główny projekt<br>Więcej o mnie poniżej',
        'add_button'       => 'Dodaj',
        'sort_select1'     => 'Najciekawsze (domyślne)',
        'sort_select2'     => 'Ostatnio uaktualnione',
        'donate'           => 'Wesprzyj mnie',
        'donate2'          => 'Adresy krypto (kliknij aby skopiować)',
        'btc_message'      => 'Adres Bitcoin: ',
        'btc_adress'       => 'bc1qf250fv8zhhhrg092n9jrgt5dfahpztjrxup78t',
        'eth_message'      => 'Adres Etherium: ',
        'eth_adress'       => '0x0F3aeA458DA2186fbeEDcDAe529f73ae2D11A1d7',
        'xrp_message'      => 'Adres XRP: ',
        'xrp_adress'       => 'rfnx4UoHkUWRsycfSGJMT9cfJapZ31Poqy',
        'sol_message'      => 'Adres Solana: ',
        'sol_adress'       => '91gvsiPKbAGa4khrqK663gjSoPQRMNaNKVXFFHe9Tz2Y',
        'doge_message'     => 'Adres Doge: ',
        'doge_adress'      => 'DMoJwdVT4KkaLAvArfZ5M2zfmFtzXADL4N',
        'pepe_message'     => 'Adres Doge: ',
        'pepe_adress'      => '0x0F3aeA458DA2186fbeEDcDAe529f73ae2D11A1d7',
        'ltc_message'      => 'Adres Litecoin: ',
        'ltc_adress'       => 'LeXnrUNr2syu8gAPKLQowvhVv6Dzf7bPRZ',
        'bnc_message'      => 'Adres Binance: ',
        'bnc_adress'       => '0x0F3aeA458DA2186fbeEDcDAe529f73ae2D11A1d7',
        'copied_crypto'    => 'Skopiowano',
        'polish_room'      => 'Polski czat',
        'english_room'     => 'Angielski czat',
        'discord_note'     => 'Notatka: ',
        'discord_status'   => 'Status: ',
        'changelog'        => '<ul><li>Dodano opcje "wesprzyj mnie" z adresami crypto</li><li>Dodano stronę 404</li><li>Dodano nowy emulator czasu przed ekranem do strony głównej</li><li>Dodano małą plakietkę na górze strony</li><li>Dodano adres Binance do adresów krypto</li><li>Dodano popup informujący o tym że strona jest na GitHubie</li><li>Dodano widget GitHuba</li></ul>',
        'github1'          => 'Od teraz na GitHubie',
        'github2'          => 'Zobacz kod i kontrybuuj',
        'star_github'      => 'Dodaj gwiazdkę na GitHubie!',
        'checking_commit'  => 'Sprawdzanie ostatniego commita...',
        'last_updated'     => 'Ostatnio aktualizowane: ',
        'commit_loading'   => 'Ładowanie...',
        'show_more'        => 'Pokaż więcej',
        'show_less'        => 'Pokaż mniej',
        'sleeping'         => [
            'question' => 'Czy teraz śpię?',
            'yes'      => 'Tak💤',
            'no'       => 'Nie🚀',
        ],
        'daily_visits_label'   => 'Liczba wizyt dzisiaj:',
        'first_visit_title'    => '🎉 Jesteś pierwszą osobą w tym dniu!',
        'first_visit_message'  => 'Dziękuję za odwiedziny.',
        'first_visit_close'    => 'Zamknij',
    ],
];

$t = $translations[$lang_code] ?? $translations['en'];

$ipsFile = __DIR__ . '/ips.json';
if (file_exists($ipsFile)) {
    $ips = json_decode(file_get_contents($ipsFile), true);
    if (!is_array($ips)) {
        $ips = [];
    }
} else {
    $ips = [];
}

$visitorIp = $_SERVER['REMOTE_ADDR'] ?? '';
if ($visitorIp && !in_array($visitorIp, $ips, true)) {
    $ips[] = $visitorIp;
    file_put_contents(
        $ipsFile,
        json_encode($ips, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

$uniqueVisitors = count($ips);

$city = 'Krasnik';
$apiKey = 'e4c067643e5b5a18dd302f81fad75337';
$apiLang = ($lang_code === 'pl') ? 'pl' : 'en';
$url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city)
       . "&appid={$apiKey}&units=metric&lang={$apiLang}";
$weatherJson = @file_get_contents($url);
if ($weatherJson !== false) {
    $w = json_decode($weatherJson, true);
    if (
        isset($w['main']['temp'])
        && isset($w['weather'][0]['description'])
        && isset($w['weather'][0]['icon'])
    ) {
        $temp = $w['main']['temp'];
        $desc = $w['weather'][0]['description'];
        $iconUrl = "https://openweathermap.org/img/wn/" . $w['weather'][0]['icon'] . "@2x.png";
    } else {
        $temp = null;
        $desc = '';
        $iconUrl = '';
    }
} else {
    $temp = null;
    $desc = '';
    $iconUrl = '';
}

if ($temp !== null) {
    $tempStr = number_format((float)$temp, 1, ',', '');
} else {
    $tempStr = null;
}

$localTime  = date('H:i');
$storedNick = $_COOKIE['blog_nick'] ?? '';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($t['html_lang'], ENT_QUOTES) ?>">
<head>
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
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
  <button id="backToTop" class="back-to-top" title="Wróć na górę">
  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <polyline points="18,15 12,9 6,15"></polyline>
  </svg>
</button>
<script src="back-to-top.js"></script>
<header>
  <a href="?lang=<?= $lang_code === 'pl' ? 'en' : 'pl' ?>">
    <img src="photos/<?= $lang_code === 'pl' ? 'united-states.png' : 'poland.png' ?>"
         alt="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
         title="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
         width="30" height="30" loading="lazy">
  </a>
  <div class="header-content">
    <div class="visitor-counter">
      <?= htmlspecialchars($t['unique_visitors'], ENT_QUOTES) ?>
      <span class="number"><?= htmlspecialchars($uniqueVisitors, ENT_QUOTES) ?></span>
    </div>

    <div class="visitor-counter">
  <?= htmlspecialchars($t['daily_visits_label'], ENT_QUOTES) ?>
  <span class="number"><?= htmlspecialchars($dailyVisits, ENT_QUOTES) ?></span>
</div>

<?php if ($isFirstVisitor): ?>
   <div id="fv-modal">
    <div class="box">
      <h2><?= htmlspecialchars($t['first_visit_title'], ENT_QUOTES) ?></h2>
      <p><?= htmlspecialchars($t['first_visit_message'], ENT_QUOTES) ?></p>
      <button onclick="closeModal()">
        <?= htmlspecialchars($t['first_visit_close'], ENT_QUOTES) ?>
      </button>
    </div>
  </div>
  
  <script>
    function closeModal() {
      const modal = document.getElementById('fv-modal');
      modal.classList.add('closing');
      setTimeout(() => {
        modal.remove();
      }, 200);
    }
  </script>
<?php endif; ?>

    <br>
    <h1><?= htmlspecialchars($t['main_title'], ENT_QUOTES) ?><span class="cursor"></span></h1>
    <p><?= htmlspecialchars($t['subtitle'], ENT_QUOTES) ?></p>
    <br>
    <p>
  <?= $t['my_desc'] ?>
</p>
    <div class="social-icons">
      <a href="https://github.com/Kotok7/kotokk.dev" class="social-icon" title="GitHub"><i class="fab fa-github"></i></a>
      <a href="https://tiktok.com/@kotokk_dev" class="social-icon" title="TikTok"><i class="fab fa-tiktok"></i></a>
      <a href="https://discord.gg/xPaqvs5NHk" class="social-icon" title="Discord"><i class="fab fa-discord"></i></a>
    </div>
<p id="timeIndicator">
  <?= htmlspecialchars($t['time'], ENT_QUOTES) ?> <strong><?= htmlspecialchars($localTime, ENT_QUOTES) ?></strong>
</p>

<?php if ($tempStr !== null): ?>
  <p id="tempIndicator">
    <?= htmlspecialchars($t['temp'], ENT_QUOTES) ?>
    <strong><?= htmlspecialchars($tempStr, ENT_QUOTES) ?>°C</strong>
    <?php if (!empty($iconUrl)): ?>
      <img src="<?= htmlspecialchars($iconUrl, ENT_QUOTES) ?>"
           alt="<?= htmlspecialchars($desc, ENT_QUOTES) ?>"
           class="weather-icon"
           loading="lazy">
    <?php endif; ?>
  </p>
<?php else: ?>
  <p id="tempIndicator">
    <?= htmlspecialchars($t['temp'], ENT_QUOTES) ?> <strong>—</strong>
  </p>
<?php endif; ?>

<br>
<div id="sleepIndicator"></div>

<script>
  let currentLanguage = <?= json_encode($lang_code, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>;
</script>
    <div class="widgets-container">
        <div>
            
            <div id="game-div">
                <div class="image-status">
                    <img src="photos/discord-profile.jpg" style="border-radius: 50px;">
                    <div id="status-mini-icon">
                        <div id="status-mini-icon-2"></div>
                    </div>
                </div>
                <div class="status-div">
                    <strong>@kotokk_dev</strong>
<p>
  <strong><?= htmlspecialchars($t['discord_status'], ENT_QUOTES) ?></strong>
  <span id="status"></span>
</p>
                    <p id="game"></p>
                    <div id="game-time-container" style="display:none;"></div>
  <strong id="game-time"></strong>
<p>
  <strong><?= htmlspecialchars($t['discord_note'], ENT_QUOTES) ?></strong>
  <span id="note"></span>
</p>
                </div>
            </div>
        </div>
</div>
    <script src="discord.js"></script>
<section class="quote-display">
  <h2><?= htmlspecialchars($t['facts_title2'], ENT_QUOTES) ?></h2>
  <?php
    $quotesFile = __DIR__ . '/quotes.json';
    if (!file_exists($quotesFile)) {
        file_put_contents($quotesFile, json_encode([], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
    $quotes = json_decode(file_get_contents($quotesFile), true) ?: [];
    $randomQuote = $quotes ? $quotes[array_rand($quotes)] : '';
  ?>
  <?php if ($randomQuote): ?>
    <blockquote><?= htmlspecialchars($randomQuote, ENT_QUOTES) ?></blockquote>
  <?php else: ?>
    <p><?= htmlspecialchars($t['facts_error'], ENT_QUOTES) ?></p>
  <?php endif; ?>
</section>

</div>
<div id="codeParticles" class="header-animation"></div>
</header>
<main>

<div id="sortCustom" class="custom-select">
  <div class="select-trigger"><?= htmlspecialchars($t['sort_select1'], ENT_QUOTES) ?></div>
  <div class="custom-options">
    <div class="option" data-value="1"><?= htmlspecialchars($t['sort_select1'], ENT_QUOTES) ?></div>
    <div class="option" data-value="2"><?= htmlspecialchars($t['sort_select2'], ENT_QUOTES) ?></div>
  </div>
</div>
<br>

<div id="projectsContainer" class="projects-grid">

<div class="project-card1" data-sort1="1" data-sort2="1">
  <div class="project-content1">
    <h3><?= htmlspecialchars($t['github1'], ENT_QUOTES) ?></h3>
    <p><?= htmlspecialchars($t['github2'], ENT_QUOTES) ?></p>

<div class="stats-widget">
  <div class="badge-compact" id="badge-compact">
    <a href="https://github.com/Kotok7"><img src="https://img.shields.io/github/followers/Kotok7?label=Follow&style=social" alt="Follow button"></a>
    <a href="https://github.com/Kotok7/kotokk.dev"><img src="https://img.shields.io/github/stars/Kotok7/kotokk.dev?style=social&label=Star" alt="GitHub stars"></a>
    <div style="flex-basis:100%; height:0;"></div>
  <!-- Core GitHub badges -->
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/v/release/Kotok7/kotokk.dev?include_prereleases" alt="Release">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/release-date/Kotok7/kotokk.dev?include_prereleases" alt="Release Date">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/last-commit/Kotok7/kotokk.dev.svg?style=flat-square" alt="Last Commit">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/commits-since/Kotok7/kotokk.dev/latest?include_prereleases" alt="Commits Since Latest">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/commit-activity/w/Kotok7/kotokk.dev" alt="Weekly Commits">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/commit-activity/m/Kotok7/kotokk.dev" alt="Monthly Commits">
  <div style="flex-basis:100%; height:0;"></div>

  <!-- Repository metadata -->
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/repo-size/Kotok7/kotokk.dev.svg?style=flat-square" alt="Repo Size">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/contributors/Kotok7/kotokk.dev.svg?style=flat-square" alt="Contributors">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/languages/count/Kotok7/kotokk.dev" alt="Languages">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/directory-file-count/Kotok7/kotokk.dev" alt="File Count">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/created-at/Kotok7/kotokk.dev" alt="Created At">
  <div style="flex-basis:100%; height:0;"></div>

  <!-- Issue / PR status -->
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/issues/Kotok7/kotokk.dev.svg?style=flat-square" alt="Open Issues">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/github/issues-pr/Kotok7/kotokk.dev.svg?style=flat-square" alt="Open PRs">
  <div style="flex-basis:100%; height:0;"></div>

  <!-- Site stats & performance -->
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/badge/Uptime-90%25-brightgreen" alt="Uptime">
  <img loading="lazy" style="height:17px;width:auto !important;" src="https://img.shields.io/badge/CDN-Cloudflare-F38020?logo=cloudflare&logoColor=white" alt="CDN">
  <div style="flex-basis:100%; height:0;"></div>
</div>
  <button id="toggle-badges" class="btn-toggle">
    <i class="fas fa-chevron-down"></i>
    <span><?= htmlspecialchars($t['show_more'], ENT_QUOTES) ?></span>
  </button>
<script src="badges.js"></script>

      <div class="commit-info">
        <ul id="commit-list" class="commit-list">
          <li class="loading"><?= htmlspecialchars($t['commit_loading'], ENT_QUOTES) ?></li>
        </ul>
        <button id="toggle-commits" class="btn-toggle"><?= htmlspecialchars($t['show_more'], ENT_QUOTES) ?></button>
      </div>
    </div>
</div>
</div>
<script src="github.js"></script>

<div class="project-card" data-sort1="2" data-sort2="6">
    <img src="photos/about-me.png" alt="<?= htmlspecialchars($t['about_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>31 July</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['about_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['about_desc'], ENT_QUOTES) ?></p>
      <a href="about-me/index.html" class="project-link"><?= htmlspecialchars($t['about_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="3" data-sort2="7">
    <img src="photos/chat.png" alt="<?= htmlspecialchars($t['chat_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>30 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['chat_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['chat_desc'], ENT_QUOTES) ?></p>
      <a href="chat/index.php" class="project-link"><?= htmlspecialchars($t['chat_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="4" data-sort2="8">
    <img src="photos/share.png" alt="<?= htmlspecialchars($t['share_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>4 July</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['share_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['share_desc'], ENT_QUOTES) ?></p>
      <a href="share-sites/index.php" class="project-link"><?= htmlspecialchars($t['share_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="5" data-sort2="9">
    <img src="photos/share-music.png" alt="<?= htmlspecialchars($t['music_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>21 July</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['music_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['music_desc'], ENT_QUOTES) ?></p>
      <a href="share-music/index.php" class="project-link"><?= htmlspecialchars($t['music_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="6" data-sort2="2">
    <img src="photos/draw.png" alt="<?= htmlspecialchars($t['draw_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>10 August</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['draw_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['draw_desc'], ENT_QUOTES) ?></p>
      <a href="drawall/index.php" class="project-link"><?= htmlspecialchars($t['draw_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="7" data-sort2="4">
    <img src="photos/quotes.png" alt="<?= htmlspecialchars($t['quotes_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>9 August</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['quotes_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['quotes_desc'], ENT_QUOTES) ?></p>
      <a href="quotes/index.php" class="project-link"><?= htmlspecialchars($t['quotes_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="8" data-sort2="3">
    <img src="photos/story.png" alt="<?= htmlspecialchars($t['story_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>9 August</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['story_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['story_desc'], ENT_QUOTES) ?></p>
      <a href="story/index.php" class="project-link"><?= htmlspecialchars($t['story_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="9" data-sort2="15">
    <img src="photos/qjf.png" alt="<?= htmlspecialchars($t['facts_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>May</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['facts_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['facts_desc'], ENT_QUOTES) ?></p>
      <a href="facts/index.html" class="project-link"><?= htmlspecialchars($t['facts_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="10" data-sort2="16">
    <img src="photos/dev.png" alt="<?= htmlspecialchars($t['dev_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>May</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['dev_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['dev_desc'], ENT_QUOTES) ?></p>
      <a href="tutorial/index.php" class="project-link"><?= htmlspecialchars($t['dev_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="11" data-sort2="12">
    <img src="photos/quiz.png" alt="<?= htmlspecialchars($t['quiz_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>14 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['quiz_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['quiz_desc'], ENT_QUOTES) ?></p>
      <a href="quiz/index.html" class="project-link"><?= htmlspecialchars($t['quiz_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="12" data-sort2="13">
    <img src="photos/quantum.png" alt="<?= htmlspecialchars($t['quantium_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>13 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['quantum_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['quantum_desc'], ENT_QUOTES) ?></p>
      <a href="quantum-tools/index.html" class="project-link"><?= htmlspecialchars($t['quantum_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="13" data-sort2="7">
    <img src="photos/blog.png" alt="<?= htmlspecialchars($t['blog_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>26 July</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['blog_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['blog_desc'], ENT_QUOTES) ?></p>
      <a href="blog/index.php" class="project-link"><?= htmlspecialchars($t['blog_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="14" data-sort2="5">
    <img src="photos/time-converter.png" alt="<?= htmlspecialchars($t['convert_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>3 August</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['convert_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['convert_desc'], ENT_QUOTES) ?></p>
      <a href="time-converter/index.php" class="project-link"><?= htmlspecialchars($t['convert_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="15" data-sort2="17">
    <img src="photos/cybersecurity.png" alt="<?= htmlspecialchars($t['cyber_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>April</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['cyber_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['cyber_desc'], ENT_QUOTES) ?></p>
      <a href="cybersecurity/index.php" class="project-link"><?= htmlspecialchars($t['cyber_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="16" data-sort2="9">
    <img src="photos/screentime.png" alt="<?= htmlspecialchars($t['screentime_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>10 July</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['screentime_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['screentime_desc'], ENT_QUOTES) ?></p>
      <a href="screentime/index.html" class="project-link"><?= htmlspecialchars($t['screentime_link'], ENT_QUOTES) ?></a>
    </div>
</div>

<div class="project-card" data-sort1="17" data-sort2="14">
    <img src="photos/other.png" alt="<?= htmlspecialchars($t['other_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge"><?= htmlspecialchars($t['last_updated'], ENT_QUOTES) ?>04 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['other_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['other_desc'], ENT_QUOTES) ?></p>
      <a href="unfinished/index.php" class="project-link"><?= htmlspecialchars($t['other_link'], ENT_QUOTES) ?></a>
    </div>
</div>

</div>

<div class="two-columns">
  <section class="leave-message" id="leave-message-pl">
    <h2><?= htmlspecialchars($t['message_leave'], ENT_QUOTES) ?><br><?= htmlspecialchars($t['polish_room'], ENT_QUOTES) ?></h2>
    <?php if (!empty($_GET['msg_error'])): ?>
      <p class="error">
        <?= $_GET['msg_error'] === 'length' ? htmlspecialchars($t['facts_error'], ENT_QUOTES) : htmlspecialchars($t['wait'], ENT_QUOTES) ?>
      </p>
    <?php endif; ?>
    <form action="/add_message.php" method="post">
      <?php if ($storedNick): ?>
        <input type="text" name="nick" value="<?= htmlspecialchars($storedNick, ENT_QUOTES) ?>" readonly>
      <?php else: ?>
        <input type="text" name="nick" required minlength="2" maxlength="20" placeholder="<?= htmlspecialchars($t['nick'], ENT_QUOTES) ?>">
      <?php endif; ?>
      <textarea name="message" required minlength="3" maxlength="100" placeholder="<?= htmlspecialchars($t['message_letknow'], ENT_QUOTES) ?>"></textarea>
      <div class="cf-turnstile" data-sitekey="0x4AAAAAABd4n1oTvz_2DaHU"></div>
      <button type="submit"><?= htmlspecialchars($t['add_button'], ENT_QUOTES) ?></button>
    </form>
    <div class="messages-wrapper">
      <?php
      $msgs = json_decode(file_get_contents(__DIR__ . '/messages/messages.json'), true) ?: [];
      foreach (array_reverse($msgs) as $m) {
          echo '<blockquote><strong>' . htmlspecialchars($m['nick'], ENT_QUOTES) . '</strong>: ' .
               nl2br(htmlspecialchars($m['text'], ENT_QUOTES)) .
               '<br><small>' . htmlspecialchars($m['date'], ENT_QUOTES) . '</small></blockquote>';
      }
      ?>
    </div>
  </section>

  <section class="leave-message" id="leave-message-en">
    <h2><?= htmlspecialchars($t['message_leave'], ENT_QUOTES) ?><br><?= htmlspecialchars($t['english_room'], ENT_QUOTES) ?></h2>
    <?php if (!empty($_GET['msg_error'])): ?>
      <p class="error">
        <?= $_GET['msg_error'] === 'length' ? htmlspecialchars($t['facts_error'], ENT_QUOTES) : htmlspecialchars($t['wait'], ENT_QUOTES) ?>
      </p>
    <?php endif; ?>
    <form action="/add_message2.php" method="post">
      <?php if ($storedNick): ?>
        <input type="text" name="nick" value="<?= htmlspecialchars($storedNick, ENT_QUOTES) ?>" readonly>
      <?php else: ?>
        <input type="text" name="nick" required minlength="2" maxlength="20" placeholder="<?= htmlspecialchars($t['nick'], ENT_QUOTES) ?>">
      <?php endif; ?>
      <textarea name="message" required minlength="3" maxlength="100" placeholder="<?= htmlspecialchars($t['message_letknow'], ENT_QUOTES) ?>"></textarea>
      <div class="cf-turnstile" data-sitekey="0x4AAAAAABd4n1oTvz_2DaHU"></div>
      <button type="submit"><?= htmlspecialchars($t['add_button'], ENT_QUOTES) ?></button>
    </form>
    <div class="messages-wrapper">
      <?php
      $msgs2 = json_decode(file_get_contents(__DIR__ . '/messages/messages2.json'), true) ?: [];
      foreach (array_reverse($msgs2) as $m) {
          echo '<blockquote><strong>' . htmlspecialchars($m['nick'], ENT_QUOTES) . '</strong>: ' .
               nl2br(htmlspecialchars($m['text'], ENT_QUOTES)) .
               '<br><small>' . htmlspecialchars($m['date'], ENT_QUOTES) . '</small></blockquote>';
      }
      ?>
    </div>
  </section>
</div>
</main>

<footer>
  <button id="donateBtn"><?= htmlspecialchars($t['donate'], ENT_QUOTES) ?></button><br>
  <span id="exampleMsg" style="margin: 20px;"><?= htmlspecialchars($t['donate2'], ENT_QUOTES) ?></span>
<div id="wallet-container">
  <?= htmlspecialchars($t['btc_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['btc_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
<?= htmlspecialchars($t['eth_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['eth_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
<?= htmlspecialchars($t['xrp_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['xrp_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
<?= htmlspecialchars($t['sol_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['sol_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
<?= htmlspecialchars($t['doge_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['doge_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
<?= htmlspecialchars($t['pepe_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['pepe_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
<?= htmlspecialchars($t['ltc_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['ltc_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
<?= htmlspecialchars($t['bnc_message'], ENT_QUOTES) ?><span id="btcAddress"><?= htmlspecialchars($t['bnc_adress'], ENT_QUOTES) ?></span>
  <span id="copyMsg"><?= htmlspecialchars($t['copied_crypto'], ENT_QUOTES) ?></span><br>
</div><br>
  <p>&copy; 2025 <a href="https://kotokk.dev">kotokk.dev</a><br><?= $t['footer'] ?></p>
</footer>
<script>
(function(){
  const trigger = document.querySelector('.select-trigger');
  const optionsContainer = document.querySelector('.custom-options');
  const options = Array.from(document.querySelectorAll('.custom-options .option'));
  let currentValue = '1';

  trigger.addEventListener('click', ()=> {
    optionsContainer.style.display = 
      optionsContainer.style.display === 'flex' ? 'none' : 'flex';
  });

  options.forEach(opt => {
    opt.addEventListener('click', ()=>{
      const val = opt.dataset.value;
      const text = opt.textContent;
      currentValue = val;
      trigger.textContent = text;
      optionsContainer.style.display = 'none';
      sortProjects(val);
    });
  });

  document.addEventListener('click', e => {
    if (!document.getElementById('sortCustom').contains(e.target)) {
      optionsContainer.style.display = 'none';
    }
  });

  function sortProjects(opt) {
    const container = document.getElementById('projectsContainer');
    const cards = Array.from(container.querySelectorAll('.project-card'));
    cards.sort((a,b)=>{
      const va = parseFloat(a.dataset['sort'+opt])||0;
      const vb = parseFloat(b.dataset['sort'+opt])||0;
      return va - vb;
    });
    cards.forEach(c=>container.appendChild(c));
  }

  sortProjects(currentValue);
})();
</script>
<script>
  const sleepingTranslations = <?= json_encode($t['sleeping'], JSON_UNESCAPED_UNICODE) ?>;
  const polishHour           = <?= $polishHour ?>;
</script>
<script src="script.js"></script>
</body>
</html>
