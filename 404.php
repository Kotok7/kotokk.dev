<?php
$lang_code = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'      => 'en',
        'meta_desc'      => 'Page not found',
        'title'          => '404 Page not found',
        'translate'      => 'Przetłumacz na Polski',
        '404'            => '404',
        'notfound'       => 'We could not find the page you are looking for. Check the URL or go back to the homepage.',
        'back'           => 'Return to the homepage',
        'catalogs_title' => 'Available Catalogs',
        'catalogs_desc'  => 'Or browse our available catalogs:',
    ],
    'pl' => [
        'html_lang'      => 'pl',
        'meta_desc'      => 'Strona nie znaleziona',
        'title'          => '404 Strona nie znaleziona',
        'translate'      => 'Translate to English',
        '404'            => '404',
        'notfound'       => 'Nie mogliśmy znaleźć strony, której szukasz. Sprawdź adres URL lub wróć do strony głównej.',
        'back'           => 'Powrót do strony głównej',
        'catalogs_title' => 'Dostępne Katalogi',
        'catalogs_desc'  => 'Lub przeglądaj nasze dostępne katalogi:',
    ],
];

$catalogs = [
    'en' => [
        ['name' => 'About me', 'url' => '/about-me'],
        ['name' => 'Agartha or hyperborea quiz (hidden)', 'url' => '/agartha-or-hyperborea'],
        ['name' => 'Blog', 'url' => '/blog'],
        ['name' => 'Live chat', 'url' => '/chat'],
        ['name' => 'Pentesting devices', 'url' => '/cybersecurity'],
        ['name' => 'Facts, quotes and jokes', 'url' => '/facts'],
        ['name' => 'Unfinished sites', 'url' => '/unfinished'],
        ['name' => 'Quantium tools', 'url' => '/quantium-tools'],
        ['name' => 'Quiz about me', 'url' => '/quiz'],
        ['name' => 'Screentime emulator', 'url' => '/screentime'],
        ['name' => 'Share and explore sites', 'url' => '/share-sites'],
        ['name' => 'How to be like me', 'url' => '/tutorial'],
        ['name' => 'And two more, but they are secret', 'url' => ''],
    ],
    'pl' => [
        ['name' => 'O mnie', 'url' => '/about-me'],
        ['name' => 'Agartha or hyperborea quiz (hidden)', 'url' => '/agartha-or-hyperborea'],
        ['name' => 'Blog', 'url' => '/blog'],
        ['name' => 'Live chat', 'url' => '/chat'],
        ['name' => 'Urządzenia cyberbezpieczeństwa', 'url' => '/cybersecurity'],
        ['name' => 'Fakty, cytaty i żarty', 'url' => '/facts'],
        ['name' => 'Niedokończone strony', 'url' => '/unfinished'],
        ['name' => 'Narzędzia kwantowe', 'url' => '/quantium-tools'],
        ['name' => 'Quiz o mnie', 'url' => '/quiz'],
        ['name' => 'Emulator czasu przed ekranem', 'url' => '/screentime'],
        ['name' => 'Udostępniaj i odkrywaj strony', 'url' => '/share-sites'],
        ['name' => 'Jak być jak ja', 'url' => '/tutorial'],
        ['name' => 'I dwa więcej, ale są sekretne.', 'url' => ''],
    ]
];

if (!isset($translations[$lang_code])) {
    $lang_code = 'en';
}
$t = $translations[$lang_code];
$current_catalogs = $catalogs[$lang_code];

http_response_code(404);
?>
<!DOCTYPE html>
<html lang="<?= $t['html_lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc'], ENT_QUOTES, 'UTF-8') ?>">
    <title><?= htmlspecialchars($t['title'], ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
            position: relative;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            margin-bottom: 1rem;
            color: #000;
            position: relative;
            display: inline-block;
        }

        .error-code::before {
            content: '404';
            position: absolute;
            top: 0;
            left: 0;
            color: transparent;
            -webkit-text-stroke: 2px #ddd;
            text-stroke: 2px #ddd;
            z-index: -1;
            transform: translate(4px, 4px);
        }

        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #000;
            position: relative;
        }

        .error-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #000;
        }

        .error-message {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #666;
            line-height: 1.6;
            font-weight: 400;
        }

        .home-button {
            display: inline-block;
            padding: 1rem 2rem;
            background: white;
            border: 2px solid #000;
            color: #000;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .home-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: #000;
            transition: left 0.3s ease;
            z-index: -1;
        }

        .home-button:hover::before {
            left: 0;
        }

        .home-button:hover {
            color: white;
        }

        .catalogs-section {
            margin-top: 3rem;
            border-top: 1px solid #e0e0e0;
            padding-top: 2rem;
        }

        .catalogs-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000;
            margin-bottom: 0.5rem;
        }

        .catalogs-desc {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        .catalogs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .catalog-link {
            display: block;
            padding: 1rem;
            background: white;
            border: 1px solid #e0e0e0;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .catalog-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: #f8f8f8;
            transition: left 0.3s ease;
            z-index: -1;
        }

        .catalog-link:hover::before {
            left: 0;
        }

        .catalog-link:hover {
            border-color: #000;
            color: #000;
        }

        .lang-switch {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 100;
        }

        .lang-switch a {
            text-decoration: none;
            display: block;
            transition: transform 0.3s ease;
        }

        .lang-switch a:hover {
            transform: scale(1.1);
        }

        .flag-icon {
            width: 30px;
            height: 30px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .decoration {
            position: absolute;
            border: 2px solid #f0f0f0;
        }

        .decoration-1 {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            animation: rotate 20s linear infinite;
        }

        .decoration-2 {
            top: 20%;
            right: 15%;
            width: 60px;
            height: 60px;
            transform: rotate(45deg);
            animation: rotate 15s linear infinite reverse;
        }

        .decoration-3 {
            bottom: 20%;
            left: 20%;
            width: 0;
            height: 0;
            border-left: 30px solid transparent;
            border-right: 30px solid transparent;
            border-bottom: 60px solid #f5f5f5;
            border-radius: 0;
            animation: float 6s ease-in-out infinite;
        }

        .decoration-4 {
            bottom: 15%;
            right: 10%;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }
            
            .error-title {
                font-size: 1.5rem;
            }
            
            .container {
                padding: 1rem;
            }

            .decoration {
                display: none;
            }

            .catalogs-grid {
                grid-template-columns: 1fr;
            }

            .lang-switch {
                position: relative;
                top: auto;
                right: auto;
                text-align: center;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="lang-switch">
        <a href="?lang=<?= $lang_code === 'pl' ? 'en' : 'pl' ?>">
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

    <div class="decoration decoration-1"></div>
    <div class="decoration decoration-2"></div>
    <div class="decoration decoration-3"></div>
    <div class="decoration decoration-4"></div>

    <div class="container">
        <div class="error-code"><?= htmlspecialchars($t['404'], ENT_QUOTES, 'UTF-8') ?></div>
        <h1 class="error-title"><?= htmlspecialchars($t['title'], ENT_QUOTES, 'UTF-8') ?></h1>
        <p class="error-message">
            <?= htmlspecialchars($t['notfound'], ENT_QUOTES, 'UTF-8') ?>
        </p>
        <a href="/" class="home-button"><?= htmlspecialchars($t['back'], ENT_QUOTES, 'UTF-8') ?></a>

        <div class="catalogs-section">
            <h2 class="catalogs-title"><?= htmlspecialchars($t['catalogs_title'], ENT_QUOTES, 'UTF-8') ?></h2>
            <p class="catalogs-desc"><?= htmlspecialchars($t['catalogs_desc'], ENT_QUOTES, 'UTF-8') ?></p>
            
            <div class="catalogs-grid">
                <?php foreach ($current_catalogs as $catalog): ?>
                    <a href="<?= htmlspecialchars($catalog['url'], ENT_QUOTES, 'UTF-8') ?>" class="catalog-link">
                        <?= htmlspecialchars($catalog['name'], ENT_QUOTES, 'UTF-8') ?>
                        <?= htmlspecialchars($t['more_urls'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
