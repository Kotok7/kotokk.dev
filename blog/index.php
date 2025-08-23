<?php
$lang_code   = $_GET['lang'] ?? 'en';

$translations = [
    'en' => [
        'html_lang'        => 'en',
        'title'            => 'Kotokk - Blog',
        'meta_description' => 'My personal blog where I share topics and insights that interest me.',
        'translate'        => 'Switch to Polish',
        'logo'             => 'My blog',
        'under_logo'       => 'My personal blog where I share topics and insights that interest me.',
        'read'             => 'Read',
        'back_button'      => 'Back to main page',
        'tag1'             => 'Operating systems',
        'post_title1'      => 'Why do I use windows?',
        'post_desc1'       => 'Why I stick with Windows despite its flaws, especially on a ThinkPad',
        'date1'            => 'May 13',
        'read_time1'       => '4 min read',
        'tag2'             => 'Artificial intelligence',
        'post_title2'      => 'The Future of AI in programming',
        'post_desc2'       => 'How AI tools are transforming software development, from smart code completion to automated testing, and what it means for developers.',
        'date2'            => '9 August',
        'read_time2'       => '3 min read',
        'tag3'             => 'JavaScript',
        'post_title3'      => 'Why do people fear JavaScript?',
        'post_desc3'       => 'A short, human take on why some people avoid or disable JavaScript on websites.',
        'date3'            => '28 August',
        'read_time3'       => '3 min read',
    ],
    'pl' => [
        'html_lang'        => 'pl',
        'title'            => 'Kotokk - Blog',
        'meta_description' => 'Mój blog, gdzie dzielę się tematami i przemyśleniami, które mnie interesują.',
        'translate'        => 'Przełącz na angielski',
        'logo'             => 'Mój blog',
        'under_logo'       => 'Mój blog, gdzie dzielę się tematami i przemyśleniami, które mnie interesują.',
        'read'             => 'Przeczytaj',
        'back_button'      => 'Wróć do strony głównej',
        'tag1'             => 'Systemy operacyjne',
        'post_title1'      => 'Dlaczego używam Windowsa?',
        'post_desc1'       => 'Dlaczego zostaję przy Windowsie mimo wad, zwłaszcza na ThinkPadzie',
        'date1'            => '13 Maja',
        'read_time1'       => '4 min czytania',
        'tag2'             => 'Sztuczna inteligencja',
        'post_title2'      => 'Przyszłość sztucznej inteligencji w programowaniu',
        'post_desc2'       => 'Jak narzędzia AI transformują tworzenie oprogramowania, od inteligentnego uzupełniania kodu po automatyczne testowanie, i co to oznacza dla programistów.',
        'date2'            => '9 Sierpnia',
        'read_time2'       => '3 minuty czytania',
        'tag3'             => 'JavaScript',
        'post_title3'      => 'Dlaczego ludzie boją się JavaScriptu',
        'post_desc3'       => 'Krótki, ludzki tekst o tym, dlaczego niektórzy unikają albo wyłączają JavaScript na stronach.',
        'date3'            => '23 Sierpnia',
        'read_time3'       => '3 minuty czytania',
    ],
];

if (!isset($translations[$lang_code])) {
    $lang_code = 'en';
}
$t = $translations[$lang_code];

$storedNick = $_COOKIE['blog_nick'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['title'], ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_description'], ENT_QUOTES) ?>" />
    <link rel="icon" type="image/png" href="website-icon.png" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <header>
            <br>
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
            <h1 class="logo"><?= htmlspecialchars($t['logo'], ENT_QUOTES) ?></h1>
            <p class="tagline"><?= htmlspecialchars($t['under_logo'], ENT_QUOTES) ?></p>
        </header>

        <main class="posts-section">
            <div class="posts-grid">
<article class="post-card" onclick="selectPost('windows')">
    <span class="post-category"><?= htmlspecialchars($t['tag1'], ENT_QUOTES) ?></span>
    <h2 class="post-title"><?= htmlspecialchars($t['post_title1'], ENT_QUOTES) ?></h2>
    <p class="post-excerpt"><?= htmlspecialchars($t['post_desc1'], ENT_QUOTES) ?></p>
    <div class="post-meta">
        <span class="post-date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
            </svg>
            <?= htmlspecialchars($t['date1'], ENT_QUOTES) ?>
        </span>
        <span class="read-time">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <?= htmlspecialchars($t['read_time1'], ENT_QUOTES) ?>
        </span>
    </div>
    <a href="windows/index.php" class="read-button" onclick="event.stopPropagation(); selectPost('windows')">
        <?= htmlspecialchars($t['read'], ENT_QUOTES) ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
        </svg>
    </a>
</article>

<article class="post-card" onclick="selectPost('ai-future')">
    <span class="post-category"><?= htmlspecialchars($t['tag2'], ENT_QUOTES) ?></span>
    <h2 class="post-title"><?= htmlspecialchars($t['post_title2'], ENT_QUOTES) ?></h2>
    <p class="post-excerpt"><?= htmlspecialchars($t['post_desc2'], ENT_QUOTES) ?></p>
    <div class="post-meta">
        <span class="post-date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
            </svg>
            <?= htmlspecialchars($t['date2'], ENT_QUOTES) ?>
        </span>
        <span class="read-time">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <?= htmlspecialchars($t['read_time2'], ENT_QUOTES) ?>
        </span>
    </div>
    <a href="ai/index.php" class="read-button" onclick="event.stopPropagation(); selectPost('ai-future')">
        <?= htmlspecialchars($t['read'], ENT_QUOTES) ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
        </svg>
    </a>
</article>

<article class="post-card" onclick="selectPost('javascript')">
    <span class="post-category"><?= htmlspecialchars($t['tag3'], ENT_QUOTES) ?></span>
    <h2 class="post-title"><?= htmlspecialchars($t['post_title3'], ENT_QUOTES) ?></h2>
    <p class="post-excerpt"><?= htmlspecialchars($t['post_desc3'], ENT_QUOTES) ?></p>
    <div class="post-meta">
        <span class="post-date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
            </svg>
            <?= htmlspecialchars($t['date3'], ENT_QUOTES) ?>
        </span>
        <span class="read-time">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <?= htmlspecialchars($t['read_time3'], ENT_QUOTES) ?>
        </span>
    </div>
    <a href="javascript/index.php" class="read-button" onclick="event.stopPropagation(); selectPost('javascript')">
        <?= htmlspecialchars($t['read'], ENT_QUOTES) ?>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
        </svg>
    </a>
</article>

            </div>
        </main>
    </div>
        <script src="script.js"></script>
</body>
</html>
