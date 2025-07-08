<?php
date_default_timezone_set('Europe/Warsaw');
$polishHour = (int) date('G');

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
        'about_desc'       => 'Learn more about who I am',
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
        'quantium_title'   => 'Quantium tools',
        'quantium_desc'    => 'A simple website with some shitty "tools": age calculator, fake server stats, name checker, weather app and a calculator. The program was originally written in Python and later rewritten as a web version.',
        'quantium_link'    => 'Take a look',
        'share_title'      => 'Share sites',
        'share_desc'       => 'Share interesting sites with other people or rate and explore other sites!',
        'share_link'       => 'Discover',
        'screentime_title' => 'iOS screentime emulator',
        'screentime_desc'  => 'This website emulates the iOS screen time page on a website so you can get your screen time password from your parent.',
        'screentime_link'  => 'English version',
      'screentime_link_pl' => 'Polish version',
        'footer'           => '&copy; 2025 kotokk.dev<br>Thanks to <a href="https://about-tymianekk.netlify.app" target="_blank">@tymianekk_</a> for help and ideas.<br> Icons from <a href="https://flaticon.com" target="_blank">Flaticon</a>',
        'time'             => 'Time in my country:',
        'temp'             => 'Temperature in my city:',
        'my_desc'          => 'I am a teenager from Kraśnik, Poland, who loves programming!<br>Pronouns: he/him<br>Programming languages: HTML, CSS, Javascript, PHP, Python and React<br>kotokk.dev is my main project<br>More about me below',
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
        'discord_note'     => 'Note: ',
        'discord_status'   => 'Status: ',
        'update_section'   => 'Changelog',
        'github1'          => 'Now on GitHub',
        'github2'          => 'View source and contribute',
        'changelog'        => '<ul><li>Added "donate me" option with crypto adresses</li><li>Added 404 not found site</li><li>Added new iOS screen time emulator to the main page</li><li>Added a small badge on the top</li><li>Added Binance crypto adress</li><li>Added a popup informing that the site is on GitHub</li><li>Added GitHub widget</li></ul>',
        'rewriting'        => 'Rewriting site to React...',
        'star_github'      => 'Star on GitHub!',
        'checking_commit'  => 'Checking last commit...',
        'commit_loading'   => 'Loading...',
        'last_update'      => 'Updated: 8 July',
        'sleeping'         => [
            'question' => 'Am I sleeping right now?',
            'yes'      => 'Yes💤',
            'no'       => 'No🚀',
        ],
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
        'about_desc'       => 'Dowiedz się więcej o mnie',
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
        'quantium_title'   => 'Narzędzia kwantowe',
        'quantium_desc'    => 'Prosta strona internetowa z paroma "narzędziami": kalkulatorem wieku, fałszywymi statystykami serwera, sprawdzaczem imion, aplikacją pogodową i kalkulatorem. Program został przepisany z wersji w Pythonie na HTML.',
        'quantium_link'    => 'Przejrzyj',
        'share_title'      => 'Udostępniaj strony internetowe',
        'share_desc'       => 'Udostępniaj ciekawe strony internetowe z innymi ludźmi, oraz oceniaj i odkrywaj nowe strony internetowe!',
        'share_link'       => 'Odkryj',
        'screentime_title' => 'Emulator czasu przed ekranem iOS',
        'screentime_desc'  => 'Ta strona internetowa emuluje stronę czasu przed ekranem z iOS, abyś mógł uzyskać hasło do czasu przed ekranem od swojego rodzica.',
        'screentime_link'  => 'Angielska wersja',
      'screentime_link_pl' => 'Polska wersja',
        'footer'           => '&copy; 2025 kotokk.dev<br>Podziękowania dla <a href="https://about-tymianekk.netlify.app" target="_blank">@tymianekk_</a> za pomysły i pomoc.<br> Ikony z <a href="https://flaticon.com" target="_blank">Flaticon</a>',
        'time'             => 'Czas w moim kraju:',
        'temp'             => 'Temperatura w moim mieście:',
        'my_desc'          => 'Jestem nastolatkiem z Kraśnika w Polsce, który uwielbia programować!<br>Zaimki: on/jego<br>Języki programowania: HTML, CSS, Javascript, PHP, Python i React<br>kotokk.dev to mój główny projekt<br>Więcej o mnie poniżej',
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
        'discord_note'     => 'Notatka: ',
        'discord_status'   => 'Status: ',
        'update_section'   => 'Dziennik zmian',
        'changelog'        => '<ul><li>Dodano opcje "wesprzyj mnie" z adresami crypto</li><li>Dodano stronę 404</li><li>Dodano nowy emulator czasu przed ekranem do strony głównej</li><li>Dodano małą plakietkę na górze strony</li><li>Dodano adres Binance do adresów krypto</li><li>Dodano popup informujący o tym że strona jest na GitHubie</li><li>Dodano widget GitHuba</li></ul>',
        'github1'          => 'Od teraz na GitHubie',
        'github2'          => 'Zobacz kod i kontrybuuj',
        'star_github'      => 'Dodaj gwiazdkę na GitHubie!',
        'checking_commit'  => 'Sprawdzanie ostatniego commita...',
        'commit_loading'   => 'Ładowanie...',
        'rewriting'        => 'Przepisywanie strony do React...',
        'last_update'      => 'Uaktualnione: 8 Lipca',
        'sleeping'         => [
            'question' => 'Czy teraz śpię?',
            'yes'      => 'Tak💤',
            'no'       => 'Nie🚀',
        ],
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
$apiKey = 'apikey';
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
      <div class="zx-notification-floating" id="zxGithubAnnouncementWidget">
        <a href="#" class="zx-external-navigator" target="_blank" rel="noopener noreferrer">
            <svg class="zx-repo-emblem" viewBox="0 0 24 24">
                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
            </svg>
        </a>
        <div class="zx-message-wrapper">
            <div class="zx-primary-text"><?= htmlspecialchars($t['github1'], ENT_QUOTES) ?></div>
            <div class="zx-secondary-text"><a href="https://github.com/Kotok7/kotokk.dev"><?= htmlspecialchars($t['github2'], ENT_QUOTES) ?></a></div>
        </div>
        <button class="zx-dismiss-trigger" onclick="zxDismissRepoNotification()" aria-label="Close">×</button>
    </div>
    <script src="github.js"></script>
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
    </div><br>
    <h1><?= htmlspecialchars($t['main_title'], ENT_QUOTES) ?><span class="cursor"></span></h1>
    <div class="last-update"><?= htmlspecialchars($t['last_update'], ENT_QUOTES) ?></div>
        </div>
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

        <div class="stats-widget">
            
            <div class="badge-compact">
                <img src="https://img.shields.io/github/v/release/Kotok7/kotokk.dev.svg?style=flat-square" alt="Release">
                <img src="https://img.shields.io/maintenance/yes/2025.svg?style=flat-square" alt="Maintenance">
                <img src="https://img.shields.io/github/repo-size/Kotok7/kotokk.dev.svg?style=flat-square" alt="Repo Size">
                <img src="https://img.shields.io/github/contributors/Kotok7/kotokk.dev.svg?style=flat-square" alt="Contributors">
                <img src="https://img.shields.io/github/last-commit/Kotok7/kotokk.dev.svg?style=flat-square" alt="Last Commit">
                <img src="https://img.shields.io/github/issues/Kotok7/kotokk.dev.svg?style=flat-square" alt="Open Issues">
                <img src="https://img.shields.io/github/issues-closed/Kotok7/kotokk.dev.svg?style=flat-square" alt="Closed Issues">
                <img src="https://img.shields.io/github/issues-pr/Kotok7/kotokk.dev.svg?style=flat-square" alt="Pull Requests">
            </div>
            
            <div class="star-row">
                <span><?= htmlspecialchars($t['star_github'], ENT_QUOTES) ?></span>
                <iframe 
                    src="https://ghbtns.com/github-btn.html?user=Kotok7&repo=kotokk.dev&type=star&count=true&size=small"
                    frameborder="0" scrolling="0" width="80" height="20"
                    title="GitHub Star">
                </iframe>
            </div>
            
            <div class="commit-info">
                <div class="commit-message" id="commit-message">
                    <span class="loading"><?= htmlspecialchars($t['commit_loading'], ENT_QUOTES) ?></span>
                </div>
                <p id="commit-date"><?= htmlspecialchars($t['checking_commit'], ENT_QUOTES) ?></p>
            </div>
        </div>
    </div>

    <script src="github2.js"></script>
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

  <div class="project-card" data-sort1="1" data-sort2="10">
    <img src="photos/about-me.png" alt="<?= htmlspecialchars($t['about_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: May</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['about_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['about_desc'], ENT_QUOTES) ?></p>
      <a href="about-me/index.html" class="project-link"><?= htmlspecialchars($t['about_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="2" data-sort2="2">
    <img src="photos/share.png" alt="<?= htmlspecialchars($t['share_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: 4 July</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['share_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['share_desc'], ENT_QUOTES) ?></p>
      <a href="share-sites/index.php" class="project-link"><?= htmlspecialchars($t['share_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="3" data-sort2="3">
    <img src="photos/chat.png" alt="<?= htmlspecialchars($t['chat_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: 30 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['chat_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['chat_desc'], ENT_QUOTES) ?></p>
      <a href="chat/index.php" class="project-link"><?= htmlspecialchars($t['chat_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="4" data-sort2="9">
    <img src="photos/qjf.png" alt="<?= htmlspecialchars($t['facts_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: May</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['facts_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['facts_desc'], ENT_QUOTES) ?></p>
      <a href="facts/index.html" class="project-link"><?= htmlspecialchars($t['facts_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="5" data-sort2="8">
    <img src="photos/dev.png" alt="<?= htmlspecialchars($t['dev_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: May</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['dev_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['dev_desc'], ENT_QUOTES) ?></p>
      <a href="tutorial/index.php" class="project-link"><?= htmlspecialchars($t['dev_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="8" data-sort2="7">
    <img src="photos/blog.png" alt="<?= htmlspecialchars($t['blog_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: May</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['blog_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['blog_desc'], ENT_QUOTES) ?></p>
      <a href="blog/index.php" class="project-link"><?= htmlspecialchars($t['blog_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="6" data-sort2="4">
    <img src="photos/quiz.png" alt="<?= htmlspecialchars($t['quiz_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: 14 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['quiz_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['quiz_desc'], ENT_QUOTES) ?></p>
      <a href="quiz/index.html" class="project-link"><?= htmlspecialchars($t['quiz_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="7" data-sort2="5">
    <img src="photos/quantium.png" alt="<?= htmlspecialchars($t['quantium_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: 13 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['quantium_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['quantium_desc'], ENT_QUOTES) ?></p>
      <a href="quantium-tools/index.html" class="project-link"><?= htmlspecialchars($t['quantium_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

    <div class="project-card" data-sort1="10" data-sort2="1">
    <img src="photos/screentime.png" alt="<?= htmlspecialchars($t['screentime_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: 06 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['screentime_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['screentime_desc'], ENT_QUOTES) ?></p>
      <a href="screentime/index.html" class="project-link"><?= htmlspecialchars($t['screentime_link'], ENT_QUOTES) ?></a>
      <a href="screentimepl/index.html" class="project-link" style="margin-top: 10px;"><?= htmlspecialchars($t['screentime_link_pl'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="9" data-sort2="11">
    <img src="photos/cybersecurity.png" alt="<?= htmlspecialchars($t['cyber_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: April</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['cyber_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['cyber_desc'], ENT_QUOTES) ?></p>
      <a href="cybersecurity/index.php" class="project-link"><?= htmlspecialchars($t['cyber_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

  <div class="project-card" data-sort1="11" data-sort2="6">
    <img src="photos/other.png" alt="<?= htmlspecialchars($t['other_title'], ENT_QUOTES) ?>" class="project-image" loading="lazy">
    <div class="last-updated badge">Last updated: 04 June</div>
    <div class="project-content">
      <h3><?= htmlspecialchars($t['other_title'], ENT_QUOTES) ?></h3>
      <p><?= htmlspecialchars($t['other_desc'], ENT_QUOTES) ?></p>
      <a href="unfinished/index.php" class="project-link"><?= htmlspecialchars($t['other_link'], ENT_QUOTES) ?></a>
    </div>
  </div>

<div class="project-card" data-sort1="12" data-sort2="12">
      <div class="last-updated badge">Last updated: 8 July</div>
  <div class="project-content">
    <h3><?= htmlspecialchars($t['update_section'], ENT_QUOTES) ?></h3>
    <?= $t['changelog']?>
  </div>
</div>

</div>

<div class="two-columns">
  <section class="leave-message" id="leave-message-pl">
    <h2><?= htmlspecialchars($t['message_leave'], ENT_QUOTES) ?><br>Polish room</h2>
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
    <h2><?= htmlspecialchars($t['message_leave'], ENT_QUOTES) ?><br>English room</h2>
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
  <p><?= $t['footer'] ?></p>
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
