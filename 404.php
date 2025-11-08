<?php
$lang_code = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'      => 'en',
        'meta_desc'      => 'Page not found - Explore my available services and tools',
        'title'          => '404 Page not found',
        'translate'      => 'Przetłumacz na Polski',
        '404'            => '404',
        'oops'           => 'Oops!',
        'notfound'       => 'We could not find the page you are looking for. Check the URL or go back to the homepage.',
        'back'           => 'Return to the homepage',
        'catalogs_title' => 'Available Services & Tools',
        'catalogs_desc'  => 'Or explore our comprehensive collection of tools and services:',
        'search_placeholder' => 'Search services...',
        'no_results'     => 'No services found matching your search.',
        'category_all'   => 'All',
        'category_personal' => 'Personal',
        'category_tools'    => 'Tools & Utilities',
        'category_creative' => 'Creative & Fun',
        'category_tech'     => 'Technology',
        'category_social'   => 'Social & Links',
        'category_hidden'   => 'Other',
    ],
    'pl' => [
        'html_lang'      => 'pl',
        'meta_desc'      => 'Strona nie znaleziona - Odkryj moje dostępne usługi i narzędzia',
        'title'          => '404 Strona nie znaleziona',
        'translate'      => 'Translate to English',
        '404'            => '404',
        'oops'           => 'Ups!',
        'notfound'       => 'Nie mogliśmy znaleźć strony, której szukasz. Sprawdź adres URL lub wróć do strony głównej.',
        'back'           => 'Powrót do strony głównej',
        'catalogs_title' => 'Dostępne Usługi i Narzędzia',
        'catalogs_desc'  => 'Lub poznaj naszą kompleksową kolekcję narzędzi i usług:',
        'search_placeholder' => 'Szukaj usług...',
        'no_results'     => 'Nie znaleziono usług pasujących do wyszukiwania.',
        'category_all'   => 'Wszystkie',
        'category_personal' => 'Osobiste',
        'category_tools'    => 'Narzędzia',
        'category_creative' => 'Kreatywne',
        'category_tech'     => 'Technologia',
        'category_social'   => 'Społecznościowe',
        'category_hidden'   => 'Inne',
    ],
];

$catalogs = [
    'en' => [
        [
            'name' => 'About me',
            'url' => '/about-me',
            'description' => 'Kotokk - Polish web developer skilled in HTML, CSS, JavaScript, PHP, and Python.',
            'category' => 'personal',
            'icon' => '👤'
        ],
        [
            'name' => 'Live chat',
            'url' => '/chat',
            'description' => 'Simple real-time web chat with image and voice message sharing. Also features a live active user counter!',
            'category' => 'social',
            'icon' => '💬'
        ],
        [
            'name' => 'Share apps',
            'url' => '/share-apps',
            'description' => 'Share your favoutite apps! Select type and enter the name',
            'category' => 'social',
            'icon' => '🤳'
        ],
        [
            'name' => 'Share and explore sites',
            'url' => '/share-sites',
            'description' => 'Share interesting sites with other people or rate and explore other sites!',
            'category' => 'social',
            'icon' => '🌐'
        ],
        [
            'name' => 'Drawall',
            'url' => '/drawall',
            'description' => 'Wall where everyone can draw whatever they want!',
            'category' => 'creative',
            'icon' => '🖌️'
        ],
        [
            'name' => 'What website should i build?',
            'url' => '/give-me-ideas',
            'description' => "I didn't have an idea for a website so I created this one - add your idea!",
            'category' => 'creative',
            'icon' => '🤔'
        ],
        [
            'name' => 'Share and discover songs',
            'url' => '/share-music',
            'description' => 'Share your favourite songs and discover new music!',
            'category' => 'social',
            'icon' => '🎵'
        ],
        [
            'name' => 'Discover and add quotes',
            'url' => '/quotes',
            'description' => 'Add, discover, view and save quotes!',
            'category' => 'social',
            'icon' => '🗣️'
        ],
        [
            'name' => 'Collaborative Story',
            'url' => '/story',
            'description' => 'Everyone adds one sentence and has a one-hour cooldown.',
            'category' => 'creative',
            'icon' => '📩'
        ],
        [
            'name' => 'Facts, quotes and jokes',
            'url' => '/facts',
            'description' => 'Programming Quotes, funny jokes and interesing facts you did not know!',
            'category' => 'creative',
            'icon' => '💡'
        ],
        [
            'name' => 'Quiz about me',
            'url' => '/quiz',
            'description' => 'A web quiz that tests how well you know my programming preferences, favorite languages, development tools, and more!',
            'category' => 'creative',
            'icon' => '❓'
        ],
        [
            'name' => 'Quantum tools',
            'url' => '/quantum-tools',
            'description' => 'A simple website with some shitty tools: age calculator, fake server stats, name checker, weather app and a calculator. The program was originally written in Python and later rewritten as a web version.',
            'category' => 'tech',
            'icon' => '⚛️'
        ],
        [
            'name' => 'Blog',
            'url' => '/blog',
            'description' => 'My personal blog where I share topics and insights that interest me.',
            'category' => 'personal',
            'icon' => '📝'
        ],
        [
            'name' => 'Time converter',
            'url' => '/time-converter',
            'description' => 'Quickly convert seconds, minutes, hours, days, months, and years – for example, find out how many seconds are in a year or how many days are in a month.',
            'category' => 'tools',
            'icon' => '⏰'
        ],
        [
            'name' => 'Pentesting devices',
            'url' => '/cybersecurity',
            'description' => 'My cybersecurity devices & projects.',
            'category' => 'tech',
            'icon' => '🛡️'
        ],
        [
            'name' => 'Linktree',
            'url' => '/links',
            'description' => 'Links to devices & modules I use.',
            'category' => 'social',
            'icon' => '🔗'
        ],
        [
            'name' => 'Screentime emulator',
            'url' => '/screentime',
            'description' => 'iOS screentime limit emulator.',
            'category' => 'tools',
            'icon' => '📱'
        ],
        [
            'name' => 'Lumiboard',
            'url' => '/lumiboard',
            'description' => 'Sleek, web-based dashboard displaying time, weather, calendar, and more in a minimalist, modern interface.',
            'category' => 'tools',
            'icon' => '🕰️'
        ],
        [
            'name' => 'My TikTok',
            'url' => '/tiktok',
            'description' => 'My TikTok account',
            'category' => 'social',
            'icon' => '🎬'
        ],
        [
            'name' => 'My GitHub',
            'url' => '/github',
            'description' => 'My GitHub account',
            'category' => 'tech',
            'icon' => '💻'
        ],
        [
            'name' => 'Repository on GitHub',
            'url' => '/repo',
            'description' => 'kotokk.dev repository on GitHub',
            'category' => 'tech',
            'icon' => '💻'
        ]
    ],
    'pl' => [
        [
            'name' => 'O mnie',
            'url' => '/about-me',
            'description' => 'Kotokk - Polski web developer znający HTML, CSS, JavaScript, PHP i Python.',
            'category' => 'personal',
            'icon' => '👤'
        ],
        [
            'name' => 'Live chat',
            'url' => '/chat',
            'description' => 'Prosty czat internetowy w czasie rzeczywistym z udostępnianiem obrazów i wiadomości głosowych. Ma także licznik aktywnych użytkowników na żywo!',
            'category' => 'social',
            'icon' => '💬'
        ],
        [
            'name' => 'Udostępniaj aplikacje',
            'url' => '/share-apps',
            'description' => 'Udostępniaj swoje ulubione aplikacje! Wybierz typ i wpisz nazwę.',
            'category' => 'social',
            'icon' => '🤳'
        ],
        [
            'name' => 'Udostępniaj i odkrywaj strony',
            'url' => '/share-sites',
            'description' => 'Udostępniaj ciekawe strony internetowe z innymi ludźmi, oraz oceniaj i odkrywaj nowe strony internetowe!',
            'category' => 'social',
            'icon' => '🌐'
        ],
        [
            'name' => 'Drawall',
            'url' => '/drawall',
            'description' => 'Ściana gdzie każdy może rysować co tylko chce!',
            'category' => 'creative',
            'icon' => '🖌️'
        ],
        [
            'name' => 'Jaką stronę powinienem stworzyć?',
            'url' => '/give-me-ideas',
            'description' => "Nie miałem pomysłu na stronę internetową dlatego stworzyłem tę - dodaj swój pomysł!",
            'category' => 'creative',
            'icon' => '🤔'
        ],
        [
            'name' => 'Udostępniaj i odkrywaj muzykę',
            'url' => '/share-music',
            'description' => 'Udostępnij swoje ulubione piosenki i odkrywaj nową muzykę!',
            'category' => 'social',
            'icon' => '🎵'
        ],
        [
            'name' => 'Odkrywaj i dodawaj cytaty',
            'url' => '/quotes',
            'description' => 'Dodawaj, odkrywaj, oglądaj i zapisuj cytaty!',
            'category' => 'social',
            'icon' => '🗣️'
        ],
        [
            'name' => 'Wspólna opowieść',
            'url' => '/story',
            'description' => ' Każdy dodaje po jednym zdaniu i ma cooldown na godzinę."',
            'category' => 'creative',
            'icon' => '📩'
        ],
        [
            'name' => 'Fakty, cytaty i żarty',
            'url' => '/facts',
            'description' => 'Kolekcja ciekawych faktów, inspirujących cytatów i humoru.',
            'category' => 'creative',
            'icon' => '💡'
        ],
        [
            'name' => 'Quiz o mnie',
            'url' => '/quiz',
            'description' => 'Quiz internetowy, który sprawdzi, jak dobrze znasz moje preferencje programistyczne, ulubione języki, narzędzia developerskie i więcej!',
            'category' => 'creative',
            'icon' => '❓'
        ],
        [
            'name' => 'Narzędzia kwantowe',
            'url' => '/quantum-tools',
            'description' => 'Prosta strona internetowa z paroma narzędziami: kalkulatorem wieku, fałszywymi statystykami serwera, sprawdzaczem imion, aplikacją pogodową i kalkulatorem. Program został przepisany z wersji w Pythonie na HTML.',
            'category' => 'tech',
            'icon' => '⚛️'
        ],
        [
            'name' => 'Blog',
            'url' => '/blog',
            'description' => 'Mój blog, gdzie dzielę się tematami i przemyśleniami, które mnie interesują.',
            'category' => 'personal',
            'icon' => '📝'
        ],
        [
            'name' => 'Konwerter czasu',
            'url' => '/time-converter',
            'description' => 'Szybko zamieniaj sekundy, minuty, godziny, dni, miesiące i lata – np. sprawdź, ile sekund ma rok lub ile dni ma miesiąc.',
            'category' => 'tools',
            'icon' => '⏰'
        ],
        [
            'name' => 'Urządzenia cyberbezpieczeństwa',
            'url' => '/cybersecurity',
            'description' => 'Moje urządzenia i projekty cyberbezpieczeństwa',
            'category' => 'tech',
            'icon' => '🛡️'
        ],
        [
            'name' => 'Linktree',
            'url' => '/links',
            'description' => 'Linki do urządzeń i modułów, których używam',
            'category' => 'social',
            'icon' => '🔗'
        ],
        [
            'name' => 'Emulator czasu przed ekranem',
            'url' => '/screentime',
            'description' => 'Emulator czasu przed ekranem iOS',
            'category' => 'tools',
            'icon' => '📱'
        ],
        [
            'name' => 'Lumiboard',
            'url' => '/lumiboard',
            'description' => 'Elegancki, internetowy pulpit wyświetlający godzinę, pogodę, kalendarz i inne informacje w minimalistycznym, nowoczesnym interfejsie.',
            'category' => 'tools',
            'icon' => '🕰️'
        ],
        [
            'name' => 'Mój TikTok',
            'url' => '/tiktok',
            'description' => 'Moje konto TikTok',
            'category' => 'social',
            'icon' => '🎬'
        ],
        [
            'name' => 'Mój GitHub',
            'url' => '/github',
            'description' => 'Moje konto GitHub',
            'category' => 'tech',
            'icon' => '💻'
        ],
        [
            'name' => 'Repozytorium na GitHubue',
            'url' => '/repo',
            'description' => 'Repozytorium kotokk.dev na GitHubue',
            'category' => 'tech',
            'icon' => '💻'
        ]
    ]
];

if (!isset($translations[$lang_code])) {
    $lang_code = 'en';
}

$t = $translations[$lang_code];
$current_catalogs = $catalogs[$lang_code];

$grouped_catalogs = [];
foreach ($current_catalogs as $catalog) {
    $category = $catalog['category'];
    if (!isset($grouped_catalogs[$category])) {
        $grouped_catalogs[$category] = [];
    }
    $grouped_catalogs[$category][] = $catalog;
}

http_response_code(404);
?>
<!DOCTYPE html>
<html lang="<?= $t['html_lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc'], ENT_QUOTES, 'UTF-8') ?>">
    <meta name="robots" content="noindex, nofollow">
    <title><?= htmlspecialchars($t['title'], ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="preload" href="photos/united-states.png" as="image">
    <link rel="preload" href="photos/poland.png" as="image">
    <style>
        :root {
            --primary-color: #000;
            --secondary-color: #666;
            --accent-color: #4a9eff;
            --background-color: #fff;
            --card-background: #f8f9fa;
            --border-color: #e1e5e9;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.15);
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: var(--background-color);
            color: var(--primary-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .background-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
            animation: float 20s ease-in-out infinite;
        }

        .bg-circle:nth-child(1) {
            top: 20%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: var(--accent-color);
            animation-delay: 0s;
        }

        .bg-circle:nth-child(2) {
            top: 60%;
            right: 10%;
            width: 150px;
            height: 150px;
            background: #764ba2;
            animation-delay: -5s;
        }

        .bg-circle:nth-child(3) {
            bottom: 10%;
            left: 20%;
            width: 100px;
            height: 100px;
            background: #667eea;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-30px) rotate(120deg);
            }
            66% {
                transform: translateY(15px) rotate(240deg);
            }
        }

        .container {
            min-height: 100vh;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .lang-switch {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .lang-switch a {
            text-decoration: none;
            display: block;
            transition: var(--transition);
            padding: 0.5rem;
            border-radius: var(--border-radius);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow);
        }

        .lang-switch a:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-hover);
        }

        .flag-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: block;
        }

        .error-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .error-code {
            font-size: clamp(6rem, 15vw, 12rem);
            font-weight: 900;
            margin-bottom: 1rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            display: inline-block;
        }

        .oops {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .error-title {
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            margin-bottom: 1rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .error-message {
            font-size: clamp(1rem, 2.5vw, 1.2rem);
            margin-bottom: 2rem;
            color: var(--secondary-color);
            max-width: 600px;
            line-height: 1.7;
        }

        .home-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            box-shadow: var(--shadow);
            margin-bottom: 4rem;
        }

        .home-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            background: var(--secondary-color);
        }

        .catalogs-section {
            width: 100%;
            max-width: 1000px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .catalogs-title {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .catalogs-desc {
            font-size: 1.1rem;
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }

        .search-container {
            position: relative;
            max-width: 400px;
            margin: 0 auto 2rem;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(74, 158, 255, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            font-size: 1.2rem;
        }

        .category-filters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid var(--border-color);
            background: white;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            color: var(--secondary-color);
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        .catalogs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .catalog-card {
            background: var(--card-background);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            overflow: hidden;
        }

        .catalog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: var(--transition);
        }

        .catalog-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--accent-color);
        }

        .catalog-card:hover::before {
            transform: scaleX(1);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .card-icon {
            font-size: 1.8rem;
            width: 50px;
            height: 50px;
            border-radius: var(--border-radius);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            flex: 1;
        }

        .card-description {
            color: var(--secondary-color);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .card-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--accent-color);
            color: white;
            font-size: 0.8rem;
            border-radius: 15px;
            font-weight: 500;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: var(--secondary-color);
            font-size: 1.1rem;
            display: none;
        }

        .no-results.show {
            display: block;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .lang-switch {
                top: 1rem;
                right: 1rem;
            }

            .catalogs-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .category-filters {
                gap: 0.25rem;
            }

            .filter-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .error-header {
                margin-bottom: 2rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="background-decoration">
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
    </div>

    <div class="lang-switch">
        <a href="?lang=<?= $lang_code === 'pl' ? 'en' : 'pl' ?>" aria-label="<?= htmlspecialchars($t['translate'], ENT_QUOTES, 'UTF-8') ?>">
            <?php
            $flag_src = $lang_code === 'pl' ? 'photos/united-states.png' : 'photos/poland.png';
            $flag_alt = htmlspecialchars($t['translate'], ENT_QUOTES, 'UTF-8');
            ?>
            <img src="<?= htmlspecialchars($flag_src, ENT_QUOTES, 'UTF-8') ?>"
                 alt="<?= $flag_alt ?>"
                 title="<?= $flag_alt ?>"
                 loading="lazy"
                 class="flag-icon"
                 onerror="this.style.display='none'">
        </a>
    </div>

    <div class="container">
        <header class="error-header">
            <div class="error-code" aria-label="Error 404"><?= htmlspecialchars($t['404'], ENT_QUOTES, 'UTF-8') ?></div>
            <h1 class="oops"><?= htmlspecialchars($t['oops'], ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="error-title"><?= htmlspecialchars($t['title'], ENT_QUOTES, 'UTF-8') ?></p>
            <p class="error-message">
                <?= htmlspecialchars($t['notfound'], ENT_QUOTES, 'UTF-8') ?>
            </p>
            <a href="/" class="home-button">
                <span>🏠</span>
                <?= htmlspecialchars($t['back'], ENT_QUOTES, 'UTF-8') ?>
            </a>
        </header>

        <section class="catalogs-section">
            <div class="section-header">
                <h2 class="catalogs-title"><?= htmlspecialchars($t['catalogs_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p class="catalogs-desc"><?= htmlspecialchars($t['catalogs_desc'], ENT_QUOTES, 'UTF-8') ?></p>
                
                <div class="search-container">
                    <span class="search-icon">🔍</span>
                    <input 
                        type="text" 
                        id="searchInput" 
                        class="search-input" 
                        placeholder="<?= htmlspecialchars($t['search_placeholder'], ENT_QUOTES, 'UTF-8') ?>"
                        autocomplete="off"
                    >
                </div>

                <div class="category-filters">
                    <button class="filter-btn active" data-category="all"><?= htmlspecialchars($t['category_all'], ENT_QUOTES, 'UTF-8') ?></button>
                    <button class="filter-btn" data-category="personal"><?= htmlspecialchars($t['category_personal'], ENT_QUOTES, 'UTF-8') ?></button>
                    <button class="filter-btn" data-category="tools"><?= htmlspecialchars($t['category_tools'],ENT_QUOTES, 'UTF-8') ?></button>
                   <button class="filter-btn" data-category="creative"><?= htmlspecialchars($t['category_creative'], ENT_QUOTES, 'UTF-8') ?></button>
                   <button class="filter-btn" data-category="tech"><?= htmlspecialchars($t['category_tech'], ENT_QUOTES, 'UTF-8') ?></button>
                   <button class="filter-btn" data-category="social"><?= htmlspecialchars($t['category_social'], ENT_QUOTES, 'UTF-8') ?></button>
                   <button class="filter-btn" data-category="hidden"><?= htmlspecialchars($t['category_hidden'], ENT_QUOTES, 'UTF-8') ?></button>
               </div>
           </div>

           <div class="catalogs-grid" id="catalogsGrid">
               <?php foreach ($current_catalogs as $index => $catalog): ?>
                   <a href="<?= htmlspecialchars($catalog['url'], ENT_QUOTES, 'UTF-8') ?>" 
                      class="catalog-card" 
                      data-category="<?= htmlspecialchars($catalog['category'], ENT_QUOTES, 'UTF-8') ?>"
                      data-name="<?= htmlspecialchars(strtolower($catalog['name']), ENT_QUOTES, 'UTF-8') ?>"
                      data-description="<?= htmlspecialchars(strtolower($catalog['description']), ENT_QUOTES, 'UTF-8') ?>">
                       <div class="card-header">
                           <div class="card-icon"><?= $catalog['icon'] ?></div>
                           <h3 class="card-title"><?= htmlspecialchars($catalog['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                       </div>
                       <p class="card-description"><?= htmlspecialchars($catalog['description'], ENT_QUOTES, 'UTF-8') ?></p>
                       <span class="card-category"><?= htmlspecialchars($t['category_' . $catalog['category']], ENT_QUOTES, 'UTF-8') ?></span>
                   </a>
               <?php endforeach; ?>
           </div>

           <div class="no-results" id="noResults">
               <p><?= htmlspecialchars($t['no_results'], ENT_QUOTES, 'UTF-8') ?></p>
           </div>
       </section>
   </div>

   <script>
       const searchInput = document.getElementById('searchInput');
       const catalogsGrid = document.getElementById('catalogsGrid');
       const noResults = document.getElementById('noResults');
       const filterButtons = document.querySelectorAll('.filter-btn');
       const catalogCards = document.querySelectorAll('.catalog-card');

       let currentFilter = 'all';

       searchInput.addEventListener('input', function() {
           const searchTerm = this.value.toLowerCase().trim();
           filterCatalogs(searchTerm, currentFilter);
       });

       filterButtons.forEach(button => {
           button.addEventListener('click', function() {
               filterButtons.forEach(btn => btn.classList.remove('active'));
               this.classList.add('active');
               
               currentFilter = this.dataset.category;
               const searchTerm = searchInput.value.toLowerCase().trim();
               filterCatalogs(searchTerm, currentFilter);
           });
       });

       function filterCatalogs(searchTerm, category) {
           let visibleCount = 0;

           catalogCards.forEach(card => {
               const cardCategory = card.dataset.category;
               const cardName = card.dataset.name;
               const cardDescription = card.dataset.description;
               
               const matchesSearch = !searchTerm || 
                   cardName.includes(searchTerm) || 
                   cardDescription.includes(searchTerm);
               
               const matchesCategory = category === 'all' || cardCategory === category;
               
               if (matchesSearch && matchesCategory) {
                   card.style.display = 'block';
                   visibleCount++;
               } else {
                   card.style.display = 'none';
               }
           });

           if (visibleCount === 0) {
               noResults.classList.add('show');
               catalogsGrid.style.display = 'none';
           } else {
               noResults.classList.remove('show');
               catalogsGrid.style.display = 'grid';
           }
       }

       document.addEventListener('keydown', function(e) {
           if (e.ctrlKey && e.key === 'k') {
               e.preventDefault();
               searchInput.focus();
           }
       });

       function debounce(func, wait) {
           let timeout;
           return function executedFunction(...args) {
               const later = () => {
                   clearTimeout(timeout);
                   func(...args);
               };
               clearTimeout(timeout);
               timeout = setTimeout(later, wait);
           };
       }

       searchInput.removeEventListener('input', filterCatalogs);
       const debouncedFilter = debounce((searchTerm) => {
           filterCatalogs(searchTerm, currentFilter);
       }, 150);

       searchInput.addEventListener('input', function() {
           const searchTerm = this.value.toLowerCase().trim();
           debouncedFilter(searchTerm);
       });
   </script>
</body>
</html>
