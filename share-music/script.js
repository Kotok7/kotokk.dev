class SongApp {
    constructor() {
        this.form = document.getElementById('songForm');
        this.list = document.getElementById('songsList');
        this.submitBtn = document.getElementById('submitBtn');
        this.messageContainer = document.getElementById('message-container');
        this.coverPreview = document.getElementById('cover-preview');
        this.init();
    }

    init() {
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
            const response = await fetch(`spotify.php?track=${encodeURIComponent(title)}&artist=${encodeURIComponent(author)}`);
            if (!response.ok) throw new Error(`Spotify fetch error: ${response.status}`);
            const result = await response.json();
            console.log('Spotify result:', result);
            if (result.cover) {
                this.form.cover.value = result.cover;
                this.showCoverPreview(result.cover);
            }
            if (result.spotify) {
                this.form.link.value = result.spotify;
            }
        } catch (err) {
            console.warn('No data from Spotify:', err);
        }
    }

    showCoverPreview(url) {
        this.coverPreview.innerHTML = `<img src="${this.escapeHtml(url)}" alt="Cover preview" style="width:150px;border-radius:8px;">`;
    }

    async loadSongs() {
        try {
            const response = await fetch('songs.php');
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            const songs = await response.json();
            this.renderSongs(songs);
        } catch (error) {
            this.showMessage('Failed to load songs. Try refreshing the page.', 'error');
            this.list.innerHTML = '<div class="empty-state">❌ An error occurred while loading</div>';
        }
    }

    renderSongs(songs) {
        if (!Array.isArray(songs) || songs.length === 0) {
            this.list.innerHTML = '<div class="empty-state">🎵 There are no songs yet. Add the first one!</div>';
            return;
        }
        this.list.innerHTML = '';
        songs.forEach(song => {
            const li = document.createElement('li');
            li.className = 'song-item';
            li.innerHTML = `
                ${song.cover ? `<img src="${this.escapeHtml(song.cover)}" alt="Cover" class="song-cover" style="width:100px;">` : ''}
                <div class="song-title">${this.escapeHtml(song.title)}</div>
                <div class="song-author">👤 ${this.escapeHtml(song.author)}</div>
                <div class="song-date">📅 Added: ${this.formatDate(song.added)}</div>
                ${song.description ? `<div class="song-description">${this.escapeHtml(song.description)}</div>` : ''}
                ${song.link ? `<a href="${this.escapeHtml(song.link)}" target="_blank" rel="noopener noreferrer" class="song-link">🎧 Posłuchaj</a>` : ''}
            `;
            this.list.appendChild(li);
        });
    }

    async handleSubmit(e) {
        e.preventDefault();
        const formData = new FormData(this.form);
        const data = {
            title: formData.get('title')?.trim(),
            author: formData.get('author')?.trim(),
            description: formData.get('description')?.trim(),
            link: formData.get('link')?.trim(),
            cover: formData.get('cover')?.trim()
        };
        if (!data.title || !data.author) {
            this.showMessage('Title and artist are required!', 'error');
            return;
        }
        if (data.link && !this.isValidUrl(data.link)) {
            this.showMessage('The provided link has an invalid format!', 'error');
            return;
        }
        this.setLoading(true);
        try {
            const response = await fetch('songs.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if (!response.ok) throw new Error(result.error || `HTTP ${response.status}`);
            this.form.reset();
            this.coverPreview.innerHTML = '';
            this.showMessage('The song has been successfully added! 🎉', 'success');
            this.renderSongs(result);
        } catch (error) {
            this.showMessage(`Error: ${error.message}`, 'error');
        } finally {
            this.setLoading(false);
        }
    }

    setLoading(loading) {
        this.submitBtn.disabled = loading;
        this.submitBtn.innerHTML = loading 
            ? '<span class="loading"></span> Adding...' 
            : 'Dodaj piosenkę';
    }

    showMessage(text, type) {
        this.messageContainer.innerHTML = `<div class="${type}-message">${text}</div>`;
        setTimeout(() => { this.messageContainer.innerHTML = ''; }, 5000);
    }

    isValidUrl(string) {
        try { new URL(string); return true; }
        catch (_) { return false; }
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    formatDate(dateString) {
        try {
            const date = new Date(dateString);
            return date.toLocaleDateString('pl-PL', {
                year: 'numeric', month: 'long', day: 'numeric'
            });
        } catch {
            return dateString;
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new SongApp();
});
