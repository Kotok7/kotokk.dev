class SongApp {
  constructor() {
    this.form = document.getElementById('songForm');
    this.list = document.getElementById('songsList');
    this.submitBtn = document.getElementById('submitBtn');
    this.messageContainer = document.getElementById('message-container');
    this.coverPreview = document.getElementById('cover-preview');
    this.linkInput = document.getElementById('link');
    this.linkInput.readOnly = true;
    this.linkInput.style.pointerEvents = 'none';
    this.linkInput.style.userSelect = 'none';
    this.linkInput.style.backgroundColor = '#f0f0f0';
    this.linkInput.style.cursor = 'not-allowed';
    this.form.addEventListener('submit', this.handleSubmit.bind(this));
    this.form.title.addEventListener('change', this.fetchSpotifyData.bind(this));
    this.form.author.addEventListener('change', this.fetchSpotifyData.bind(this));
    this.loadSongs();
  }
  async fetchSpotifyData() {
    const title = this.form.title.value.trim();
    const author = this.form.author.value.trim();
    if (!title || !author) return;
    try {
      const res = await fetch(`spotify.php?track=${encodeURIComponent(title)}&artist=${encodeURIComponent(author)}`);
      if (!res.ok) throw new Error(res.status);
      const data = await res.json();
      if (data.cover) {
        this.form.cover.value = data.cover;
        this.coverPreview.innerHTML = `<img src="${data.cover}" style="width:150px;border-radius:8px;">`;
      }
      if (data.spotify) this.linkInput.value = data.spotify;
    } catch {}
  }
  async loadSongs() {
    try {
      const res = await fetch('songs.php');
      const songs = await res.json();
      this.renderSongs(songs);
      this.attachRatingHandlers();
    } catch {
      this.showMessage('Failed to load songs. Please refresh.', 'error');
      this.list.innerHTML = '<div class="empty-state">❌ An error occurred while loading</div>';
    }
  }
  renderSongs(songs) {
    this.list.innerHTML = '';
    if (!songs.length) {
      this.list.innerHTML = '<div class="empty-state">🎵 No songs yet. Add your first one!</div>';
      return;
    }
    songs.forEach(song => {
      const avg = song.ratings && song.ratings.length
        ? (song.ratings.reduce((a,b)=>a+b,0)/song.ratings.length).toFixed(1)
        : '–';
      const votedKey = `voted_${song.id}`;
      const hasVoted = !!localStorage.getItem(votedKey);
      const stars = [1,2,3,4,5].map(n => {
        const cls = hasVoted
          ? (n <= (localStorage.getItem(`${votedKey}_value`)||0) ? 'star selected' : 'star disabled')
          : 'star';
        return `<span class="${cls}" data-value="${n}">&#9733;</span>`;
      }).join('');
      this.list.insertAdjacentHTML('beforeend', `
        <li class="song-item">
          <div class="song-nickname">👤 ${song.nickname}</div>
          ${song.cover?`<img src="${song.cover}" class="song-cover">`:''}
          <div class="song-title">${song.title}</div>
          <div class="song-rating">Rating: ${avg} / 5 (${song.ratings?.length||0})</div>
          <div class="star-container" data-id="${song.id}">${stars}</div>
          <div class="song-author">${song.author}</div>
          <div class="song-date">${this.formatDate(song.added)}</div>
          ${song.description?`<div class="song-description">${song.description}</div>`:``}
          ${song.link?`<a href="${song.link}" target="_blank" class="song-link">${LISTEN_LABEL}</a>`:``}
        </li>
      `);
    });
  }
  attachRatingHandlers() {
    document.querySelectorAll('.star-container').forEach(container => {
      const songId = container.dataset.id;
      const votedKey = `voted_${songId}`;
      if (localStorage.getItem(votedKey)) return;
      container.querySelectorAll('.star').forEach(star => {
        star.addEventListener('mouseenter', () => {
          const v = +star.dataset.value;
          container.querySelectorAll('.star').forEach(s => {
            s.classList.toggle('hovered', +s.dataset.value <= v);
          });
        });
        star.addEventListener('mouseleave', () => {
          container.querySelectorAll('.star').forEach(s => s.classList.remove('hovered'));
        });
        star.addEventListener('click', async () => {
          const rating = +star.dataset.value;
          try {
            const res = await fetch('songs.php', {
              method: 'POST',
              headers: {'Content-Type':'application/json'},
              body: JSON.stringify({id: songId, rating})
            });
            const json = await res.json();
            if (!res.ok) throw new Error();
            localStorage.setItem(votedKey, 'true');
            localStorage.setItem(`${votedKey}_value`, rating);
            this.showMessage('Thanks for your vote! ⭐', 'success');
            this.renderSongs(json);
            this.attachRatingHandlers();
          } catch {
            this.showMessage('Vote failed. Try again.', 'error');
          }
        });
      });
    });
  }
  async handleSubmit(e) {
    e.preventDefault();
    const fd = new FormData(this.form);
    const payload = {
      title: fd.get('title').trim(),
      author: fd.get('author').trim(),
      nickname: fd.get('nickname').trim(),
      description: fd.get('description').trim(),
      link: fd.get('link').trim(),
      cover: fd.get('cover').trim()
    };
    if (!payload.title || !payload.author || !payload.nickname) {
      this.showMessage('Title, artist and nickname are required!', 'error');
      return;
    }
    this.submitBtn.disabled = true;
    this.submitBtn.textContent = 'Adding...';
    try {
      const res = await fetch('songs.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(payload)
      });
      const json = await res.json();
      if (!res.ok) throw new Error();
      this.form.reset();
      this.coverPreview.innerHTML = '';
      this.showMessage('Song added successfully! 🎉', 'success');
      this.renderSongs(json);
      this.attachRatingHandlers();
    } catch {
      this.showMessage('Error adding song.', 'error');
    } finally {
      this.submitBtn.disabled = false;
      this.submitBtn.textContent = 'Add song';
    }
  }
  showMessage(text, type) {
    this.messageContainer.innerHTML = `<div class="${type}-message">${text}</div>`;
    setTimeout(() => { this.messageContainer.innerHTML = ''; }, 5000);
  }
  formatDate(d) {
    return new Date(d).toLocaleDateString('en-US',{year:'numeric',month:'long',day:'numeric'});
  }
}
document.addEventListener('DOMContentLoaded', () => new SongApp());
