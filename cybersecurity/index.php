<?php
$lang_code = $_GET['lang'] ?? 'en';
$translations = [
    'en' => [
        'html_lang'            => 'en',
        'title'                => 'Kotokk - PenTest Portfolio',
        'meta_description'     => 'My cybersecurity devices & projects',
        'logo_main'            => 'CYBERSEC',
        'logo_sub'             => 'PROJECTS',
        'nav_about'            => 'About',
        'nav_tools'            => 'Tools',
        'nav_skills'           => 'Skills',
        'nav_contact'          => 'Contact',
        'hero_title_pre'       => 'My',
        'hero_title_highlight' => 'pentesting',
        'hero_title_post'      => 'devices',
        'hero_desc'            => 'Exploring wireless vulnerabilities and security devices for educational purposes, genuine interest and to understand how everything works.',
        'hero_btn'             => 'Explore My Tools',
        'about_section'        => 'About Me',
        'about_p1'             => "I'm a penetration tester – not in a highly professional capacity, but I do it for fun and because I find it genuinely interesting. I enjoy working with devices like the T-Embed or soon Flipper Zero and enhancing them with extensions to make them even more powerful.",
        'about_p2'             => '(I do not support any black-hat activities.)',
        'about_p3'             => "Sometimes I also use my computer, but that's rare, as I mostly rely on the devices I already mentioned. I'm planning to build my first self-made device – ESP32 CYD (I already have a screen with an ESP32). After that, I'll be getting a Flipper Zero, and once I have the funds, I plan to buy a HackRF One PortaPack H4M (Flipper is just a toy compared to that lol).",
        'tools_section'        => 'My Tools',
        'tool1_title'          => 'T-embed CC1101',
        'tool1_desc'           => 'RF communication device using the CC1101 transceiver for intercepting and analyzing wireless signals in the sub-1GHz range.',
        'tool1_feat1'          => 'All in one',
        'tool1_feat2'          => 'Bruce Firmware',
        'tool1_feat3'          => 'RF Signal Analysis',
        'tool1_feat4'          => 'WiFi & BLE Attacks',
        'tool1_feat5'          => 'IR Remote & Receiver',
        'tool1_feat6'          => 'NFC/RFID',
        'tool2_title'          => 'M5 StickC Plus 2',
        'tool2_desc'           => 'Portable device with WiFi, Bluetooth and IR.',
        'tool2_feat1'          => 'Portable',
        'tool2_feat2'          => 'Bruce Firmware',
        'tool2_feat3'          => 'WiFi & BLE Attacks',
        'tool2_feat4'          => 'IR Remote',
        'tool3_title'          => 'ESP32 CYD',
        'tool3_desc'           => 'Custom-built security monitoring device with integrated display for real-time network scanning, packet analysis, and vulnerability detection.',
        'tool3_feat1'          => 'Network Security',
        'tool3_feat2'          => 'Marauder firmware',
        'tool3_feat3'          => 'WiFi & BLE Attacks & Scanning',
        'tool3_feat4'          => 'Real-time Analysis',
        'tool4_title'          => 'Future Additions',
        'tool4_desc'           => 'Planning to expand my toolkit with more advanced hardware for comprehensive security analysis.',
        'tool4_feat1'          => 'Flipper Zero',
        'tool4_feat2'          => 'HackRF One PortaPack H4M',
        'tool4_feat3'          => 'BW16 5GHz deauther',
        'cap_section'          => 'What Can I Do?',
        'cap_intro'            => 'With my current toolkit, I can perform various security tests and analyses:',
        'cap_li1'              => 'Deauth 2.4GHz and soon 5GHz WiFi',
        'cap_li2'              => 'Jam RF and IR signals',
        'cap_li3'              => 'Copy and replay any RF signal (Car, Garage, Gate etc.)',
        'cap_li4'              => 'Copy and replay any IR signal (LEDs, TVs, Projectors)',
        'cap_li5'              => 'Control any device with Bluetooth',
        'cap_li6'              => 'Copy/Scan any RFID/NFC card',
        'cap_li7'              => 'Create fake WiFis (EvilPortals, Beacon spam, clone existing WiFis)',
        'cap_share'            => 'I share almost anything I use, build and what I can do with these on my <a href="https://tiktok.com/@kotokk_dev" target="_blank">TikTok</a>.',
        'skills_section'       => 'Technical Skills',
        'skill1'               => 'RF Analysis',
        'skill2'               => 'IoT Devices',
        'skill3'               => 'Network Security',
        'skill4'               => 'Hardware Hacking',
        'skill5'               => 'Signal Analysis',
        'skill6'               => 'Firmware Development',
        'skill7'               => 'Penetration Testing',
        'skill8'               => 'Wireless Protocols',
        'contact_title'        => 'Contact',
        'contact_desc'         => 'Feel free to reach out for questions',
        'contact_discord'      => 'Discord: @kotokk_dev',
        'footer_copy'          => '&copy; 2025 <a style="color: #5b84c6;" href="https://kotokk.dev">kotokk.dev</a><br>All rights reserved.',
        'linktree'             => 'Link to devices and modules',
        'linktreeinfo'         => 'All the devices and modules I use are <a href="/links">here</a> (with purchase links)',
        'back_button'          => 'Back to main page',

    ],
    'pl' => [
        'html_lang'            => 'pl',
        'title'                => 'Kotokk - Portfolio PenTestingu',
        'meta_description'     => 'Moje urządzenia i projekty cyberbezpieczeństwa',
        'logo_main'            => 'CYBERSEC',
        'logo_sub'             => 'PROJEKTY',
        'nav_about'            => 'O mnie',
        'nav_tools'            => 'Narzędzia',
        'nav_skills'           => 'Umiejętności',
        'nav_contact'          => 'Kontakt',
        'hero_title_pre'       => 'Etyczne',
        'hero_title_highlight' => 'Testy',
        'hero_title_post'      => 'Penetracyjne',
        'hero_desc'            => 'Badanie podatności bezprzewodowych sieci i urządzeń w celach edukacyjnych, z zainteresowania i by zrozumieć, jak to wszystko działa.',
        'hero_btn'             => 'Poznaj moje narzędzia',
        'about_section'        => 'O mnie',
        'about_p1'             => 'Jestem testerem penetracyjnym – nie w pełni profesjonalnym, ale robię to dla zabawy i z prawdziwego zainteresowania. Lubię pracować z urządzeniami takimi jak T-Embed czy niedługo Flipper Zero i wzbogacać je o rozszerzenia, by były jeszcze potężniejsze.',
        'about_p2'             => '(Nie popieram działań blackhat.)',
        'about_p3'             => 'Czasem korzystam też z komputera, ale rzadko – głównie opieram się na wspomnianych urządzeniach. Planuję zbudować mój pierwszy własny sprzęt – ESP32 CYD (mam już ekran z ESP32). Potem kupię Flipper Zero, a gdy będę mieć wystarczająco pieniędzy, HackRF One PortaPack H4M (Flipper to zabawka przy tym).',
        'tools_section'        => 'Moje narzędzia',
        'tool1_title'          => 'T-embed CC1101',
        'tool1_desc'           => 'Urządzenie RF z transceiverem CC1101 do przechwytywania i analizy sygnałów radiowych w paśmie sub-1 GHz.',
        'tool1_feat1'          => 'Wszystko w jednym',
        'tool1_feat2'          => 'Bruce Firmware',
        'tool1_feat3'          => 'Analiza sygnału RF',
        'tool1_feat4'          => 'Ataki WiFi & BLE',
        'tool1_feat5'          => 'IR',
        'tool1_feat6'          => 'NFC/RFID',
        'tool2_title'          => 'M5 StickC Plus 2',
        'tool2_desc'           => 'Przenośne urządzenie z WiFi, Bluetooth i IR.',
        'tool2_feat1'          => 'Przenośne',
        'tool2_feat2'          => 'Bruce Firmware',
        'tool2_feat3'          => 'Ataki WiFi & BLE',
        'tool2_feat4'          => 'IR',
        'tool3_title'          => 'ESP32 CYD',
        'tool3_desc'           => 'Własnoręcznie zbudowane urządzenie do monitoringu bezpieczeństwa z wyświetlaczem do skanowania sieci, analizy pakietów i wykrywania podatności w czasie rzeczywistym.',
        'tool3_feat1'          => 'Bezpieczeństwo sieci',
        'tool3_feat2'          => 'Marauder firmware',
        'tool3_feat3'          => 'Ataki & skanowanie WiFi & BLE',
        'tool3_feat4'          => 'Analiza w czasie rzeczywistym',
        'tool4_title'          => 'Plany na przyszłość',
        'tool4_desc'           => 'Planuję rozbudować zestaw o zaawansowany hardware do kompleksowej analizy bezpieczeństwa.',
        'tool4_feat1'          => 'Flipper Zero',
        'tool4_feat2'          => 'HackRF One PortaPack H4M',
        'tool4_feat3'          => 'BW16 5GHz deauther',
        'cap_section'          => 'Co potrafię?',
        'cap_intro'            => 'Dzięki moim narzędziom mogę wykonywać różne testy i analizy bezpieczeństwa:',
        'cap_li1'              => 'Deauth na 2.4 GHz, a wkrótce też 5 GHz WiFi',
        'cap_li2'              => 'Zakłócanie sygnałów RF i IR',
        'cap_li3'              => 'Przechwytywanie i odtwarzanie dowolnego sygnału RF (samochód, garaż, brama itp.)',
        'cap_li4'              => 'Przechwytywanie i odtwarzanie dowolnego sygnału IR (LEDy, telewizory, projektory)',
        'cap_li5'              => 'Sterowanie dowolnym urządzeniem przez Bluetooth',
        'cap_li6'              => 'Kopiowanie/skanowanie dowolnej karty RFID/NFC',
        'cap_li7'              => 'Tworzenie fałszywych sieci WiFi (EvilPortals, beacon spam, klonowanie istniejących)',
        'cap_share'            => 'Większość tego, co robię i buduję, pokazuję na <a href="https://tiktok.com/@kotokk_dev" target="_blank">TikToku</a>.',
        'skills_section'       => 'Umiejętności techniczne',
        'skill1'               => 'Analiza RF',
        'skill2'               => 'Urządzenia IoT',
        'skill3'               => 'Bezpieczeństwo sieci',
        'skill4'               => 'Testy sieci',
        'skill5'               => 'Analiza sygnałów',
        'skill6'               => 'Tworzenie firmware’u',
        'skill7'               => 'Testy penetracyjne',
        'skill8'               => 'Protokoły bezprzewodowe',
        'contact_title'        => 'Kontakt',
        'contact_desc'         => 'Zapraszam do pytań',
        'contact_discord'      => 'Discord: @kotokk_dev',
        'footer_copy'          => '&copy; 2025 <a style="color: #5b84c6;" href="https://kotokk.dev">kotokk.dev</a><br>Wszelkie prawa zastrzeżone.',
        'linktree'             => 'Link do urządzeń i modułów',
        'back_button'          => 'Wróć do strony głównej',
        'linktreeinfo'         => 'Wszystkie urządzenia i moduły które używam, są zebrane <a href="/links">tutaj</a> (z linkami do zakupu)',

    ],
];
$t = $translations[$lang_code] ?? $translations['en'];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($t['html_lang'], ENT_QUOTES) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['title'], ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_description'], ENT_QUOTES) ?>" />
    <link rel="icon" type="image/png" href="photos/website-icon.jpg" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="cyber-bg">
        <div class="cyber-grid"></div>
        <div class="cyber-circuit"></div>
    </div>
    <header>
        <div class="container">
                                                  <button onclick="window.location.href='/index.php'" class="back-button">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m12 19-7-7 7-7"/>
    <path d="M19 12H5"/>
  </svg>
<?= htmlspecialchars($t['back_button'], ENT_QUOTES) ?>
</button><br>
              <a href="?lang=<?= $lang_code === 'pl' ? 'en' : 'pl' ?>">
    <img src="photos/<?= $lang_code === 'pl' ? 'united-states.png' : 'poland.png' ?>"
         alt="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
         title="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
         width="30" height="30" loading="lazy">
  </a>
            <nav>
                <div class="logo"><?= htmlspecialchars($t['logo_main'], ENT_QUOTES) ?> <span><?= htmlspecialchars($t['logo_sub'], ENT_QUOTES) ?></span></div>
                <ul class="nav-links">
                    <li><a href="#about"><?= htmlspecialchars($t['nav_about'], ENT_QUOTES) ?></a></li>
                    <li><a href="#tools"><?= htmlspecialchars($t['nav_tools'], ENT_QUOTES) ?></a></li>
                    <li><a href="#skills"><?= htmlspecialchars($t['nav_skills'], ENT_QUOTES) ?></a></li>
                    <li><a href="#contact"><?= htmlspecialchars($t['nav_contact'], ENT_QUOTES) ?></a></li>
                </ul>
            </nav>
            <div class="hero">
                <div class="hero-content">
                    <h1 class="animate"><?= htmlspecialchars($t['hero_title_pre'], ENT_QUOTES) ?> <span class="glitch" data-text="<?= htmlspecialchars($t['hero_title_highlight'], ENT_QUOTES) ?>"><?= htmlspecialchars($t['hero_title_highlight'], ENT_QUOTES) ?></span> <?= htmlspecialchars($t['hero_title_post'], ENT_QUOTES) ?></h1>
                    <p class="animate delay-1"><?= htmlspecialchars($t['hero_desc'], ENT_QUOTES) ?></p>
                    <a href="#tools" class="btn animate delay-2"><?= htmlspecialchars($t['hero_btn'], ENT_QUOTES) ?></a>
                </div>
            </div>
        </div>
    </header>
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title"><?= htmlspecialchars($t['about_section'], ENT_QUOTES) ?></h2>
            <div class="about-content">
                <div class="about-text animate">
                    <p><?= htmlspecialchars($t['about_p1'], ENT_QUOTES) ?></p>
                    <p><strong><?= htmlspecialchars($t['about_p2'], ENT_QUOTES) ?></strong></p>
                    <p><?= htmlspecialchars($t['about_p3'], ENT_QUOTES) ?></p>
                </div>
                <div class="about-image animate delay-1">
                    <img src="photos/work.jpg" alt="Cybersecurity Setup" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    <section id="tools" class="section">
        <div class="container">
            <h2 class="section-title"><?= htmlspecialchars($t['tools_section'], ENT_QUOTES) ?></h2>
            <div class="tools-container">
                <div class="tool-card animate">
                    <div class="tool-image"><img src="photos/t-embed.jpg" alt="T-embed CC1101" loading="lazy"></div>
                    <h3 class="tool-title"><?= htmlspecialchars($t['tool1_title'], ENT_QUOTES) ?></h3>
                    <p class="tool-description"><?= htmlspecialchars($t['tool1_desc'], ENT_QUOTES) ?></p>
                    <ul class="tool-features">
                        <li><?= htmlspecialchars($t['tool1_feat1'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool1_feat2'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool1_feat3'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool1_feat4'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool1_feat5'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool1_feat6'], ENT_QUOTES) ?></li>
                    </ul>
                </div>
                <div class="tool-card animate delay-1">
                    <div class="tool-image"><img src="photos/m5stick.jpg" alt="M5 StickC Plus 2" loading="lazy"></div>
                    <h3 class="tool-title"><?= htmlspecialchars($t['tool2_title'], ENT_QUOTES) ?></h3>
                    <p class="tool-description"><?= htmlspecialchars($t['tool2_desc'], ENT_QUOTES) ?></p>
                    <ul class="tool-features">
                        <li><?= htmlspecialchars($t['tool2_feat1'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool2_feat2'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool2_feat3'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool2_feat4'], ENT_QUOTES) ?></li>
                    </ul>
                </div>
                <div class="tool-card animate delay-2">
                    <div class="tool-image"><img src="photos/cyd.jpg" alt="ESP32 CYD" loading="lazy"></div>
                    <h3 class="tool-title"><?= htmlspecialchars($t['tool3_title'], ENT_QUOTES) ?></h3>
                    <p class="tool-description"><?= htmlspecialchars($t['tool3_desc'], ENT_QUOTES) ?></p>
                    <ul class="tool-features">
                        <li><?= htmlspecialchars($t['tool3_feat1'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool3_feat2'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool3_feat3'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool3_feat4'], ENT_QUOTES) ?></li>
                    </ul>
                </div>
                <div class="tool-card animate delay-3">
                    <div class="tool-image"><img src="photos/coming-soon.png" alt="Future Additions" loading="lazy"></div>
                    <h3 class="tool-title"><?= htmlspecialchars($t['tool4_title'], ENT_QUOTES) ?></h3>
                    <p class="tool-description"><?= htmlspecialchars($t['tool4_desc'], ENT_QUOTES) ?></p>
                    <ul class="tool-features">
                        <li><?= htmlspecialchars($t['tool4_feat1'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool4_feat2'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['tool4_feat3'], ENT_QUOTES) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="capabilities" class="section">
        <div class="container">
            <h2 class="section-title"><?= htmlspecialchars($t['cap_section'], ENT_QUOTES) ?></h2>
            <div class="about-content">
                <div class="about-text animate">
                    <p><?= htmlspecialchars($t['cap_intro'], ENT_QUOTES) ?></p>
                    <ul>
                        <li><?= htmlspecialchars($t['cap_li1'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['cap_li2'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['cap_li3'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['cap_li4'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['cap_li5'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['cap_li6'], ENT_QUOTES) ?></li>
                        <li><?= htmlspecialchars($t['cap_li7'], ENT_QUOTES) ?></li>
                    </ul>
                    <p><?= $t['cap_share'] ?></p>
                </div>
            </div>
        </div>
    </section>
    <section id="skills" class="section">
        <div class="container">
            <h2 class="section-title"><?= htmlspecialchars($t['skills_section'], ENT_QUOTES) ?></h2>
            <div class="skills-container">
                <div class="skill-item animate"><?= htmlspecialchars($t['skill1'], ENT_QUOTES) ?></div>
                <div class="skill-item animate delay-1"><?= htmlspecialchars($t['skill2'], ENT_QUOTES) ?></div>
                <div class="skill-item animate delay-2"><?= htmlspecialchars($t['skill3'], ENT_QUOTES) ?></div>
                <div class="skill-item animate delay-3"><?= htmlspecialchars($t['skill4'], ENT_QUOTES) ?></div>
                <div class="skill-item animate"><?= htmlspecialchars($t['skill5'], ENT_QUOTES) ?></div>
                <div class="skill-item animate delay-1"><?= htmlspecialchars($t['skill6'], ENT_QUOTES) ?></div>
                <div class="skill-item animate delay-2"><?= htmlspecialchars($t['skill7'], ENT_QUOTES) ?></div>
                <div class="skill-item animate delay-3"><?= htmlspecialchars($t['skill8'], ENT_QUOTES) ?></div>
            </div>
        </div>

            <section id="skills" class="section">
        <div class="container">
            <h2 class="section-title"><?= htmlspecialchars($t['linktree'], ENT_QUOTES) ?></h2>
            <div class="skills-container">
                    <p><?= $t['linktreeinfo'] ?></p>
            </div>
        </div>
    </section>
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?= htmlspecialchars($t['contact_title'], ENT_QUOTES) ?></h3>
                    <p><?= htmlspecialchars($t['contact_desc'], ENT_QUOTES) ?></p>
                    <p><?= htmlspecialchars($t['contact_discord'], ENT_QUOTES) ?></p>
                </div>
            </div>
            <div class="copyright">
                <?= $t['footer_copy'] ?>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
