  fetch("https://api.github.com/repos/Kotok7/kotokk.dev/commits?per_page=3")
    .then(res => res.ok ? res.json() : Promise.reject(res.status))
    .then(data => {
      const listEl = document.getElementById("commit-list");
      listEl.innerHTML = "";
      data.forEach(commitData => {
        const { message, author: { date } } = commitData.commit;
        const li = document.createElement("li");
        li.className = "commit-item";
        li.innerHTML = `
          <p class="commit-message">${message}</p>
          <p class="commit-date">${new Date(date).toLocaleString("en-US", {
            dateStyle: "medium",
            timeStyle: "short"
          })}</p>`;
        listEl.appendChild(li);
      });
      listEl.classList.remove("expanded");
    })
    .catch(err => {
      console.error("GitHub API error:", err);
      document.getElementById("commit-list").innerHTML = `
        <li class="commit-item">
          <p class="commit-message">Error loading commits</p>
          <p class="commit-date">Check your connection</p>
        </li>`;
    });

  document.getElementById("toggle-commits").addEventListener("click", e => {
    const list = document.getElementById("commit-list");
    const btn  = e.currentTarget;
    const isExpanded = list.classList.toggle("expanded");
    btn.textContent = isExpanded ? "Show less" : "Show more";
  });
