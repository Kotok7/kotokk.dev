const storyList = document.getElementById('story-list');
const form = document.getElementById('sentence-form');
const submitBtn = document.getElementById('submit-btn');
const msg = document.getElementById('message');
const cooldownInfo = document.getElementById('cooldown-info');
const refreshBtn = document.getElementById('refresh');

let cooldownEndsAt = 0;
let cooldownTimer = null;

function fetchStory() {
  fetch('get_story.php')
    .then(r => r.json())
    .then(data => {
      const s = data.sentences || [];
      if (s.length === 0) {
        storyList.textContent = 'No sentences yet — be the first!';
        return;
      }
      const allText = s.map(item => item.sentence).join(' ');
      storyList.textContent = allText;
      storyList.scrollTop = storyList.scrollHeight;
    })
    .catch(() => {
      storyList.textContent = 'Failed to load story.';
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
    cooldownInfo.textContent = `You can add another sentence in ${h}h ${m}m ${s}s`;
  }
}

form.addEventListener('submit', e => {
  e.preventDefault();
  msg.textContent = '';
  const data = new FormData(form);
  submitBtn.disabled = true;
  fetch('submit.php', { method: 'POST', body: data })
    .then(r => r.json())
    .then(resp => {
      if (resp.ok) {
        msg.textContent = 'Sentence added. Thank you!';
        form.reset();
        fetchStory();
        startCooldown(3600);
      } else {
        if (resp.error === 'cooldown' && resp.remaining) {
          msg.textContent = 'Please wait before adding another sentence.';
          startCooldown(resp.remaining);
        } else {
          msg.textContent = resp.error || 'Server error';
          submitBtn.disabled = false;
        }
      }
    })
    .catch(() => {
      msg.textContent = 'Network error';
      submitBtn.disabled = false;
    });
});

refreshBtn.addEventListener('click', fetchStory);

fetchStory();