<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Kotokk - Collaborative Story</title>
  <link rel="stylesheet" href="style.css" />
  <meta name="description" content="Collaborative story. Everyone adds one sentence and has a one-hour cooldown." />
  <link rel="icon" type="image/png" href="photos/website-icon.png" />
</head>
<body>
  <main class="container">
    <header class="hero">
                  <button onclick="window.location.href='/index.php'" class="back-button">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m12 19-7-7 7-7"/>
    <path d="M19 12H5"/>
  </svg>
  Back to Main Page
</button>
      <a href="index-pl.php" class="icon-link">
        <img src="/photos/poland.png" alt="Przetłumacz na Polski" title="Przetłumacz na Polski" loading="lazy">
      </a>
      <h1>Collaborative Story</h1>
      <p class="subtitle">Add a single sentence — the story is saved to JSON and visible to everyone.</p>
    </header>

    <section class="panel">
      <h2>Story</h2>
      <div id="story-list" class="story-list">Loading...</div>
      <div class="actions">
        <button id="refresh" class="btn">Refresh</button>
      </div>
    </section>

    <section class="panel">
      <h2>Add one sentence</h2>
      <form id="sentence-form" class="form">
        <textarea id="sentence" name="sentence" placeholder="Write exactly one sentence..." maxlength="500" required></textarea>
        <div class="row">
          <button type="submit" id="submit-btn" class="btn primary">Submit</button>
          <div id="cooldown-info" class="muted"></div>
        </div>
      </form>
      <div id="message" role="status" class="message"></div>
    </section>

    <footer class="footer">
      <small>Cooldown: 1 hour per IP.</small>
    </footer>
  </main>

  <script src="script.js"></script>
</body>
</html>