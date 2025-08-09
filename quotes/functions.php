<?php
session_start();

function data_file(): string {
    $dir = __DIR__ . '/data';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    return $dir . '/quotes.json';
}

function load_quotes(): array {
    $file = data_file();
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    $json = file_get_contents($file);
    $arr = json_decode($json, true);
    return is_array($arr) ? $arr : [];
}

function save_quotes(array $quotes): void {
    $file = data_file();
    $fh = fopen($file, 'c+');
    if ($fh === false) return;
    flock($fh, LOCK_EX);
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, json_encode($quotes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
}

function add_quote($nick, array $tags, $content, string $lang = 'en'): int {
    $quotes = load_quotes();
    $ids = array_map(fn($q)=>$q['id'] ?? 0, $quotes);
    $nextId = $ids ? max($ids) + 1 : 1;
    $cleanTags = array_values(array_filter(array_map('trim', $tags), fn($t)=>$t !== ''));
    if (!is_array($nick)) $storedNick = [$lang => trim((string)$nick)];
    else { $storedNick = $nick; foreach ($storedNick as $k=>$v) $storedNick[$k] = trim((string)$v); }
    if (!is_array($content)) $storedContent = [$lang => trim((string)$content)];
    else { $storedContent = $content; foreach ($storedContent as $k=>$v) $storedContent[$k] = trim((string)$v); }
    $quote = [
        'id' => $nextId,
        'nick' => $storedNick,
        'tags' => $cleanTags,
        'content' => $storedContent,
        'created_at' => date('c')
    ];
    array_unshift($quotes, $quote);
    save_quotes($quotes);
    return $nextId;
}

function toggle_favorite(int $id): void {
    if (!isset($_SESSION['favorites'])) $_SESSION['favorites'] = [];
    if (in_array($id, $_SESSION['favorites'], true)) {
        $_SESSION['favorites'] = array_values(array_diff($_SESSION['favorites'], [$id]));
    } else {
        $_SESSION['favorites'][] = $id;
    }
}

function get_favorites(): array {
    return $_SESSION['favorites'] ?? [];
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf(?string $token): bool {
    return !empty($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

function get_translated($value, string $lang): string {
    if (is_array($value)) {
        if (!empty($value[$lang])) return $value[$lang];
        if (!empty($value['en'])) return $value['en'];
        foreach ($value as $v) if ($v !== '') return $v;
        return '';
    }
    return (string)$value;
}

function format_datetime_for_tz(?string $iso, string $tz, string $fmt = 'Y-m-d H:i'): string {
    if (empty($iso)) return '';
    if (!in_array($tz, timezone_identifiers_list(), true)) $tz = 'UTC';
    try {
        $dt = new DateTime($iso);
        $dt->setTimezone(new DateTimeZone($tz));
        return $dt->format($fmt);
    } catch (Exception $e) {
        return $iso;
    }
}

$TRANSLATIONS = [
    'title' => ['en'=>'Kotokk - Discover and add quotes','pl'=>'Kotokk - Odkrywaj i dodawaj cytaty'],
    'back-to-top' => ['en'=>'Back to main page','pl'=>'Wróć do strony głównej'],
    'meta_description' => ['en'=>'Add, discover, view and save quotes!','pl'=>'Dodawaj, odkrywaj, przeglądaj i zapisuj cytaty!'],
    'header_h1' => ['en'=>'Discover Quotes','pl'=>'Odkrywaj cytaty'],
    'nav_add' => ['en'=>'Add Quote','pl'=>'Dodaj cytat'],
    'nav_favs' => ['en'=>'My Favorites','pl'=>'Moje ulubione'],
    'search_placeholder' => ['en'=>'Search quotes, nicks or tags','pl'=>'Szukaj cytatów, nicków lub tagów'],
    'search_btn' => ['en'=>'Search','pl'=>'Szukaj'],
    'clear_tag_filter' => ['en'=>'Clear tag filter','pl'=>'Wyczyść filtr tagu'],
    'no_quotes' => ['en'=>'No quotes found.','pl'=>'Nie znaleziono cytatów.'],
    'save' => ['en'=>'Save','pl'=>'Zapisz'],
    'unsave' => ['en'=>'Unsave','pl'=>'Usuń z zapisanych'],
    'lang_switch' => ['en'=>'PL','pl'=>'EN'],
    'favorites_title' => ['en'=>'My Favorite Quotes','pl'=>'Moje ulubione cytaty'],
    'favorites_none' => ['en'=>"You haven't saved any quotes yet.",'pl'=>'Nie zapisałeś jeszcze żadnych cytatów.'],
    'add_title' => ['en'=>'Add Quote','pl'=>'Dodaj cytat'],
    'add_h1' => ['en'=>'Add a New Quote','pl'=>'Dodaj nowy cytat'],
    'invalid_csrf' => ['en'=>'Invalid CSRF token.','pl'=>'Nieprawidłowy token CSRF.'],
    'required_fields' => ['en'=>'Nick and Content are required.','pl'=>'Nick i treść są wymagane.'],
    'tags_placeholder' => ['en'=>'e.g. life,inspiration','pl'=>'np. zycie,inspiracja'],
    'nick_label' => ['en'=>'Nick','pl'=>'Nick'],
    'tags_label' => ['en'=>'Tags (comma-separated)','pl'=>'Tagi (oddzielone przecinkami)'],
    'content_label' => ['en'=>'Content','pl'=>'Treść'],
    'add_button' => ['en'=>'Add Quote','pl'=>'Dodaj cytat'],
    'cancel' => ['en'=>'Cancel','pl'=>'Anuluj'],
];

function t(string $key, string $lang): string {
    global $TRANSLATIONS;
    if (isset($TRANSLATIONS[$key][$lang])) return $TRANSLATIONS[$key][$lang];
    return $key;
}
