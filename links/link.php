<?php
$lang_code = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'    => 'en',
        'title'        => 'Kotokk - Links',
        'meta_desc'    => 'Links to devices & modules I use',
        'translate'    => 'Przetłumacz na Polski',
        'profile_name' => 'Kotokk',
        'bio'          => 'Content Creator | Developer | Pen tester',
        'social'       => [
            ['icon'=>'fab fa-github','url'=>'https://github.com/Kotok7','title'=>'GitHub'],
            ['icon'=>'fab fa-discord','url'=>'https://discord.gg/xPaqvs5NHk','title'=>'Discord'],
            ['icon'=>'fab fa-tiktok','url'=>'https://tiktok.com/@kotokk_dev','title'=>'TikTok'],
            ['icon'=>'fas fa-user','url'=>'https://kotokk.dev','title'=>'About Me'],
        ],
        'sections' => [
            [
                'title'=>'GitHub',
                'items'=>[
                    ['icon'=>'fas fa-code-branch','url'=>'https://github.com/unveroleone/HackStarter-Kit','label'=>'Files','desc'=>'Files for Bruce Firmware'],
                    ['icon'=>'fas fa-code-branch','url'=>'https://github.com/wsedits01/Bruce-Themes','label'=>'Themes','desc'=>'Themes for Bruce firmware'],
                    ['icon'=>'fas fa-star','url'=>'https://github.com/Kotok7','label'=>'My GitHub','desc'=>'Check out my latest work'],
                ]
            ],
            [
                'title'=>'Devices',
                'items'=>[
                    ['icon'=>'fas fa-microchip','url'=>'https://shop.m5stack.com/products/m5stickc-plus2-esp32-mini-iot-development-kit','label'=>'M5 StickC','desc'=>'Compact ESP32 development kit'],
                    ['icon'=>'fas fa-keyboard','url'=>'https://shop.m5stack.com/products/m5stack-cardputer-with-m5stamps3-v1-1','label'=>'Cardputer','desc'=>'Pocket-sized computer with keyboard'],
                    ['icon'=>'fas fa-robot','url'=>'https://flipperzero.one/','label'=>'Flipper Zero','desc'=>'Multi-tool device for pentesters'],
                    ['icon'=>'fas fa-broadcast-tower','url'=>'https://lilygo.cc/products/t-embed-cc1101?_pos=2&_sid=9370fb7ef&_ss=r','label'=>'T-embed CC1101','desc'=>'Sub-GHz transceiver board'],
                    ['icon'=>'fas fa-route','url'=>'https://www.zerotrace.pw/','label'=>'ZeroTrace','desc'=>'ESP32 with cool software'],
                ]
            ],
            [
                'title'=>'Modules and Others',
                'items'=>[
                    ['icon'=>'fab fa-bluetooth','url'=>'https://pl.aliexpress.com/item/1005007798178089.html','label'=>'NRF24','desc'=>'Bluetooth jammer'],
                    ['icon'=>'fas fa-signal-slash','url'=>'https://pl.aliexpress.com/item/1005004979640042.html','label'=>'CC1101','desc'=>'RF module'],
                    ['icon'=>'fas fa-sd-card','url'=>'https://pl.aliexpress.com/item/1005007202930058.html','label'=>'SD card sniffer','desc'=>'For reading SD cards and adding more modules'],
                    ['icon'=>'fas fa-memory','url'=>'https://pl.aliexpress.com/item/1005008057565487.html','label'=>'SD Card','desc'=>'Buy max 32 GB'],
                    ['icon'=>'fas fa-plug','url'=>'https://pl.aliexpress.com/item/1005007824170918.html','label'=>'Male to female cables','desc'=>'Connectors for electronics'],
                    ['icon'=>'fas fa-project-diagram','url'=>'https://pl.aliexpress.com/item/1005005556476920.html','label'=>'Female to female cables','desc'=>'Connectors for electronics'],
                ]
            ]
        ],
        'footer'       => '© 2025 kotokk.dev',
        'back_button'  => 'Back to main page',
    ],
    'pl' => [
        'html_lang'    => 'pl',
        'title'        => 'Kotokk – Linki',
        'meta_desc'    => 'Linki do urządzeń i modułów, których używam',
        'translate'    => 'Translate to English',
        'profile_name' => 'Kotokk',
        'bio'          => 'Twórca treści | Programista | Tester zabezpieczeń',
        'social'       => [
            ['icon'=>'fab fa-github','url'=>'https://github.com/Kotok7','title'=>'GitHub'],
            ['icon'=>'fab fa-discord','url'=>'https://discord.gg/xPaqvs5NHk','title'=>'Discord'],
            ['icon'=>'fab fa-tiktok','url'=>'https://tiktok.com/@kotokk_dev','title'=>'TikTok'],
            ['icon'=>'fas fa-user','url'=>'https://kotokk.dev','title'=>'O mnie'],
        ],
        'sections' => [
            [
                'title'=>'GitHub',
                'items'=>[
                    ['icon'=>'fas fa-code-branch','url'=>'https://github.com/unveroleone/HackStarter-Kit','label'=>'Pliki','desc'=>'Pliki do Bruce Firmware'],
                    ['icon'=>'fas fa-code-branch','url'=>'https://github.com/wsedits01/Bruce-Themes','label'=>'Motywy','desc'=>'Motywy do Bruce firmware'],
                    ['icon'=>'fas fa-star','url'=>'https://github.com/Kotok7','label'=>'Mój GitHub','desc'=>'Zobacz moje najnowsze projekty'],
                ]
            ],
            [
                'title'=>'Urządzenia',
                'items'=>[
                    ['icon'=>'fas fa-microchip','url'=>'https://shop.m5stack.com/products/m5stickc-plus2-esp32-mini-iot-development-kit','label'=>'M5 StickC','desc'=>'Kompaktowe urządzenie z ESP32'],
                    ['icon'=>'fas fa-keyboard','url'=>'https://shop.m5stack.com/products/m5stack-cardputer-with-m5stamps3-v1-1','label'=>'Cardputer','desc'=>'Kieszonkowy komputer z klawiaturą'],
                    ['icon'=>'fas fa-robot','url'=>'https://flipperzero.one/','label'=>'Flipper Zero','desc'=>'Multitool dla pentesterów'],
                    ['icon'=>'fas fa-broadcast-tower','url'=>'https://lilygo.cc/products/t-embed-cc1101?_pos=2&_sid=9370fb7ef&_ss=r','label'=>'T-embed CC1101','desc'=>'Moduł Sub-GHz transceiver'],
                    ['icon'=>'fas fa-route','url'=>'https://www.zerotrace.pw/','label'=>'ZeroTrace','desc'=>'ESP32 z fajnym oprogramowaniem'],
                ]
            ],
            [
                'title'=>'Moduły i inne',
                'items'=>[
                    ['icon'=>'fab fa-bluetooth','url'=>'https://pl.aliexpress.com/item/1005007798178089.html','label'=>'NRF24','desc'=>'Jammer Bluetooth'],
                    ['icon'=>'fas fa-signal-slash','url'=>'https://pl.aliexpress.com/item/1005004979640042.html','label'=>'CC1101','desc'=>'Moduł RF'],
                    ['icon'=>'fas fa-sd-card','url'=>'https://pl.aliexpress.com/item/1005007202930058.html','label'=>'Sniffer SD','desc'=>'Do odczytu kart SD i dodawania modułów'],
                    ['icon'=>'fas fa-memory','url'=>'https://pl.aliexpress.com/item/1005008057565487.html','label'=>'Karta SD','desc'=>'Max 32 GB'],
                    ['icon'=>'fas fa-plug','url'=>'https://pl.aliexpress.com/item/1005007824170918.html','label'=>'Kable męsko–żeńskie','desc'=>'Kable do CC1101/NRF24'],
                    ['icon'=>'fas fa-project-diagram','url'=>'https://pl.aliexpress.com/item/1005005556476920.html','label'=>'Kable żeńsko–żeńskie','desc'=>'Kable do CC1101/NRF24'],
                ]
            ]
        ],
        'footer'       => '© 2025 kotokk.dev',
        'back_button'  => 'Wróć do strony głównej',
    ]
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
    <link rel="icon" type="image/png" href="photos/website-icon-link.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <br>
            <a href="?lang=<?= $lang_code==='pl'?'en':'pl' ?>">
            <img src="<?= $lang_code==='pl'?'photos/united-states.png':'photos/poland.png' ?>"
                 alt="<?= $t['translate'] ?>"
                 title="<?= $t['translate'] ?>"
                 loading="lazy" style="width:30px;height:30px;">
        </a>
    <div class="container">
        <div class="profile">
            <img src="photos/profile.jpg" alt="Profile Picture" class="profile-img">
            <h1><?= $t['profile_name'] ?></h1>
            <p class="bio"><?= $t['bio'] ?></p>
            <div class="social-mini">
                <?php foreach($t['social'] as $s): ?>
                <a href="<?= $s['url'] ?>" title="<?= $s['title'] ?>">
                    <i class="<?= $s['icon'] ?>" style="color:white;font-size:24px;"></i>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php foreach($t['sections'] as $section): ?>
        <div class="section">
            <h3 class="section-title"><?= $section['title'] ?></h3>
            <div class="links">
                <?php foreach($section['items'] as $item): ?>
                <a href="<?= $item['url'] ?>" class="link">
                    <div class="link-icon"><i class="<?= $item['icon'] ?>"></i></div>
                    <div class="link-content">
                        <div class="link-title"><?= $item['label'] ?></div>
                        <div class="link-desc"><?= $item['desc'] ?></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <footer>
            <?= $t['footer'] ?>
        </footer>
    </div>
</body>
</html>