<?php
$lang_code   = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'        => 'en',
        'title'            => 'Blog - Why do people fear JavaScript?',
        'meta_description' => 'A short, human take on why some people avoid or disable JavaScript on websites.',
        'page_title'       => 'Why do people fear JavaScript?',
        'subtitle'         => 'A short, human take on why some people avoid or disable JavaScript.',
        'author_name'      => 'Kotokk',
        'author_date'      => 'May 13, 2025',
        'intro_p'          => 'I don’t get it. JavaScript is the language that made the web feel alive - animations, interactive forms, instant feedback, tiny conveniences that save you a click. And yet I keep meeting people who treat it like the boogeyman: they avoid websites that use it, they install blockers, or they outright disable it in their browsers. Why?',
        'h2_step1'         => 'Historical baggage',
        'step1_p1'         => 'Part of it is historical trauma. Back in the early days the web was a static place and JavaScript quickly became the tool of choice for flashy, bloated, and sometimes hostile experiences: popups that wouldn’t close, pages that redirected you, sites that drained your CPU with endless animations. Those memories stick. When someone remembers being annoyed or tricked by a script, they learn a simple defense: “If it’s JavaScript-heavy, I’ll avoid it.”',
        'step1_p2'         => 'There’s a kernel of truth in that reaction - bad past experiences teach strong habits.',
        'h2_culture'       => 'Security and privacy anxieties',
        'culture_p1'       => 'Security and privacy anxieties are real. JavaScript can gather lots of data about what you do on a page - where you move your mouse, what you type, the time you spend reading. It’s also the vector for many attacks: cross-site scripting, malicious ads, cryptominers that hijack your CPU. For users who value privacy or who have had a bad experience, flipping JavaScript off feels like locking the front door.',
        'quote1'           => 'The problem isn’t the language; it’s how it’s used.',
        'culture_p2'       => 'For many people, disabling JS is a practical privacy and safety step - not an ideological stance.',
        'caption1'         => 'Tiny, useful JS interactions',
        'caption2'         => 'Privacy-first mindset',
        'caption3'         => 'Lightweight pages win on old devices',
        'caption4'         => 'Accessible, progressive enhancement',
        'h2_culinary'      => 'Performance matters',
        'culinary_p1'      => 'Performance matters too. On older machines or on phones with limited battery, heavy JavaScript makes pages sluggish. A site that should load in a second can take ages when the main thread is busy running scripts. For people with slow connections or cheap devices, JavaScript often equals frustration.',
        'culinary_p2'      => 'So they avoid it out of practicality, not ideology.',
        'h2_trek'          => 'A cultural piece',
        'trek_p1'          => 'There’s also a cultural piece: some tech communities prize minimalism and control. Disabling JavaScript is a kind of statement - “I value text, speed, and control over flashy design.” It’s a valid preference that signals how a person wants the web to behave.',
        'trek_p2'          => 'But when that preference turns into fear, we lose nuance - and a lot of useful web features.',
        'quote2'           => 'JavaScript is also the engine of modern UX - when used thoughtfully it helps accessibility and interactivity.',
        'h2_reflection'    => 'What would help bridge the divide?',
        'reflection_p1'    => 'Build with empathy. Offer a functional, accessible baseline for users who disable scripts, and enhance, don’t replace. Be transparent about what data you collect, and keep scripts lean and lazy-loaded so users don’t pay the cost unless they need the feature.',
        'reflection_p2'    => 'At the end of the day, fear of JavaScript often masks a reasonable desire: control, privacy, and usability. If developers listened more and shipped lighter, clearer experiences, that fear would shrink.',
        'tags'             => ['JavaScript', 'Web', 'Privacy', 'Performance', 'UX'],
        'footer_copy'      => '© 2025',
        'footer_reserved'  => 'All rights reserved',
        'translate'        => 'Switch to Polish',
        'message_leave'    => 'Leave your message here',
        'message_letknow'  => 'Let others know what you think!',
        'nick'             => 'Your nick',
        'add_button'       => 'Add',
        'wait'             => 'You must wait 10 minutes before posting another message, and until the verification is complete.',
        'facts_error'      => 'Message must be between 3 and 100 characters long.',
        'back_button'      => 'Back to main page',
    ],
    'pl' => [
        'html_lang'        => 'pl',
        'title'            => 'Blog - Dlaczego ludzie boją się JavaScriptu?',
        'meta_description' => 'Krótki, ludzki tekst o tym, dlaczego niektórzy unikają albo wyłączają JavaScript na stronach.',
        'page_title'       => 'Dlaczego ludzie boją się JavaScriptu?',
        'subtitle'         => 'Krótki, ludzki tekst o tym, dlaczego niektórzy unikają albo wyłączają JavaScript na stronach.',
        'author_name'      => 'Kotokk',
        'author_date'      => '13 maja 2025',
        'intro_p'          => 'Nie rozumiem tego. JavaScript ożywił internet - animacje, interaktywne formularze, natychmiastowe podpowiedzi, drobne ułatwienia, które oszczędzają kliknięcia. A jednak spotykam ludzi, którzy traktują go jak zło: unikają stron z JS, instalują blokery albo całkowicie wyłączają JavaScript. Dlaczego?',
        'h2_step1'         => 'Historyczne obawy',
        'step1_p1'         => 'Część winy leży w przeszłości. Wczesny web był statyczny, a JavaScript szybko stał się narzędziem do robienia efektownych, ale często ciężkich i wkurzających rzeczy: wyskakujące okienka, wymuszone przekierowania, strony, które zżerały procesor. Takie doświadczenia zapadają w pamięć - i uczą prostych zasad obronnych: „Jeśli dużo JS, omijam to.”',
        'step1_p2'         => 'To naturalna reakcja z ziarnem prawdy.',
        'h2_culture'       => 'Bezpieczeństwo i prywatność',
        'culture_p1'       => 'Obawy o bezpieczeństwo i prywatność są uzasadnione. JavaScript może zbierać dużo informacji o tym, co robisz - ruch myszką, wpisywane znaki, czas spędzony na stronie. To też wektor ataków: XSS, złośliwe reklamy, koparki kryptowalut w przeglądarce. Dla osób ceniących prywatność wyłączenie JS to często zamknięcie drzwi na klucz.',
        'quote1'           => 'Problem nie leży w języku - leży w tym, jak się go używa.',
        'culture_p2'       => 'Dla wielu osób wyłączenie JS to krok praktyczny - ochrona prywatności i bezpieczeństwa, nie ideologia.',
        'caption1'         => 'Małe, użyteczne interakcje JS',
        'caption2'         => 'Podejście pro-prywatność',
        'caption3'         => 'Lekkie strony działają na starych urządzeniach',
        'caption4'         => 'Dostępność i progresywne ulepszanie',
        'h2_culinary'      => 'Wydajność ma znaczenie',
        'culinary_p1'      => 'Wydajność też się liczy. Na starszym sprzęcie lub telefonach z ograniczoną baterią ciężki JavaScript spowalnia wszystko. Strona, która powinna ładować się sekundę, potrafi się dłużyć, gdy główny wątek jest zawalony skryptami. Dla osób ze słabym łączem czy tanim sprzętem JS równa się frustracja.',
        'culinary_p2'      => 'Dlatego unikanie JS bywa praktyczne, nie ideologiczne.',
        'h2_trek'          => 'Element kulturowy',
        'trek_p1'          => 'Jest też element kulturowy: niektóre społeczności cenią minimalizm i kontrolę. Wyłączenie JavaScriptu to deklaracja - „wolę tekst, szybkość i kontrolę zamiast błyskotek.” To uzasadniona preferencja pokazująca, jak ktoś chce korzystać z webu.',
        'trek_p2'          => 'Jednak gdy preferencja przeradza się w lęk, tracimy niuanse - i wiele przydatnych funkcji internetu.',
        'quote2'           => 'JavaScript to też fundament nowoczesnego UX - przy mądrym użyciu ułatwia dostępność i interaktywność.',
        'h2_reflection'    => 'Jak zmniejszyć dystans?',
        'reflection_p1'    => 'Projektować z empatią. Zapewnić funkcjonalny, dostępny podstawowy poziom dla osób bez skryptów, a funkcje dopinać zamiast zastępować. Być przejrzystym w kwestii danych i trzymać skrypty lekkimi oraz ładować je leniwie, żeby użytkownik nie płacił kosztu za funkcję, której nie potrzebuje.',
        'reflection_p2'    => 'W praktyce strach przed JS często kryje rozsądne pragnienia: kontrolę, prywatność i użyteczność. Gdyby deweloperzy tworzyliby lżejsze i bardziej przejrzyste doświadczenia, ten lęk by malał.',
        'tags'             => ['JavaScript', 'Web', 'Prywatność', 'Wydajność', 'UX'],
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

            <h2><?= htmlspecialchars($t['h2_step1'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['step1_p1'], ENT_QUOTES) ?></p>
            <p><?= htmlspecialchars($t['step1_p2'], ENT_QUOTES) ?></p>

            <div class="divider"></div>

            <h2><?= htmlspecialchars($t['h2_culture'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['culture_p1'], ENT_QUOTES) ?></p>
            <div class="highlight">
                <p><?= htmlspecialchars($t['quote1'], ENT_QUOTES) ?></p>
            </div>
            <p><?= htmlspecialchars($t['culture_p2'], ENT_QUOTES) ?></p>

            <div class="divider"></div>

            <h2><?= htmlspecialchars($t['h2_culinary'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['culinary_p1'], ENT_QUOTES) ?></p>
            <p><?= htmlspecialchars($t['culinary_p2'], ENT_QUOTES) ?></p>

            <div class="divider"></div>

            <h2><?= htmlspecialchars($t['h2_trek'], ENT_QUOTES) ?></h2>
            <p><?= htmlspecialchars($t['trek_p1'], ENT_QUOTES) ?></p>
            <p><?= htmlspecialchars($t['trek_p2'], ENT_QUOTES) ?></p>
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