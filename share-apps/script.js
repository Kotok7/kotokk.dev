document.addEventListener('DOMContentLoaded', function(){
  var lang = document.body.getAttribute('data-lang') || navigator.language || 'pl';

  var defaultGlobe = '<span class="icon-wrap" aria-hidden="true"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.4"/><path d="M2 12h20M12 2c3 3 4.5 7 4.5 10s-1.5 7-4.5 10M12 2c-3 3-4.5 7-4.5 10s1.5 7 4.5 10" stroke="currentColor" stroke-width="1.2"/></svg></span>';

  var icons = {
    Web: defaultGlobe,
    Windows: '<span class="icon-wrap" aria-hidden="true"><img src="https://cdn.simpleicons.org/windows/0078D4" alt="" width="18" height="18" loading="lazy" decoding="async"></span>',
    macOS: '<span class="icon-wrap" aria-hidden="true"><img src="https://cdn.simpleicons.org/apple/000000" alt="" width="18" height="18" loading="lazy" decoding="async"></span>',
    iOS: '<span class="icon-wrap" aria-hidden="true"><img src="https://cdn.simpleicons.org/apple/000000" alt="" width="18" height="18" loading="lazy" decoding="async"></span>',
    Linux: '<span class="icon-wrap" aria-hidden="true"><img src="https://cdn.simpleicons.org/linux/000000" alt="" width="18" height="18" loading="lazy" decoding="async"></span>',
    Android: '<span class="icon-wrap" aria-hidden="true"><img src="https://cdn.simpleicons.org/android/3DDC84" alt="" width="18" height="18" loading="lazy" decoding="async"></span>'
  };

  function insertIcons(){
    var els = document.querySelectorAll('.plat');
    els.forEach(function(el){
      var p = (el.getAttribute('data-plat')||'').trim();
      var display = (el.getAttribute('data-plat-display')||'').trim() || p;
      var ico = icons[p] || defaultGlobe;
      el.innerHTML = ico + '<span class="plat-text">' + (display ? display : '') + '</span>';
    });
  }

  function fmtAbsolute(d){
    try{
      return new Intl.DateTimeFormat(lang, {year:'numeric',month:'short',day:'numeric',hour:'2-digit',minute:'2-digit'}).format(d);
    }catch(e){
      return d.toLocaleString();
    }
  }

  function relativeTime(d){
    var now = new Date();
    var diff = (d.getTime() - now.getTime()) / 1000;
    var rtf;
    try{
      rtf = new Intl.RelativeTimeFormat(lang, {numeric:'auto'});
    }catch(e){
      rtf = {format:function(v,u){return Math.abs(v) + ' ' + u + ' ago'}};
    }
    var units = [
      {unit:'year',sec:31536000},
      {unit:'month',sec:2592000},
      {unit:'day',sec:86400},
      {unit:'hour',sec:3600},
      {unit:'minute',sec:60},
      {unit:'second',sec:1}
    ];
    for (var i=0;i<units.length;i++){
      var u = units[i];
      if (Math.abs(diff) >= u.sec || u.unit === 'second'){
        var val = Math.round(diff / u.sec);
        return rtf.format(val, u.unit);
      }
    }
    return '';
  }

  function renderTimes(){
    var cards = Array.prototype.slice.call(document.querySelectorAll('.app-card'));
    cards.forEach(function(card){
      var ts = card.getAttribute('data-ts');
      if (!ts) return;
      var d = new Date(ts);
      if (isNaN(d.getTime())) return;
      var timeEl = card.querySelector('.time');
      if (timeEl) timeEl.textContent = fmtAbsolute(d);
      var rel = card.querySelector('.relative');
      if (rel) rel.textContent = relativeTime(d);
    });
  }

  function applyFilterSort(){
    var grid = document.getElementById('appsGrid');
    if (!grid) return;
    var cards = Array.prototype.slice.call(grid.querySelectorAll('.app-card'));
    var filter = document.getElementById('platformFilter').value;
    var sort = document.getElementById('sortSelect').value;

    cards.forEach(function(card){
      var p = (card.getAttribute('data-platform')||'').trim();
      if (filter === 'all') {
        card.style.display = '';
      } else if (filter === 'none') {
        card.style.display = p === '' ? '' : 'none';
      } else {
        card.style.display = (p === filter || p === 'all') ? '' : 'none';
      }
    });

    cards = cards.filter(function(c){ return c.style.display !== 'none'; });

    if (sort === 'no_platform') {
      cards.forEach(function(card){
        var p = (card.getAttribute('data-platform')||'').trim();
        card.style.display = p === '' ? '' : 'none';
      });
      cards = Array.prototype.slice.call(grid.querySelectorAll('.app-card')).filter(function(c){ return c.style.display !== 'none'; });
    } else if (sort === 'newest' || sort === 'oldest'){
      cards.sort(function(a,b){
        var ta = new Date(a.getAttribute('data-ts')).getTime()||0;
        var tb = new Date(b.getAttribute('data-ts')).getTime()||0;
        return sort==='newest' ? tb - ta : ta - tb;
      });
    } else if (sort === 'platform'){
      cards.sort(function(a,b){
        var pa = (a.getAttribute('data-platform')||'').toLowerCase();
        var pb = (b.getAttribute('data-platform')||'').toLowerCase();
        if (pa < pb) return -1;
        if (pa > pb) return 1;
        return 0;
      });
    }

    cards.forEach(function(c){ grid.appendChild(c); });
    renderTimes();
    insertIcons();
  }

  var pf = document.getElementById('platformFilter');
  var ss = document.getElementById('sortSelect');
  if (pf) pf.addEventListener('change', applyFilterSort);
  if (ss) ss.addEventListener('change', applyFilterSort);

  var form = document.getElementById('appForm');
  if (form){
    form.addEventListener('submit', function(e){
      var name = form.querySelector('input[name="name"]').value.trim();
      var type = form.querySelector('select[name="type"]').value.trim();
      if (!name || !type){
        e.preventDefault();
        var msg = (lang && lang.indexOf('pl') === 0) ? 'Proszę wypełnić wymagane pola.' : 'Please fill required fields.';
        alert(msg);
      }
    });
  }

  insertIcons();
  renderTimes();
  applyFilterSort();
});