function escapeHtml(str){
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}
function formatLocalTime(isoString){
  const d = new Date(isoString);
  if (isNaN(d)) return isoString;
  const opts = { year:'numeric', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' };
  return new Intl.DateTimeFormat(navigator.language || (LANG === 'pl' ? 'pl-PL':'en-US'), opts).format(d);
}
function timeAgo(isoString){
  const d = new Date(isoString);
  if (isNaN(d)) return '';
  const seconds = Math.floor((Date.now() - d.getTime())/1000);
  if (seconds < 5) return JS_T.just_now || (LANG==='pl' ? 'przed chwilą' : 'just now');
  const units = [
    {name:'year', secs:31557600},
    {name:'month', secs:2629800},
    {name:'week', secs:604800},
    {name:'day', secs:86400},
    {name:'hour', secs:3600},
    {name:'minute', secs:60},
    {name:'second', secs:1}
  ];
  const locale = navigator.language || (LANG === 'pl' ? 'pl-PL' : 'en-US');
  const rtf = new Intl.RelativeTimeFormat(locale, { numeric: 'auto' });
  for (let u of units){
    const v = Math.floor(seconds / u.secs);
    if (v >= 1) {
      return rtf.format(-v, u.name);
    }
  }
  return '';
}
async function fetchPosts(){
  const container = document.getElementById('postsContainer');
  container.innerHTML = '';
  try{
    const resp = await fetch('api.php?action=get_posts');
    const data = await resp.json();
    if (!data.ok){
      container.innerHTML = `<p class="no-posts">${escapeHtml(JS_T.error_generic)}</p>`;
      return;
    }
    const posts = data.posts || [];
    if (posts.length === 0){
      container.innerHTML = `<p class="no-posts">${escapeHtml((LANG==='pl')? 'Brak gier — bądź pierwszy!' : 'No games yet — be the first!')}</p>`;
      return;
    }
    posts.sort((a,b)=> new Date(b.created_at) - new Date(a.created_at));
    posts.forEach(p => {
      const article = document.createElement('article');
      article.className = 'post';
      article.setAttribute('data-id', p.id);
      const thumbsHTML = (p.screenshots && p.screenshots.length)? `<div class="thumbs">${p.screenshots.map(s=>`<img loading="lazy" src="${escapeHtml(s)}" alt="${escapeHtml(p.title)} screenshot">`).join('') }</div>` : `<div class="thumbs empty"></div>`;
      const platform = p.platform ? escapeHtml(p.platform) : '-';
      const createdLocal = formatLocalTime(p.created_at);
      const ago = timeAgo(p.created_at);
      const desc = p.description ? `<p class="desc">${escapeHtml(p.description).replace(/\n/g,'<br>')}</p>` : '';
      const likes = Number(p.likes||0);
      const dislikes = Number(p.dislikes||0);
      const ur = Number(p.user_reaction||0);
      article.innerHTML = `
        ${thumbsHTML}
        <div class="content">
          <h3>${escapeHtml(p.title)}</h3>
          <p class="meta">${escapeHtml((LANG==='pl')? 'Platforma' : 'Platform')}: ${platform} · ${escapeHtml((LANG==='pl')? 'Dodano' : 'Added')}: <time class="local-time" data-utc="${escapeHtml(p.created_at)}">${escapeHtml(createdLocal)}</time> ${ago?'<span class="ago">· '+escapeHtml(ago)+'</span>':''}</p>
          ${desc}
          <div class="actions" role="group" aria-label="Reactions">
            <button class="react like ${ur===1?'active':''}" data-reaction="1" aria-pressed="${ur===1?'true':'false'}" title="${escapeHtml(JS_T.like_text)}">
              <span class="label">${escapeHtml(JS_T.like_text)}</span>
              <span class="count">${likes}</span>
            </button>
            <button class="react dislike ${ur===-1?'active':''}" data-reaction="-1" aria-pressed="${ur===-1?'true':'false'}" title="${escapeHtml(JS_T.dislike_text)}">
              <span class="label">${escapeHtml(JS_T.dislike_text)}</span>
              <span class="count">${dislikes}</span>
            </button>
          </div>
        </div>
      `;
      container.appendChild(article);
    });
    attachActionListeners();
    attachLightbox();
  }catch(e){
    const container = document.getElementById('postsContainer');
    container.innerHTML = `<p class="no-posts">${escapeHtml(JS_T.error_generic)}</p>`;
  }
}
function attachActionListeners(){
  document.querySelectorAll('.post .actions .react').forEach(btn=>{
    btn.addEventListener('click', async (e)=>{
      const article = btn.closest('.post');
      const postId = article.getAttribute('data-id');
      const reaction = parseInt(btn.getAttribute('data-reaction'),10);
      const likeBtn = article.querySelector('.react.like');
      const dislikeBtn = article.querySelector('.react.dislike');
      const likeCountEl = likeBtn.querySelector('.count');
      const dislikeCountEl = dislikeBtn.querySelector('.count');
      const prevStateLike = likeBtn.classList.contains('active');
      const prevStateDislike = dislikeBtn.classList.contains('active');
      let optimisticLikes = parseInt(likeCountEl.textContent,10);
      let optimisticDislikes = parseInt(dislikeCountEl.textContent,10);
      if (reaction === 1){
        if (prevStateLike){
          optimisticLikes = Math.max(0, optimisticLikes-1);
          likeBtn.classList.remove('active');
          likeBtn.setAttribute('aria-pressed','false');
        } else {
          optimisticLikes = optimisticLikes+1;
          likeBtn.classList.add('active');
          likeBtn.setAttribute('aria-pressed','true');
          if (prevStateDislike){
            optimisticDislikes = Math.max(0, optimisticDislikes-1);
            dislikeBtn.classList.remove('active');
            dislikeBtn.setAttribute('aria-pressed','false');
          }
        }
      } else {
        if (prevStateDislike){
          optimisticDislikes = Math.max(0, optimisticDislikes-1);
          dislikeBtn.classList.remove('active');
          dislikeBtn.setAttribute('aria-pressed','false');
        } else {
          optimisticDislikes = optimisticDislikes+1;
          dislikeBtn.classList.add('active');
          dislikeBtn.setAttribute('aria-pressed','true');
          if (prevStateLike){
            optimisticLikes = Math.max(0, optimisticLikes-1);
            likeBtn.classList.remove('active');
            likeBtn.setAttribute('aria-pressed','false');
          }
        }
      }
      likeCountEl.textContent = optimisticLikes;
      dislikeCountEl.textContent = optimisticDislikes;
      try {
        const resp = await fetch('api.php', {
          method: 'POST',
          headers: {'Content-Type':'application/json'},
          body: JSON.stringify({ action:'react', post_id: postId, reaction: reaction })
        });
        const data = await resp.json();
        if (!data.ok){
          throw new Error(data.msg || JS_T.error_generic);
        }
        likeCountEl.textContent = data.likes;
        dislikeCountEl.textContent = data.dislikes;
        if (data.user_reaction == 1){
          likeBtn.classList.add('active');
          likeBtn.setAttribute('aria-pressed','true');
          dislikeBtn.classList.remove('active');
          dislikeBtn.setAttribute('aria-pressed','false');
        } else if (data.user_reaction == -1){
          dislikeBtn.classList.add('active');
          dislikeBtn.setAttribute('aria-pressed','true');
          likeBtn.classList.remove('active');
          likeBtn.setAttribute('aria-pressed','false');
        } else {
          likeBtn.classList.remove('active');
          likeBtn.setAttribute('aria-pressed','false');
          dislikeBtn.classList.remove('active');
          dislikeBtn.setAttribute('aria-pressed','false');
        }
      } catch(err){
        alert(err.message || JS_T.error_generic);
        fetchPosts();
      }
    });
  });
}
function attachLightbox(){
  document.querySelectorAll('.thumbs img').forEach(img=>{
    img.style.cursor = 'zoom-in';
    img.addEventListener('click', e=>{
      const lb = document.getElementById('lightbox');
      lb.innerHTML = `<img src="${img.src}" alt="${img.alt}">`;
      lb.style.display = 'flex';
      lb.setAttribute('aria-hidden','false');
      setTimeout(()=>lb.classList.add('open'),10);
      lb.addEventListener('click', ()=> {
        lb.classList.remove('open');
        setTimeout(()=> { lb.style.display='none'; lb.innerHTML=''; lb.setAttribute('aria-hidden','true'); },250);
      }, { once:true });
    });
  });
}
function updateTimes(){
  document.querySelectorAll('.local-time').forEach(el=>{
    const iso = el.dataset.utc;
    if (!iso) return;
    el.textContent = formatLocalTime(iso);
    const agoEl = el.parentElement.querySelector('.ago');
    const ago = timeAgo(iso);
    if (ago){
      if (agoEl) agoEl.textContent = '· ' + ago;
      else {
        const span = document.createElement('span');
        span.className = 'ago';
        span.textContent = '· ' + ago;
        span.style.marginLeft = '6px';
        el.parentElement.appendChild(span);
      }
    } else if (agoEl){
      agoEl.remove();
    }
  });
}
function setupForm(){
  const fileInput = document.getElementById('screenshots');
  const preview = document.getElementById('preview');
  fileInput.addEventListener('change', ()=>{
    preview.innerHTML = '';
    const files = Array.from(fileInput.files).slice(0, JS_T.max_uploads);
    files.forEach(f=>{
      if (f.size > JS_T.max_size_bytes) return;
      const reader = new FileReader();
      reader.onload = function(e){
        const img = document.createElement('img');
        img.src = e.target.result;
        img.alt = f.name;
        img.className = 'preview-img';
        img.title = f.name;
        img.addEventListener('click', ()=>{
          const lb = document.getElementById('lightbox');
          lb.innerHTML = `<img src="${img.src}" alt="${img.alt}">`;
          lb.style.display = 'flex';
          lb.setAttribute('aria-hidden','false');
          setTimeout(()=>lb.classList.add('open'),10);
          lb.addEventListener('click', ()=> {
            lb.classList.remove('open');
            setTimeout(()=> { lb.style.display='none'; lb.innerHTML=''; lb.setAttribute('aria-hidden','true'); },250);
          }, { once:true });
        });
        preview.appendChild(img);
      };
      reader.readAsDataURL(f);
    });
    if (fileInput.files.length > JS_T.max_uploads){
      alert((LANG==='pl')?`Możesz przesłać maksymalnie ${JS_T.max_uploads} obrazów.`:`You can upload up to ${JS_T.max_uploads} images.`);
    }
  });
  const form = document.getElementById('addForm');
  form.addEventListener('submit', (e)=>{
    const title = document.getElementById('title').value.trim();
    if (!title){
      e.preventDefault();
      alert(JS_T.error_missing_title);
      return false;
    }
    const files = Array.from(fileInput.files);
    for (let f of files){
      if (f.size > JS_T.max_size_bytes){
        e.preventDefault();
        alert((LANG==='pl')? 'Jeden z plików jest za duży (max 2MB).' : 'One of the files is too large (max 2MB).');
        return false;
      }
    }
    if (files.length > JS_T.max_uploads){
      e.preventDefault();
      alert((LANG==='pl')? `Możesz przesłać maksymalnie ${JS_T.max_uploads} obrazów.` : `You can upload up to ${JS_T.max_uploads} images.`);
      return false;
    }
    return true;
  });
}
document.addEventListener('DOMContentLoaded', ()=>{
  fetchPosts();
  setupForm();
  updateTimes();
  setInterval(updateTimes, 60*1000);
});
