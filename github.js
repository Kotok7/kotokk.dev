fetch("https://api.github.com/repos/Kotok7/kotokk.dev/commits?per_page=1")
  .then(res => res.ok ? res.json() : Promise.reject(res.status))
  .then(data => {
    const { message, author: { date } } = data[0].commit;
    const messageEl = document.getElementById("commit-message");
    const dateEl = document.getElementById("commit-date");

    messageEl.classList.remove('loading');
    messageEl.textContent = message;

    const formattedDate = new Date(date).toLocaleString("pl-PL", {
      dateStyle: "medium",
      timeStyle: "short"
    });
    dateEl.textContent = formattedDate;
  })
  .catch(err => {
    console.error("GitHub API error:", err);
    const messageEl = document.getElementById("commit-message");
    const dateEl = document.getElementById("commit-date");

    messageEl.classList.remove('loading');
    messageEl.textContent = "Błąd ładowania";
    dateEl.textContent = "Sprawdź połączenie";
  });
