<?php
require_once __DIR__ . '/translations.php';
if (!isset($_COOKIE['user_id'])) {
    try {
        $uid = bin2hex(random_bytes(16));
    } catch (Exception $e) {
        $uid = uniqid('u', true);
    }
    setcookie('user_id', $uid, time() + 365*24*3600, '/');
    $_COOKIE['user_id'] = $uid;
}
$user_id = $_COOKIE['user_id'];
?>
<!doctype html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo htmlspecialchars(t('site_title')); ?></title>
<meta name="description" content="<?php echo htmlspecialchars(t('meta')); ?>" />
<link rel="icon" type="image/png" href="photos/website-icon.png" />
<link rel="stylesheet" href="styles.css">
</head>
<body>
<header role="banner">
  <div class="header-inner">
    <h1><?php echo htmlspecialchars(t('site_title')); ?></h1>
    <nav class="lang-switch" aria-label="Language switch">
      <a href="?lang=pl" class="<?php echo $current_lang === 'pl' ? 'active' : ''; ?>"><?php echo htmlspecialchars(t('lang_pl')); ?></a>
      <a href="?lang=en" class="<?php echo $current_lang === 'en' ? 'active' : ''; ?>"><?php echo htmlspecialchars(t('lang_en')); ?></a>
    </nav>
  </div>
</header>
<main>
  <section id="add" aria-labelledby="add-heading">
                <button onclick="window.location.href='/index.php'" class="back-button">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m12 19-7-7 7-7"/>
    <path d="M19 12H5"/>
  </svg>
<?php echo htmlspecialchars(t('back-to-main')); ?>
</button>
    <h2 id="add-heading"><?php echo htmlspecialchars(t('add_game')); ?></h2>
    <form id="addForm" action="add_post.php" method="post" enctype="multipart/form-data" novalidate>
      <div class="form-row">
        <label for="title"><?php echo htmlspecialchars(t('name')); ?></label>
        <input id="title" name="title" type="text" required maxlength="200" autocomplete="off" />
      </div>
      <div class="form-row">
        <label for="platform"><?php echo htmlspecialchars(t('platform_label')); ?></label>
        <input id="platform" name="platform" type="text" maxlength="100" placeholder="<?php echo htmlspecialchars(t('platform_placeholder')); ?>" autocomplete="off" />
      </div>
      <div class="form-row">
        <label for="tags"><?php echo htmlspecialchars(t('tags_label')); ?></label>
        <input id="tags" name="tags" type="text" maxlength="200" placeholder="<?php echo htmlspecialchars(t('tags_placeholder')); ?>" autocomplete="off" />
        <div class="hint"><?php echo htmlspecialchars(t('tags_hint')); ?></div>
      </div>
      <div class="form-row">
        <label for="description"><?php echo htmlspecialchars(t('description')); ?></label>
        <textarea id="description" name="description" rows="4" maxlength="800"></textarea>
      </div>
      <div class="form-row">
        <label for="screenshots"><?php echo htmlspecialchars(t('screenshots')); ?></label>
        <input id="screenshots" name="screenshots[]" type="file" accept="image/*" multiple />
        <div id="preview" class="preview"></div>
        <div class="hint"><?php echo htmlspecialchars(t('upload_hint')); ?></div>
      </div>
      <div class="form-row">
        <button type="submit" id="submitBtn"><?php echo htmlspecialchars(t('add_button')); ?></button>
      </div>
    </form>
  </section>

  <section id="list" aria-labelledby="list-heading">
    <h2 id="list-heading"><?php echo htmlspecialchars(t('list_title')); ?></h2>

    <div class="sort-controls" style="margin-bottom:1rem;">
      <label for="sortSelect" class="sort-label"><?php echo htmlspecialchars(t('sort_label')); ?>:</label>
      <select id="sortSelect" aria-label="Sort posts">
        <option value="newest"><?php echo htmlspecialchars(t('sort_newest')); ?></option>
        <option value="likes"><?php echo htmlspecialchars(t('sort_likes')); ?></option>
      </select>
    </div>

    <div id="postsContainer" class="posts-container" role="list">
      <div class="placeholder"><?php echo htmlspecialchars(t('loading_posts')); ?></div>
    </div>
  </section>
</main>

<div id="lightbox" class="lightbox" aria-hidden="true"></div>

<script>
const USER_ID = "<?php echo addslashes($user_id); ?>";
const LANG = "<?php echo addslashes($current_lang); ?>";
const JS_T = <?php echo json_encode([
    'error_generic' => t('error_generic'),
    'error_missing_title' => t('error_missing_title'),
    'like_text' => t('like_text'),
    'dislike_text' => t('dislike_text'),
    'just_now' => ($current_lang === 'pl') ? 'przed chwilą' : 'just now',
    'max_uploads' => 5,
    'max_size_bytes' => 2 * 1024 * 1024,
    'upload_hint' => t('upload_hint'),
    'tags_placeholder' => t('tags_placeholder'),
    'tags_label' => t('tags_label'),
    'sort_label' => t('sort_label'),
    'sort_newest' => t('sort_newest'),
    'sort_likes' => t('sort_likes'),
], JSON_UNESCAPED_UNICODE); ?>;
</script>
<script src="script.js"></script>
</body>
</html>
