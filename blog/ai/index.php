<?php
$lang_code   = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'        => 'en',
        'title'            => 'Blog - The Future of AI in Programming',
        'meta_description' => 'How AI is changing programming — from autocomplete to co-developers and hybrid human-AI teams.',
        'page_title'       => 'The Future of AI in Programming – Revolution or Evolution?',
        'subtitle'         => 'How AI is changing programming — from autocomplete to co-developers and hybrid teams',
        'author_name'      => 'Kotokk',
        'author_date'      => 'May 13, 2025',
        'intro_p'          => 'Just a few years ago, artificial intelligence in programming was mostly associated with research projects, prototypes, and sci-fi movies. Today, it has become a daily tool for developers, and tomorrow… it might transform the entire way we create software.',
        'h2_step1'         => 'From Autocomplete to Co-Developer',
        'step1_p1'         => 'Modern AI tools like GitHub Copilot, ChatGPT, and Tabnine can do far more than suggest lines of code. They can design whole modules, spot bugs, and propose optimizations. Developers are increasingly acting like conductors — instead of writing every line, they set direction and AI handles large parts of the execution.',
        'step1_p2'         => 'This shift changes workflows: review, testing, and prompt design become as important as typing syntax. The job of the developer moves up the stack toward architecture, integration and product decisions.',
        'h2_culture'       => 'Code Written in “Human Language”',
        'culture_p1'       => 'One of the most exciting trends is natural language programming. Soon you might say: "Create a web app that allows restaurant table bookings and sends SMS notifications", and AI will generate a working project in your chosen framework.',
        'quote1'           => 'Knowing syntax will matter less; analytical and creative thinking will matter more.',
        'culture_p2'       => 'In that world, communication — how you describe requirements to a model — becomes a core skill. This also opens programming to people with diverse backgrounds.',
        'caption1'         => 'AI-assisted coding in action',
        'caption2'         => 'Pair programming with an AI co-developer',
        'caption3'         => 'From prompt to production',
        'caption4'         => 'Designing architecture, not typing every line',
        'h2_culinary'      => 'New Roles for Developers',
        'culinary_p1'      => 'With AI’s rise, new specialties will appear—such as AI prompt engineers, who craft precise prompts to get reliable results. Verification, security, and model oversight become critical skills.',
        'culinary_p2'      => 'At the same time, developers will spend less time on repetitive boilerplate and more on defining constraints, ensuring correctness, and handling integrations.',
        'h2_trek'          => 'Will AI Replace Programmers?',
        'trek_p1'          => 'This question returns often. The most likely answer is: no. AI will automate repetitive tasks but won’t replace human creativity, system thinking, and judgement.',
        'trek_p2'          => 'People will focus on higher-level problems: architecture, ethics, product decisions, and complex debugging where domain knowledge matters.',
        'quote2'           => 'Like calculators did not end mathematics, AI will not end programming — it will change what we value in it.',
        'h2_reflection'    => 'The Future Is Hybrid',
        'reflection_p1'    => 'The best outcomes will come from human–AI teams. AI excels at speed and pattern completion; humans excel at goals, values, and novel ideas.',
        'reflection_p2'    => 'Programming will become more accessible, and the craft will shift toward design, oversight and creativity. Embracing AI responsibly can raise the field to a new level.',
        'tags'             => ['AI', 'Programming', 'Future', 'Tech', 'Developer'],
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
        'title'            => 'Blog - Przyszłość AI w programowaniu',
        'meta_description' => 'Jak AI zmienia programowanie — od autouzupełniania do współprogramistów i hybrydowych zespołów.',
        'page_title'       => 'Przyszłość AI w programowaniu – rewolucja czy ewolucja?',
        'subtitle'         => 'Jak AI zmienia programowanie — od autouzupełniania do współprogramistów',
        'author_name'      => 'Kotokk',
        'author_date'      => '13 maja 2025',
        'intro_p'          => 'Jeszcze kilka lat temu sztuczna inteligencja w programowaniu kojarzyła się głównie z projektami badawczymi, prototypami i filmami science fiction. Dziś jest codziennym narzędziem deweloperów, a jutro… może zmienić całe tworzenie oprogramowania.',
        'h2_step1'         => 'Od autouzupełniania do współprogramisty',
        'step1_p1'         => 'Współczesne narzędzia AI, takie jak GitHub Copilot, ChatGPT czy Tabnine, potrafią znacznie więcej niż podpowiadać linie kodu. Mogą projektować całe moduły, wykrywać błędy i proponować optymalizacje. Programiści coraz częściej przypominają dyrygentów — zamiast pisać każdą linię, wyznaczają kierunek, a AI wykonuje dużą część pracy.',
        'step1_p2'         => 'Ta zmiana wpływa na sposób pracy: przegląd kodu, testowanie i projektowanie promptów stają się równie ważne jak znajomość składni. Rola programisty przesuwa się w górę stosu — w stronę architektury, integracji i decyzji produktowych.',
        'h2_culture'       => 'Kod pisany „ludzkim językiem”',
        'culture_p1'       => 'Jednym z najbardziej ekscytujących trendów jest programowanie w języku naturalnym. W przyszłości wystarczy powiedzieć: „Stwórz aplikację webową do rezerwacji stolików w restauracjach i wysyłania powiadomień SMS”, a AI wygeneruje działający projekt w wybranym frameworku.',
        'quote1'           => 'Znajomość składni będzie mniej istotna; ważniejsze będą myślenie analityczne i kreatywne.',
        'culture_p2'       => 'W takim świecie komunikacja — sposób opisywania wymagań modelowi — stanie się kluczową umiejętnością. Otworzy to też programowanie na ludzi z różnym doświadczeniem.',
        'caption1'         => 'Programowanie wspomagane przez AI',
        'caption2'         => 'Programowanie w parze z AI',
        'caption3'         => 'Od promptu do produkcji',
        'caption4'         => 'Projektowanie architektury, nie pisanie każdej linii',
        'h2_culinary'      => 'Nowe role programistów',
        'culinary_p1'      => 'Wraz z rozwojem AI pojawią się nowe specjalizacje — np. inżynier promptów, ekspert potrafiący precyzyjnie formułować zapytania do modeli. Weryfikacja, bezpieczeństwo i nadzór nad modelami staną się kluczowymi kompetencjami.',
        'culinary_p2'      => 'Jednocześnie programiści będą spędzać mniej czasu na powtarzalnym boilerplate, a więcej na definiowaniu ograniczeń, zapewnianiu poprawności i integracjach.',
        'h2_trek'          => 'Czy AI zastąpi programistów?',
        'trek_p1'          => 'To częste pytanie. Najpewniejsza odpowiedź brzmi: nie. AI zautomatyzuje powtarzalne zadania, ale nie zastąpi ludzkiej kreatywności, myślenia systemowego i osądu.',
        'trek_p2'          => 'Ludzie skupią się na problemach wyższego poziomu: architekturze, etyce, decyzjach produktowych i złożonym debugowaniu, gdzie wiedza dziedzinowa ma znaczenie.',
        'quote2'           => 'Tak jak kalkulatory nie zabiły matematyki, tak AI nie zabije programowania — zmieni to, co w nim cenimy.',
        'h2_reflection'    => 'Przyszłość jest hybrydowa',
        'reflection_p1'    => 'Najlepsze efekty osiągną zespoły ludzi i AI. AI świetnie radzi sobie z szybkością i uzupełnianiem wzorców; ludzie najlepiej nadają cele, wartości i nowe pomysły.',
        'reflection_p2'    => 'Programowanie stanie się bardziej dostępne, a rzemiosło przesunie się w stronę projektowania, nadzoru i kreatywności. Odpowiedzialne wykorzystanie AI może podnieść dziedzinę na nowy poziom.',
        'tags'             => ['AI', 'Programowanie', 'Przyszłość', 'Technologie', 'Developer'],
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