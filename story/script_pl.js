const storyList = document.getElementById('story-list');
const form = document.getElementById('sentence-form');
const submitBtn = document.getElementById('submit-btn');
const msg = document.getElementById('message');
const cooldownInfo = document.getElementById('cooldown-info');
const refreshBtn = document.getElementById('refresh');

let cooldownEndsAt = 0;
let cooldownTimer = null;

function fetchStory() {
  fetch('get_story_pl.php')
    .then(r => r.json())
    .then(data => {
      const s = data.sentences || [];
      if (s.length === 0) {
        storyList.textContent = 'Brak zdań — bądź pierwszy!';
        return;
      }
      const allText = s.map(item => item.sentence).join(' ');
      storyList.textContent = allText;
      storyList.scrollTop = storyList.scrollHeight;
    })
    .catch(() => {
      storyList.textContent = 'Błąd pobierania opowieści.';
    });
}

function startCooldown(seconds) {
  const now = Date.now();
  cooldownEndsAt = now + seconds * 1000;
  if (cooldownTimer) clearInterval(cooldownTimer);
  updateCooldownUI();
  cooldownTimer = setInterval(updateCooldownUI, 300);
}

function updateCooldownUI() {
  const now = Date.now();
  const remaining = Math.max(0, Math.round((cooldownEndsAt - now) / 1000));
  if (remaining <= 0) {
    cooldownInfo.textContent = '';
    submitBtn.disabled = false;
    if (cooldownTimer) { clearInterval(cooldownTimer); cooldownTimer = null; }
  } else {
    submitBtn.disabled = true;
    const h = Math.floor(remaining / 3600);
    const m = Math.floor((remaining % 3600) / 60);
    const s = remaining % 60;
    cooldownInfo.textContent = `Możesz dodać kolejne zdanie za ${h}h ${m}m ${s}s`;
  }
}

form.addEventListener('submit', e => {
  e.preventDefault();
  msg.textContent = '';
  const data = new FormData(form);
  submitBtn.disabled = true;
  fetch('submit_pl.php', { method: 'POST', body: data })
    .then(r => r.json())
    .then(resp => {
      if (resp.ok) {
        msg.textContent = 'Dodano zdanie — dziękujemy!';
        form.reset();
        fetchStory();
        startCooldown(3600);
      } else {
        if (resp.error === 'cooldown' && resp.remaining) {
          msg.textContent = 'Musisz poczekać przed kolejnym dodaniem.';
          startCooldown(resp.remaining);
        } else {
          msg.textContent = resp.error || 'Błąd serwera';
          submitBtn.disabled = false;
        }
      }
    })
    .catch(() => {
      msg.textContent = 'Błąd połączenia';
      submitBtn.disabled = false;
    });
});

refreshBtn.addEventListener('click', fetchStory);

fetchStory();
