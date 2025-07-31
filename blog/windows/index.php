<?php
$lang_code   = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'        => 'en',
        'title'            => 'Blog - Why do I use Windows?',
        'meta_description' => 'Why I stick with Windows despite its flaws, especially on a ThinkPad',
        'page_title'       => 'My First Post – Why do I Use Windows',
        'subtitle'         => 'Why I stick with Windows despite its flaws, especially on a ThinkPad',
        'author_name'      => 'Kotokk',
        'author_date'      => 'May 13, 2025',
        'intro_p'          => 'Many people have suggested to try Linux - especially since I own a ThinkPad. With so many distributions, it seems everyone could find something for themselves, but…',
        'h2_step1'         => 'Windows Shortcomings',
        'step1_p1'         => 'Windows certainly has its drawbacks - sometimes being forced to install updates, telemetry sent to Microsoft, relatively high RAM usage compared to Linux, and fewer customization options. So why do I still prefer Windows?',
        'step1_p2'         => 'Personally, I update Windows once a month, then disable Windows Defender and run a few commands to turn off unnecessary services that re-enable themselves after updates. Yes, it is annoying. I have 24 GB of RAM, so memory use isn’t an issue. As for telemetry, I disable most of it - though you can’t turn it off completely. It doesn’t bother me much, but I’d prefer to choose whether my data goes to unknown servers. And while I loved how customizable Linux is, there was one thing I missed…',
        'h2_culture'       => 'User Convenience',
        'culture_p1'       => 'That convenience: never worrying about a boot error because I forgot to update. “Oh right, I forgot to upgrade.” For some that’s nitpicking, but I need my system to work reliably, with all apps and games supported. That’s why I chose Windows - on Linux I always ran into support issues.',
        'quote1'           => 'I’m not saying Linux is bad, it’s just not for me.',
        'culture_p2'       => 'Windows isn’t perfect either, but I can do everything - from gaming and programming to graphic work - without needing Wine or workarounds. Everything runs natively.',
        'caption1'         => 'My ThinkPad with a sticker I got when I had Linux',
        'caption2'         => 'Programming with my cat!',
        'caption3'         => 'ThinkPad with Linux!!!',
        'caption4'         => 'My laptop’s favorite photo',
        'h2_culinary'      => 'Which Linux Distros I Tried – and Which Was Best?',
        'culinary_p1'      => 'I used Mint, Arch, then Mint again, and Kali. Mint was by far the best: a beautiful desktop, almost every app worked, and overall no major issues - but…',
        'culinary_p2'      => 'I still needed Windows installed to play my favorite games (even those without anti-cheat), because they didn’t run properly even with Proton. It frustrated me to switch OS just to play in a break from coding. I ended up booting Linux once a month, then removed it altogether.',
        'h2_trek'          => 'The Terminal',
        'trek_p1'          => 'One more issue: the terminal. Some see it as a pro, others a con. I couldn’t remember hundreds of thousands of commands, so each time I had to ask AI what to do - instead of simply clicking a GUI like on Windows.',
        'trek_p2'          => 'Sure, the Linux terminal can help a lot, but for me it caused more problems than it solved.',
        'quote2'           => 'I’ll never forget fun commands like cmatrix, asciiquarium, hollywood, neofetch, etc.',
        'h2_reflection'    => 'My Takeaways',
        'reflection_p1'    => 'Everyone should use the system that suits them best. Forcing or convincing people “Windows is this, Linux is that...” makes no sense. That’s why I avoid Linux communities - they can be toxic.',
        'reflection_p2'    => 'For now, I’ll stick with Windows 11. It’s simply the best fit for what I do.',
        'tags'             => ['OS', 'Windows', 'ThinkPad', 'Linux', 'Tech'],
        'footer_copy'      => '© 2025',
        'footer_reserved'  => 'All rights reserved',
        'translate'        => 'Switch to Polish',
        'message_leave'    => 'Leave your message here',
        'message_letknow'  => 'Let others know that you were here!',
        'nick'             => 'Your nick',
        'add_button'       => 'Add',
        'wait'             => 'You must wait 10 minutes before posting another message, and until the verification is complete.',
        'facts_error'      => 'Message must be between 3 and 100 characters long.',
        'back_button'      => 'Back to main page',
    ],
    'pl' => [
        'html_lang'        => 'pl',
        'title'            => 'Blog - Dlaczego używam Windowsa?',
        'meta_description' => 'Dlaczego zostaję przy Windowsie mimo wad, zwłaszcza na ThinkPadzie',
        'page_title'       => 'Mój pierwszy wpis – Dlaczego używam Windowsa',
        'subtitle'         => 'Dlaczego zostaję przy Windowsie mimo wad, zwłaszcza na ThinkPadzie',
        'author_name'      => 'Kotokk',
        'author_date'      => '13 maja 2025',
        'intro_p'          => 'Wiele osób zachęcało mnie, żebym spróbował Linuxa - szczególnie że mam ThinkPada. Różnorodność dystrybucji daje wrażenie, że każdy znajdzie coś dla siebie, jednak…',
        'h2_step1'         => 'Wady Windowsa',
        'step1_p1'         => 'Windows ma swoje minusy: wymuszone aktualizacje, telemetryczne dane wysyłane do Microsoftu, większe zużycie RAM-u niż w Linuxie i skromniejsze możliwości personalizacji. Dlaczego więc wciąż wybieram Windowsa?',
        'step1_p2'         => 'Osobiście aktualizuję Windowsa raz w miesiącu, potem wyłączam Windows Defender i uruchamiam kilka komend, by wyłączyć niepotrzebne usługi włączające się po aktualizacji. Tak, jest to denerwujące. Mam 24 GB RAM-u, więc zużycie pamięci mi nie przeszkadza. Telemetrię ograniczam do minimum - choć nie da się jej wyłączyć całkowicie. To mi nie przeszkadza, ale wolałbym sam decydować, czy moje dane trafiają na zewnętrzne serwery. A choć lubię pełną personalizację Linuxa, brakowało mi jednej rzeczy…',
        'h2_culture'       => 'Komfort użytkowania',
        'culture_p1'       => 'Chodzi o pewność, że system uruchomi się zawsze i bez niespodzianek. „O, zapomniałem zaktualizować” - dla mnie to ważne, by system działał niezawodnie i by wszystkie aplikacje oraz gry były wspierane. Dlatego wybrałem Windowsa - na Linuxie ciągle trafiałem na problemy z kompatybilnością.',
        'quote1'           => 'Nie twierdzę, że Linux jest zły - po prostu nie jest dla mnie.',
        'culture_p2'       => 'Windows też nie jest idealny, ale mogę na nim zrobić wszystko - od gier, przez programowanie, po pracę graficzną - bez Wine czy innych obejść. Wszystko działa natywnie.',
        'caption1'         => 'Mój ThinkPad z naklejką, którą przykleiłem gdy miałem Linuxa',
        'caption2'         => 'Programowanie z moim kotem!',
        'caption3'         => 'ThinkPad z Linuxem!!!',
        'caption4'         => 'Ulubione zdjęcie mojego laptopa',
        'h2_culinary'      => 'Jakie dystrybucje Linuxa testowałem i która była najlepsza?',
        'culinary_p1'      => 'Próbowałem Minta, Archa, ponownie Minta i Kali. Mint był zdecydowanie najlepszy: estetyczny pulpit, większość aplikacji działała bez problemu - jednak…',
        'culinary_p2'      => 'Wciąż musiałem mieć Windowsa na dysku, żeby zagrać w ulubione gry (nawet te bez anty-cheat), bo nawet przez Protona nie działały poprawnie. Frustrowało mnie, że muszę zmieniać system tylko po to, by pograć. Dlatego Linuxa uruchamiałem raz w miesiącu, aż w końcu usunąłem go z dysku.',
        'h2_trek'          => 'Terminal',
        'trek_p1'          => 'Jeszcze jedno - terminal. Dla niektórych zaleta, dla innych wada. Nie dałem rady zapamiętać setek tysięcy poleceń, więc za każdym razem pytałem AI, co zrobić - zamiast klikania w GUI jak na Windowsie.',
        'trek_p2'          => 'Terminal pomaga w wielu zadaniach, ale dla mnie powodował więcej kłopotów niż ułatwień.',
        'quote2'           => 'Nie zapomnę jednak komend jak: cmatrix, asciiquarium, hollywood, neofetch i inne takie.',
        'h2_reflection'    => 'Moje przemyślenia',
        'reflection_p1'    => 'Niech każdy wybiera system, który mu odpowiada. Przekonywanie “Linux jest lepszy, Windows gorszy, Mac jeszcze co innego” mija się z celem. Unikam społeczności Linuxa - bywają zbyt toksyczne.',
        'reflection_p2'    => 'Na razie zostaję przy Windows 11. To najlepszy wybór dla moich potrzeb.',
        'tags'             => ['OS', 'Windows', 'ThinkPad', 'Linux', 'Tech'],
        'footer_copy'      => '© 2025',
        'footer_reserved'  => 'Wszelkie prawa zastrzeżone',
        'translate'        => 'Przełącz na angielski',
        'message_leave'    => 'Zostaw wiadomość',
        'message_letknow'  => 'Napisz, co o tym myślisz!',
        'nick'             => 'Pseudonim',
        'add_button'       => 'Dodaj',
        'wait'             => 'Musisz odczekać 10 minut przed wpisaniem kolejnej wiadomości oraz poczekać na zakończenie weryfikacji.',
        'facts_error'      => 'Wiadomość musi mieć od 3 do 100 znaków.',
        'back_button'      => 'Wróć do strony głównej',
    ],
];

if (!isset($translations[$lang_code])) {
    $lang_code = 'en';
}
$t = $translations[$lang_code];

$storedNick = $_COOKIE['blog_nick'] ?? null;
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($t['html_lang'], ENT_QUOTES) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['title'], ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_description'], ENT_QUOTES) ?>">
    <link rel="icon" type="image/png" href="photos/website-icon.png">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js?v=123" defer></script>
      <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
</head>
<body>
    <header>
        <div class="header-bg"></div>
        <div class="header-content">
                                      <button onclick="window.location.href='/index.php'" class="back-button">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m12 19-7-7 7-7"/>
    <path d="M19 12H5"/>
  </svg>
<?= htmlspecialchars($t['back_button'], ENT_QUOTES) ?>
</button><br><br>
            <a href="?lang=<?= $lang_code === 'pl' ? 'en' : 'pl' ?>">
                <img
                    src="/photos/<?= $lang_code === 'pl' ? 'united-states.png' : 'poland.png' ?>"
                    alt="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
                    title="<?= htmlspecialchars($t['translate'], ENT_QUOTES) ?>"
                    width="30" height="30" loading="lazy"
                >
            </a>
            <h1 class="title"><?= htmlspecialchars($t['page_title'], ENT_QUOTES) ?></h1>
            <p class="subtitle"><?= htmlspecialchars($t['subtitle'], ENT_QUOTES) ?></p>
            <div class="author">
                <div class="author-img"><img src="photos/profile-picture.jpg" alt="Profile picture" class="author-img" loading="lazy"></div>
                <div class="author-info">
                    <p class="author-name"><?= htmlspecialchars($t['author_name'], ENT_QUOTES) ?></p>
                    <p class="author-date"><?= htmlspecialchars($t['author_date'], ENT_QUOTES) ?></p>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <p><?= htmlspecialchars($t['intro_p'], ENT_QUOTES) ?></p>

            <div class="image-container" id="image1">
                <img src="photos/thinkpad.jpg" alt="<?= htmlspecialchars($t['caption1'], ENT_QUOTES) ?>" loading="lazy">
                <div class="caption"><?= htmlspecialchars($t['caption1'], ENT_QUOTES) ?></div>
            </div>

            <h2><?= htmlspecialchars($t['h2_step1'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['step1_p1'], ENT_QUOTES) ?></p>
            <p><?= htmlspecialchars($t['step1_p2'], ENT_QUOTES) ?></p>

            <div class="divider"></div>

            <h2><?= htmlspecialchars($t['h2_culture'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['culture_p1'], ENT_QUOTES) ?></p>
            <div class="highlight">
                <p><?= htmlspecialchars($t['quote1'], ENT_QUOTES) ?></p>
            </div>
            <div class="image-container" id="image2">
                <img src="photos/comfort.jpg" alt="<?= htmlspecialchars($t['caption2'], ENT_QUOTES) ?>" loading="lazy">
                <div class="caption"><?= htmlspecialchars($t['caption2'], ENT_QUOTES) ?></div>
            </div>
            <p><?= htmlspecialchars($t['culture_p2'], ENT_QUOTES) ?></p>

            <div class="divider"></div>

            <h2><?= htmlspecialchars($t['h2_culinary'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['culinary_p1'], ENT_QUOTES) ?></p>
            <div class="image-container" id="image3">
                <img src="photos/mint.jpg" alt="<?= htmlspecialchars($t['caption3'], ENT_QUOTES) ?>" loading="lazy">
                <div class="caption"><?= htmlspecialchars($t['caption3'], ENT_QUOTES) ?></div>
            </div>
            <p><?= htmlspecialchars($t['culinary_p2'], ENT_QUOTES) ?></p>

            <div class="divider"></div>

            <h2><?= htmlspecialchars($t['h2_trek'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['trek_p1'], ENT_QUOTES) ?></p>
            <p><?= htmlspecialchars($t['trek_p2'], ENT_QUOTES) ?></p>
            <div class="image-container" id="image4">
                <img src="photos/terminal.jpg" alt="<?= htmlspecialchars($t['caption4'], ENT_QUOTES) ?>" loading="lazy">
                <div class="caption"><?= htmlspecialchars($t['caption4'], ENT_QUOTES) ?></div>
            </div>
            <div class="highlight">
                <p><?= htmlspecialchars($t['quote2'], ENT_QUOTES) ?></p>
            </div>

            <h2><?= htmlspecialchars($t['h2_reflection'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['reflection_p1'], ENT_QUOTES) ?></p>
            <p><?= htmlspecialchars($t['reflection_p2'], ENT_QUOTES) ?></p>

            <div class="tags">
                <?php foreach ($t['tags'] as $tag): ?>
                    <span class="tag"><?= htmlspecialchars($tag, ENT_QUOTES) ?></span>
                <?php endforeach; ?>
            </div>

    <section class="leave-message" id="leave-message">
      <h2><?= htmlspecialchars($t['message_leave'], ENT_QUOTES) ?></h2>
      <?php if (!empty($_GET['msg_error'])): ?>
        <p class="error">
          <?= $_GET['msg_error'] === 'length' ? htmlspecialchars($t['facts_error'], ENT_QUOTES) : htmlspecialchars($t['wait'], ENT_QUOTES) ?>
        </p>
      <?php endif; ?>
      <form action="add_message.php" method="post">
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
        $msgs2 = json_decode(file_get_contents(__DIR__ . '/messages/messages.json'), true) ?: [];
        foreach (array_reverse($msgs2) as $m) {
            echo '<blockquote><strong>' . htmlspecialchars($m['nick'], ENT_QUOTES) . '</strong>: ' .
                 nl2br(htmlspecialchars($m['text'], ENT_QUOTES)) .
                 '<br><small>' . htmlspecialchars($m['date'], ENT_QUOTES) . '</small></blockquote>';
        }
        ?>
      </div>
    </section>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <p><?= $t['footer_copy'] ?>  <a style="color: #3557b3ff;" href="https://kotokk.dev">kotokk.dev</a></p>
            <p><?= htmlspecialchars($t['footer_reserved'], ENT_QUOTES) ?></p>
        </div>
    </footer>
</body>
</html>
