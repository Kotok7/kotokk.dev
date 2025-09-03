class SongApp {
  constructor(){
    this.form=document.getElementById('songForm');
    this.list=document.getElementById('songsList');
    this.submitBtn=document.getElementById('submitBtn');
    this.messageContainer=document.getElementById('message-container');
    this.coverPreview=document.getElementById('cover-preview');
    this.linkInput=document.getElementById('link');
    this.sortSelect=document.getElementById('sortSelect');
    this.originalSubmitText=this.submitBtn.textContent;
    Object.assign(this.linkInput.style,{
      pointerEvents:'none',
      userSelect:'none',
      backgroundColor:'#f0f0f0',
      cursor:'not-allowed'
    });
    this.linkInput.readOnly=true;
    this.form.addEventListener('submit',this.handleSubmit.bind(this));
    this.form.title.addEventListener('change',this.fetchSpotifyData.bind(this));
    this.form.author.addEventListener('change',this.fetchSpotifyData.bind(this));
    this.sort=this.loadSortPreference();
    this.sortSelect.value=this.sort;
    this.sortSelect.addEventListener('change',()=>{
      this.sort=this.sortSelect.value;
      this.saveSortPreference();
      this.loadSongs();
    });
    this.loadSongs();
  }
  loadSortPreference(){
    const s=localStorage.getItem('song_sort');
    return s? s : 'date';
  }
  saveSortPreference(){
    localStorage.setItem('song_sort',this.sort);
  }
  async fetchSpotifyData(){
    const t=this.form.title.value.trim(),a=this.form.author.value.trim();
    if(!t||!a)return;
    try{
      const res=await fetch(`spotify.php?track=${encodeURIComponent(t)}&artist=${encodeURIComponent(a)}`);
      if(!res.ok)throw'';
      const d=await res.json();
      if(d.cover){
        this.form.cover.value=d.cover;
        this.coverPreview.innerHTML=`<img src="${d.cover}" style="width:150px;border-radius:8px;">`;
      }
      if(d.spotify)this.linkInput.value=d.spotify;
    }catch{}
  }
  async loadSongs(){
    try{
      const res=await fetch(`songs.php?sort=${encodeURIComponent(this.sort)}`);
      if(!res.ok)throw'';
      const s=await res.json();
      this.renderSongs(s);
      this.attachRatingHandlers();
    }catch{
      this.showMessage('Failed to load songs. Please refresh.','error');
      this.list.innerHTML='<div class="empty-state">❌ An error occurred while loading</div>';
    }
  }
  renderSongs(songs){
    this.list.innerHTML='';
    if(!songs.length){
      this.list.innerHTML='<div class="empty-state">🎵 No songs yet. Add your first one!</div>';
      return;
    }
    songs.forEach(song=>{
      const avg=song.ratings&&song.ratings.length?(song.ratings.reduce((a,b)=>a+b,0)/song.ratings.length).toFixed(1):'–';
      const votedKey=`voted_${song.id}`,hasVoted=!!localStorage.getItem(votedKey);
      const stars=[1,2,3,4,5].map(n=>{
        const cls=hasVoted?(n<=localStorage.getItem(`${votedKey}_value`)?'star selected':'star disabled'):'star';
        return`<span class="${cls}" data-value="${n}">&#9733;</span>`;
      }).join('');
      const tags=song.genres&&song.genres.length?`<div class="song-genres">${song.genres.map(g=>`<span class="tag">${g}</span>`).join(' ')}</div>`:'';
      this.list.insertAdjacentHTML('beforeend',`
        <li class="song-item">
          <div class="song-nickname">👤 ${song.nickname}</div>
          ${song.cover?`<img src="${song.cover}" class="song-cover">`:''}
          <div class="song-title">${song.title}</div>
          ${tags}
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
  attachRatingHandlers(){
    document.querySelectorAll('.star-container').forEach(c=>{
      const id=c.dataset.id,key=`voted_${id}`;
      if(localStorage.getItem(key))return;
      c.querySelectorAll('.star').forEach(star=>{
        star.addEventListener('mouseenter',()=>{
          const v=+star.dataset.value;
          c.querySelectorAll('.star').forEach(s=>s.classList.toggle('hovered',+s.dataset.value<=v));
        });
        star.addEventListener('mouseleave',()=>c.querySelectorAll('.star').forEach(s=>s.classList.remove('hovered')));
        star.addEventListener('click',async()=>{
          const r=+star.dataset.value;
          try{
            const res=await fetch(`songs.php?sort=${encodeURIComponent(this.sort)}`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({id,rating:r})});
            if(!res.ok)throw'';
            const j=await res.json();
            localStorage.setItem(key,'true');
            localStorage.setItem(`${key}_value`,r);
            this.showMessage('Thanks for your vote! ⭐','success');
            this.renderSongs(j);
            this.attachRatingHandlers();
          }catch{
            this.showMessage('Vote failed. Try again.','error');
          }
        });
      });
    });
  }
  async handleSubmit(e){
    e.preventDefault();
    const fd=new FormData(this.form);
    const p={
      title:fd.get('title').trim(),
      author:fd.get('author').trim(),
      nickname:fd.get('nickname').trim(),
      genres:fd.get('genres').trim(),
      description:fd.get('description').trim(),
      link:fd.get('link').trim(),
      cover:fd.get('cover').trim()
    };
    if(!p.title||!p.author||!p.nickname){
      this.showMessage('Title, artist and nickname are required!','error');
      return;
    }
    this.submitBtn.disabled=true;this.submitBtn.textContent='Adding...';
    try{
      const res=await fetch(`songs.php?sort=${encodeURIComponent(this.sort)}`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(p)});
      if(!res.ok)throw'';
      const j=await res.json();
      this.form.reset();this.coverPreview.innerHTML='';
      this.showMessage('Song added successfully! 🎉','success');
      this.renderSongs(j);this.attachRatingHandlers();
    }catch{
      this.showMessage('Error adding song.','error');
    }finally{
      this.submitBtn.disabled=false;this.submitBtn.textContent=this.originalSubmitText;
    }
  }
  showMessage(t,type){
    this.messageContainer.innerHTML=`<div class="${type}-message">${t}</div>`;
    setTimeout(()=>this.messageContainer.innerHTML='',5000);
  }
  formatDate(d){return new Date(d).toLocaleDateString('en-US',{year:'numeric',month:'long',day:'numeric'});}
}
document.addEventListener('DOMContentLoaded',()=>new SongApp());
