window.addEventListener('load', () => {
  const canvas = document.getElementById('board');
  const ctx = canvas.getContext('2d', { alpha: true });
  const colorInput = document.getElementById('color');
  const sizeInput = document.getElementById('size');
  const penBtn = document.getElementById('penBtn');
  const eraserBtn = document.getElementById('eraserBtn');
  const statusEl = document.getElementById('status');
  const newCountEl = document.getElementById('newCount');
  const zoomInput = document.getElementById('zoom');
  const zoomVal = document.getElementById('zoomVal');

  const MIN_SIZE = 0.5;
  const MAX_SIZE = 18;

  let viewScale = parseFloat(zoomInput?.value) || 0.5;
  if (zoomVal) zoomVal.textContent = Math.round(viewScale * 100) + '%';

  let drawing = false;
  let currentStroke = null;
  let lastIndex = 0;
  let pollingInterval = 700;
  let activeTool = 'pen';
  let lastPos = null;

  let strokesCache = [];

  if (penBtn) penBtn.classList.add('active');

  if (penBtn) penBtn.addEventListener('click', () => {
    activeTool = 'pen';
    penBtn.classList.add('active');
    if (eraserBtn) eraserBtn.classList.remove('active');
  });
  if (eraserBtn) eraserBtn.addEventListener('click', () => {
    activeTool = 'eraser';
    eraserBtn.classList.add('active');
    if (penBtn) penBtn.classList.remove('active');
  });

  function clampSize(v) {
    const n = parseFloat(v) || 0;
    return Math.max(MIN_SIZE, Math.min(MAX_SIZE, n));
  }

  function setupCanvas() {
    const ratio = window.devicePixelRatio || 1;
    let cssW = canvas.clientWidth || parseInt(getComputedStyle(canvas).width, 10) || 800;
    let cssH = canvas.clientHeight || parseInt(getComputedStyle(canvas).height, 10) || 600;
    if (!cssH || cssH === 0) {
      const controls = document.querySelector('.controls');
      const info = document.querySelector('.info');
      const ctrH = controls ? Math.ceil(controls.getBoundingClientRect().height) : 0;
      const infoH = info ? Math.ceil(info.getBoundingClientRect().height) : 0;
      cssH = Math.max(320, window.innerHeight - ctrH - infoH - 40);
    }
    cssW = Math.max(200, cssW);
    cssH = Math.max(200, cssH);

    canvas.width = Math.round(cssW * ratio);
    canvas.height = Math.round(cssH * ratio);
    canvas.style.width = cssW + 'px';
    canvas.style.height = cssH + 'px';

    ctx.save();
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.restore();

    const scale = viewScale;
    const offsetX = (cssW - cssW * scale) / 2;
    const offsetY = (cssH - cssH * scale) / 2;

    ctx.setTransform(ratio * scale, 0, 0, ratio * scale, Math.round(offsetX * ratio), Math.round(offsetY * ratio));
    ctx.lineJoin = 'round';
    ctx.lineCap = 'round';
  }

  let resizeTimer = null;
  function onResize() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      setupCanvas();
      redrawAll();
    }, 150);
  }
  setupCanvas();
  window.addEventListener('resize', onResize);

  canvas.style.touchAction = 'none';

  function getPosFromEvent(e) {
    const rect = canvas.getBoundingClientRect();
    const cssW = rect.width;
    const cssH = rect.height;
    const scale = viewScale;
    const offsetX = (cssW - cssW * scale) / 2;
    const offsetY = (cssH - cssH * scale) / 2;
    const x = (e.clientX - rect.left - offsetX) / scale;
    const y = (e.clientY - rect.top - offsetY) / scale;
    return [x, y];
  }

  function drawSegment(a, b, tool, color, size) {
    if (!a || !b) return;
    const w = clampSize(size);
    if (tool === 'eraser') {
      ctx.save();
      ctx.globalCompositeOperation = 'destination-out';
      ctx.beginPath();
      ctx.lineWidth = w;
      ctx.moveTo(a[0], a[1]);
      ctx.lineTo(b[0], b[1]);
      ctx.stroke();
      ctx.restore();
    } else {
      ctx.save();
      ctx.globalCompositeOperation = 'source-over';
      ctx.strokeStyle = color || '#000';
      ctx.beginPath();
      ctx.lineWidth = w;
      ctx.moveTo(a[0], a[1]);
      ctx.lineTo(b[0], b[1]);
      ctx.stroke();
      ctx.restore();
    }
  }

  function drawSmooth(points, tool, color, size) {
    if (!points || points.length < 2) return;
    const w = clampSize(size);
    ctx.save();
    ctx.globalCompositeOperation = tool === 'eraser' ? 'destination-out' : 'source-over';
    ctx.strokeStyle = color || '#000';
    ctx.lineWidth = w;
    if (points.length === 2) {
      ctx.beginPath();
      ctx.moveTo(points[0][0], points[0][1]);
      ctx.lineTo(points[1][0], points[1][1]);
      ctx.stroke();
    } else {
      ctx.beginPath();
      ctx.moveTo(points[0][0], points[0][1]);
      for (let i = 1; i < points.length - 1; i++) {
        const midX = (points[i][0] + points[i + 1][0]) / 2;
        const midY = (points[i][1] + points[i + 1][1]) / 2;
        ctx.quadraticCurveTo(points[i][0], points[i][1], midX, midY);
      }
      const last = points[points.length - 1];
      ctx.lineTo(last[0], last[1]);
      ctx.stroke();
    }
    ctx.restore();
  }

  function drawStroke(stroke) {
    if (!stroke || !Array.isArray(stroke.points) || stroke.points.length < 2) return;
    const s = Object.assign({}, stroke);
    s.size = clampSize(s.size);
    drawSmooth(s.points, s.tool || 'pen', s.color || '#000', s.size);
  }

  function redrawAll() {
    ctx.save();
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.restore();

    setupCanvas();

    if (Array.isArray(strokesCache)) {
      strokesCache.forEach(s => drawStroke(s));
    }
  }

  function pointerDown(e) {
    if (e.button && e.button !== 0) return;
    e.preventDefault();
    try { canvas.setPointerCapture(e.pointerId); } catch (err) {}
    drawing = true;
    const p = getPosFromEvent(e);
    lastPos = p;
    currentStroke = {
      points: [p],
      color: colorInput ? colorInput.value : '#000',
      size: sizeInput ? clampSize(sizeInput.value) : clampSize(6),
      tool: activeTool,
      ts: Date.now()
    };
  }

  function pointerMove(e) {
    if (!drawing || !currentStroke) return;
    e.preventDefault();
    const p = getPosFromEvent(e);
    if (lastPos) drawSegment(lastPos, p, currentStroke.tool, currentStroke.color, currentStroke.size);
    currentStroke.points.push(p);
    lastPos = p;
  }

  function pointerUp(e) {
    if (!drawing) return;
    drawing = false;
    try { canvas.releasePointerCapture && canvas.releasePointerCapture(e.pointerId); } catch (err) {}
    if (currentStroke && currentStroke.points.length > 1) {
      drawStroke(currentStroke);
      strokesCache.push(currentStroke);
      sendStroke(currentStroke);
    }
    currentStroke = null;
    lastPos = null;
  }

  canvas.addEventListener('pointerdown', pointerDown);
  canvas.addEventListener('pointermove', pointerMove);
  canvas.addEventListener('pointerup', pointerUp);
  canvas.addEventListener('pointercancel', pointerUp);
  window.addEventListener('pointerup', pointerUp);

  async function sendStroke(stroke) {
    try {
      const payload = Object.assign({}, stroke);
      payload.size = clampSize(payload.size);
      const r = await fetch('save.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ stroke: payload })
      });
      if (r.ok) {
        const j = await r.json();
        if (j && typeof j.total === 'number') lastIndex = j.total;
      }
    } catch (e) {
      console.warn('send error', e);
    }
  }

  async function initialLoad() {
    try {
      const r = await fetch('load.php?after=0', { cache: 'no-store' });
      if (!r.ok) throw new Error('http ' + r.status);
      const j = await r.json();
      if (Array.isArray(j.strokes)) {
        strokesCache = j.strokes;
        lastIndex = j.total || j.strokes.length || 0;
        redrawAll();
      }
      if (statusEl) {
        statusEl.textContent = 'OK';
        statusEl.classList.add('connected');
      }
    } catch (e) {
      if (statusEl) {
        statusEl.textContent = 'ERR';
        statusEl.classList.remove('connected');
      }
      console.warn(e);
    }
  }

  async function poll() {
    try {
      const r = await fetch(`load.php?after=${lastIndex}`, { cache: 'no-store' });
      if (!r.ok) throw new Error('http ' + r.status);
      const j = await r.json();
      if (Array.isArray(j.strokes) && j.strokes.length > 0) {
        j.strokes.forEach(s => {
          strokesCache.push(s);
          drawStroke(s);
        });
        lastIndex = j.total;
      } else {
        if (typeof j.total === 'number' && j.total < lastIndex) {
          lastIndex = j.total;
          await initialLoad();
        }
      }
      if (statusEl) {
        statusEl.textContent = 'OK';
        statusEl.classList.add('connected');
      }
      if (newCountEl) newCountEl.textContent = (j.strokes && j.strokes.length) || 0;
    } catch (e) {
      if (statusEl) {
        statusEl.textContent = 'ERR';
        statusEl.classList.remove('connected');
      }
      console.warn(e);
    }
  }

  if (zoomInput) {
    zoomInput.addEventListener('input', (ev) => {
      viewScale = parseFloat(ev.target.value) || viewScale;
      if (zoomVal) zoomVal.textContent = Math.round(viewScale * 100) + '%';
      setupCanvas();
      redrawAll();
    });
  }

  canvas.addEventListener('wheel', (e) => {
    if (!e.ctrlKey) return;
    e.preventDefault();
    const step = 0.05;
    const delta = e.deltaY > 0 ? -step : step;
    const min = parseFloat(zoomInput?.min) || 0.2;
    const max = parseFloat(zoomInput?.max) || 3;
    viewScale = Math.min(max, Math.max(min, viewScale + delta));
    if (zoomInput) zoomInput.value = viewScale;
    if (zoomVal) zoomVal.textContent = Math.round(viewScale * 100) + '%';
    setupCanvas();
    redrawAll();
  }, { passive: false });

  initialLoad();
  setInterval(poll, pollingInterval);
});