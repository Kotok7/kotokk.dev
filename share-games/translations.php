<?php
$available_langs = ['pl','en'];
$lang = 'en';
if (isset($_GET['lang']) && in_array($_GET['lang'], $available_langs)) {
    setcookie('lang', $_GET['lang'], time()+31536000, '/');
    $_COOKIE['lang'] = $_GET['lang'];
}
if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $available_langs)) {
    $lang = $_COOKIE['lang'];
}
$translations = [
    'pl' => [
        'site_title'=>'Udostępniaj i odkrywaj gry',
        'meta'=>'Udostępniaj swoje ulubione gry i odkrywaj nowe!',
        'add_game'=>'Dodaj grę',
        'name'=>'Nazwa gry',
        'platform_label'=>'Platforma (np. Steam, Epic, PS5)',
        'description'=>'Opis (opcjonalny)',
        'screenshots'=>'Screenshoty (max 5, max 2MB każdy)',
        'add_button'=>'Dodaj grę',
        'list_title'=>'Lista gier',
        'no_posts'=>'Brak gier — bądź pierwszy!',
        'platform_text'=>'Platforma',
        'added_text'=>'Dodano',
        'like_text'=>'Lubię',
        'dislike_text'=>'Nie lubię',
        'error_missing_title'=>'Brak nazwy gry',
        'error_generic'=>'Wystąpił błąd',
        'lang_pl'=>'PL',
        'lang_en'=>'EN',
        'upload_hint'=>'Do 5 obrazów, każdy max 2MB. Możesz też kliknąć podgląd aby powiększyć.',
        'loading_posts'=>'Ładowanie gier...'
    ],
    'en' => [
        'site_title'=>'Share and discover games',
        'meta'=>'Share your favourite games and discover new ones!',
        'add_game'=>'Add a game',
        'name'=>'Game title',
        'platform_label'=>'Platform (eg. Steam, Epic, PS5)',
        'description'=>'Description (optional)',
        'screenshots'=>'Screenshots (max 5, max 2MB each)',
        'add_button'=>'Add game',
        'list_title'=>'Game list',
        'no_posts'=>'No games yet — be the first!',
        'platform_text'=>'Platform',
        'added_text'=>'Added',
        'like_text'=>'Like',
        'dislike_text'=>'Dislike',
        'error_missing_title'=>'Missing game title',
        'error_generic'=>'An error occurred',
        'lang_pl'=>'PL',
        'lang_en'=>'EN',
        'upload_hint'=>'Up to 5 images, each max 2MB. Click preview to enlarge.',
        'loading_posts'=>'Loading games...'
    ]
];
function t($key) {
    global $translations, $lang;
    if (isset($translations[$lang][$key])) return $translations[$lang][$key];
    if (isset($translations['en'][$key])) return $translations['en'][$key];
    return $key;
}
$current_lang = $lang;
