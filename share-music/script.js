class SongApp {
    constructor() {
        this.form             = document.getElementById('songForm');
        this.list             = document.getElementById('songsList');
        this.submitBtn        = document.getElementById('submitBtn');
        this.messageContainer = document.getElementById('message-container');
        this.coverPreview     = document.getElementById('cover-preview');
        this.linkInput        = document.getElementById('link');
        this.init();
    }

    init() {
        this.linkInput.readOnly = true;
        this.linkInput.style.pointerEvents   = 'none';
        this.linkInput.style.userSelect       = 'none';
        this.linkInput.style.backgroundColor  = '#f0f0f0';
        this.linkInput.style.cursor           = 'not-allowed';

        this.form.addEventListener('submit', this.handleSubmit.bind(this));
        this.form.title.addEventListener('change', this.fetchSpotifyData.bind(this));
        this.form.author.addEventListener('change', this.fetchSpotifyData.bind(this));
        this.loadSongs();
    }

    async fetchSpotifyData() {
        const title  = this.form.title.value.trim();
        const author = this.form.author.value.trim();
        if (!title || !author) return;

        try {
            const res = await fetch(
              `spotify.php?track=${encodeURIComponent(title)}&artist=${encodeURIComponent(author)}`
            );
            if (!res.ok) throw new Error(res.status);
            const data = await res.json();

            if (data.cover) {
                this.form.cover.value = data.cover;
                this.showCoverPreview(data.cover);
            }
            if (data.spotify) {
                this.linkInput.value = data.spotify;
            }
        } catch (err) {
            console.warn('Spotify fetch error:', err);
        }
    }

    showCoverPreview(url) {
        this.coverPreview.innerHTML = `
          <img src="${this.escapeHtml(url)}" alt="Cover preview"
               style="width:150px;border-radius:8px;">
        `;
    }

    async loadSongs() {
        try {
            const res = await fetch('songs.php');
            if (!res.ok) throw new Error(res.status);
            const songs = await res.json();
            this.renderSongs(songs);
        } catch (err) {
            this.showMessage('Failed to load songs.', 'error');
            this.list.innerHTML = '<div class="empty-state">❌ Błąd ładowania</div>';
        }
    }

    renderSongs(songs) {
        if (!Array.isArray(songs) || songs.length === 0) {
            this.list.innerHTML = '<div class="empty-state">🎵 Brak piosenek</div>';
            return;
        }
        this.list.innerHTML = '';

        songs.forEach(song => {
            const artistLink = `https://open.spotify.com/search/${encodeURIComponent(song.author)}`;
            const authorHtml = `<a href="${artistLink}" target="_blank" rel="noopener noreferrer">
                                    ${this.escapeHtml(song.author)}
                                </a>`;

            const li = document.createElement('li');
            li.className = 'song-item';
            li.innerHTML = `
                ${song.cover ? `<img src="${this.escapeHtml(song.cover)}" alt="Cover"
                   class="song-cover" style="width:100px;">` : ''}
                <div class="song-title">${this.escapeHtml(song.title)}</div>
                <div class="song-author">👤 ${authorHtml}</div>
                <div class="song-date">📅 ${this.formatDate(song.added)}</div>
                ${song.description ? `<div class="song-description">
                   ${this.escapeHtml(song.description)}</div>` : ''}
                ${song.link ? `<a href="${this.escapeHtml(song.link)}"
                   target="_blank" rel="noopener noreferrer" class="song-link">🎧 Posłuchaj</a>` : ''}
            `;
            this.list.appendChild(li);
        });
    }

    async handleSubmit(e) {
        e.preventDefault();
        const fd = new FormData(this.form);
        const payload = {
            title:       fd.get('title')?.trim(),
            author:      fd.get('author')?.trim(),
            description: fd.get('description')?.trim(),
            link:        fd.get('link')?.trim(),
            cover:       fd.get('cover')?.trim()
        };

        if (!payload.title || !payload.author) {
            this.showMessage('Title and artist are required!', 'error');
            return;
        }

        this.setLoading(true);
        try {
            const res = await fetch('songs.php', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify(payload)
            });
            const json = await res.json();
            if (!res.ok) throw new Error(json.error || res.status);

            this.form.reset();
            this.coverPreview.innerHTML = '';
            this.showMessage('The song has been successfully added! 🎉', 'success');
            this.renderSongs(json);
        } catch (err) {
            this.showMessage(`Error: ${err.message}`, 'error');
        } finally {
            this.setLoading(false);
        }
    }

    setLoading(on) {
        this.submitBtn.disabled   = on;
        this.submitBtn.innerHTML  = on
            ? '<span class="loading"></span> Dodaj...'
            : 'Dodaj piosenkę';
    }

    showMessage(msg, type) {
        this.messageContainer.innerHTML = `<div class="${type}-message">${msg}</div>`;
        setTimeout(() => { this.messageContainer.innerHTML = ''; }, 5000);
    }

    escapeHtml(txt) {
        const d = document.createElement('div');
        d.textContent = txt;
        return d.innerHTML;
    }

    formatDate(ds) {
        const d = new Date(ds);
        return d.toLocaleDateString('pl-PL', {
            year: 'numeric', month: 'long', day: 'numeric'
        });
    }
}

document.addEventListener('DOMContentLoaded', () => new SongApp());
