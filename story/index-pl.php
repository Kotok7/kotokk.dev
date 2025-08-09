<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Kotokk - Wspólna opowieść</title>
  <link rel="stylesheet" href="style.css" />
  <meta name="description" content="Wspólna opowieść. Każdy dodaje po jednym zdaniu i ma cooldown na godzinę." />
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
  Wróć do strony głównej
</button>
      <a href="index.php" class="icon-link">
        <img src="/photos/united-states.png" alt="Przetłumacz na Angielski" title="Przetłumacz na Angielski" loading="lazy">
      </a>
      <h1>Wspólna opowieść</h1>
      <p class="subtitle">Dodaj jedno zdanie — opowieść jest zapisywana do JSON i widoczna dla wszystkich.</p>
    </header>

    <section class="panel">
      <h2>Opowieść</h2>
      <div id="story-list" class="story-list">Ładowanie...</div>
      <div class="actions">
        <button id="refresh" class="btn">Odśwież</button>
      </div>
    </section>

    <section class="panel">
      <h2>Dodaj jedno zdanie</h2>
      <form id="sentence-form" class="form">
        <textarea id="sentence" name="sentence" placeholder="Napisz dokładnie jedno zdanie..." maxlength="500" required></textarea>
        <div class="row">
          <button type="submit" id="submit-btn" class="btn primary">Wyślij</button>
          <div id="cooldown-info" class="muted"></div>
        </div>
      </form>
      <div id="message" role="status" class="message"></div>
    </section>

    <footer class="footer">
      <small>Cooldown: 1 godzina na IP.</small>
    </footer>
  </main>

  <script src="script_pl.js"></script>
</body>
</html>