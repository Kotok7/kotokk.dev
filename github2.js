    fetch("https://api.github.com/repos/Kotok7/kotokk.dev/commits?per_page=1")
      .then(res => res.ok ? res.json() : Promise.reject(res.status))
      .then(data => {
        const { message, author: { date } } = data[0].commit;
        const messageEl = document.getElementById("commit-message");
        const dateEl = document.getElementById("commit-date");
        
        messageEl.classList.remove('loading');
        messageEl.textContent = message;
        dateEl.textContent = new Date(date).toLocaleString("pl-PL") + " GMT+2";
      })
      .catch(err => {
        console.error("GitHub API error:", err);
        const messageEl = document.getElementById("commit-message");
        const dateEl = document.getElementById("commit-date");
        
        messageEl.classList.remove('loading');
        messageEl.textContent = "Błąd ładowania";
        dateEl.textContent = "Sprawdź połączenie";
      });
