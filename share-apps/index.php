<?php
require_once 'translations.php';
$lang = 'en';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pl','en'])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time()+30*24*3600, '/');
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], ['pl','en'])) {
    $lang = $_COOKIE['lang'];
}
function tt($k) { global $lang; return t($k,$lang); }
$dataFile = __DIR__ . '/apps.json';
$apps = [];
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $apps = json_decode($json, true) ?: [];
}
$platforms = t('platforms', $lang);
?>
<!doctype html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo htmlspecialchars(tt('site_title')); ?></title>
<meta name="description" content="<?= htmlspecialchars($t['meta'] ?? '', ENT_QUOTES) ?>" />
<link rel="icon" type="image/png" href="photos/website-icon.png" />
<link rel="stylesheet" href="style.css">
</head>
<body data-lang="<?php echo htmlspecialchars($lang); ?>">
<header class="site-header">
  <div class="brand">
    <h1><?php echo htmlspecialchars(tt('site_title')); ?></h1>
    <p class="tag"><?php echo htmlspecialchars(tt('add_app')); ?></p>
  </div>
  <nav class="header-actions">
    <a class="lang" href="?lang=pl"><?php echo htmlspecialchars(t('switch_pl', $lang)); ?></a>
    <a class="lang" href="?lang=en"><?php echo htmlspecialchars(t('switch_en', $lang)); ?></a>
  </nav>
</header>

<main class="container">
  <aside class="panel add-panel">
    <h2><?php echo htmlspecialchars(tt('add_app')); ?></h2>

    <?php if (isset($_GET['ok'])): ?>
      <div class="notice success"><?php echo htmlspecialchars(tt('success_added')); ?></div>
    <?php endif; ?>

    <form id="appForm" action="save.php" method="post" enctype="multipart/form-data" novalidate>
      <input type="hidden" name="lang" value="<?php echo htmlspecialchars($lang); ?>">
      <label class="field">
        <span class="label"><?php echo htmlspecialchars(tt('name')); ?> <span class="req">*</span></span>
        <input type="text" name="name" required>
      </label>

      <label class="field">
        <span class="label"><?php echo htmlspecialchars(tt('type')); ?> <span class="req">*</span></span>
        <select name="type" required>
          <option value=""><?php echo htmlspecialchars(tt('type_placeholder')); ?></option>
          <?php foreach (t('types', $lang) as $type): ?>
            <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
          <?php endforeach; ?>
        </select>
      </label>

      <label class="field">
        <span class="label"><?php echo htmlspecialchars(tt('platform')); ?></span>
        <select name="platform">
          <option value=""><?php echo htmlspecialchars(tt('platform_placeholder')); ?></option>
          <option value="all"><?php echo htmlspecialchars(tt('all_platforms')); ?></option>
          <?php foreach ($platforms as $plat): ?>
            <option value="<?php echo htmlspecialchars($plat); ?>"><?php echo htmlspecialchars($plat); ?></option>
          <?php endforeach; ?>
        </select>
      </label>

      <label class="field">
        <span class="label"><?php echo htmlspecialchars(tt('description')); ?></span>
        <textarea name="description" rows="4" placeholder="<?php echo htmlspecialchars(tt('description')); ?>"></textarea>
      </label>

      <label class="field">
        <span class="label"><?php echo htmlspecialchars(tt('images')); ?></span>
        <input type="file" name="images[]" accept="image/*" multiple>
      </label>

      <label class="field">
        <span class="label"><?php echo htmlspecialchars(tt('link')); ?></span>
        <input type="url" name="link" placeholder="https://example.com">
      </label>

      <div class="field">
        <button class="btn" type="submit"><?php echo htmlspecialchars(tt('submit')); ?></button>
      </div>
    </form>
  </aside>

  <section class="panel list-panel">
    <div class="list-toolbar">
      <div class="filter">
        <label class="label"><?php echo htmlspecialchars(tt('filter_platform')); ?></label>
        <select id="platformFilter">
          <option value="all"><?php echo htmlspecialchars(tt('all_platforms')); ?></option>
          <option value="none"><?php echo htmlspecialchars(tt('none_platform')); ?></option>
          <?php foreach ($platforms as $plat): ?>
            <option value="<?php echo htmlspecialchars($plat); ?>"><?php echo htmlspecialchars($plat); ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="sort">
        <label class="label"><?php echo htmlspecialchars(tt('sort_by')); ?></label>
        <select id="sortSelect">
          <option value="newest"><?php echo htmlspecialchars(tt('sort_newest')); ?></option>
          <option value="oldest"><?php echo htmlspecialchars(tt('sort_oldest')); ?></option>
          <option value="platform"><?php echo htmlspecialchars(tt('sort_platform')); ?></option>
          <option value="no_platform"><?php echo htmlspecialchars(tt('sort_no_platform')); ?></option>
        </select>
      </div>
    </div>

    <div class="list-header">
      <h2><?php echo htmlspecialchars(tt('app_list')); ?></h2>
    </div>

    <?php if (empty($apps)): ?>
      <p class="muted"><?php echo htmlspecialchars(tt('no_apps')); ?></p>
    <?php else: ?>
      <div class="apps-grid" id="appsGrid">
        <?php foreach (array_reverse($apps) as $app): ?>
          <?php
            $platRaw = $app['platform'] ?? '';
            $platDisplay = $platRaw === 'all' ? tt('all_platforms') : ($platRaw ?? '');
          ?>
          <article class="app-card" data-platform="<?php echo htmlspecialchars($platRaw); ?>" data-ts="<?php echo htmlspecialchars($app['created_at']); ?>">
            <div class="card-top">
              <div class="card-info">
                <h3><?php echo htmlspecialchars($app['name']); ?></h3>
                <?php
                  $meta = $app['type'] ?? '';
                  if (!empty($platRaw)) $meta .= ' · ' . $platDisplay;
                ?>
                <div class="meta"><span class="plat" data-plat="<?php echo htmlspecialchars($platRaw); ?>" data-plat-display="<?php echo htmlspecialchars($platDisplay); ?>"></span> <?php echo htmlspecialchars($meta); ?></div>
              </div>
              <?php if (!empty($app['images']) && is_array($app['images'])): ?>
                <div class="card-thumb">
                  <?php $first = $app['images'][0] ?? null; ?>
                  <?php if ($first): $path = 'uploads/' . basename($first); ?>
                    <?php if (file_exists(__DIR__ . '/' . $path)): ?>
                      <img src="<?php echo htmlspecialchars($path); ?>" alt="">
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>

            <?php if (!empty($app['description'])): ?>
              <p class="desc"><?php echo nl2br(htmlspecialchars($app['description'])); ?></p>
            <?php endif; ?>

            <?php if (!empty($app['link'])): ?>
              <a class="app-link" href="<?php echo htmlspecialchars($app['link']); ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($app['link']); ?></a>
            <?php endif; ?>

            <div class="card-footer">
              <time class="time" datetime="<?php echo htmlspecialchars($app['created_at']); ?>"><?php echo htmlspecialchars($app['created_at']); ?></time>
              <span class="relative" data-ts="<?php echo htmlspecialchars($app['created_at']); ?>"></span>
            </div>

            <?php if (!empty($app['images']) && is_array($app['images'])): ?>
              <div class="thumbs">
                <?php foreach ($app['images'] as $img): ?>
                  <?php $path = 'uploads/' . basename($img); ?>
                  <?php if (file_exists(__DIR__ . '/' . $path)): ?>
                    <a href="<?php echo htmlspecialchars($path); ?>" target="_blank"><img src="<?php echo htmlspecialchars($path); ?>" alt=""></a>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>
</main>

<script src="script.js"></script>
</body>
</html>
