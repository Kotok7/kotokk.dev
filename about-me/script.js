const createCodeParticles = () => {
  const showAlertOnce = () => {
    if (!localStorage.getItem('alertShown')) {
      alert('This website is in beta and may not function fully as expected. A Polish version is coming soon');
      localStorage.setItem('alertShown', 'true');
    }
  };

  const setupCursor = () => {
    const cursor = document.querySelector('.cursor');
    if (!cursor) return;
    let mouseX = 0, mouseY = 0;
    const updateCursor = () => {
      cursor.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;
    };
    window.addEventListener('mousemove', e => {
      mouseX = e.clientX; mouseY = e.clientY;
      updateCursor();
    });
    ['scroll','resize'].forEach(ev =>
      window.addEventListener(ev, updateCursor)
    );
    document.querySelectorAll('a').forEach(link => {
      link.addEventListener('mouseenter', () => cursor.classList.add('hover'));
      link.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
    });
  };

  const setupScrollProgress = () => {
    const progress = document.querySelector('.scroll-progress');
    if (!progress) return;
    const update = () => {
      const top = window.pageYOffset;
      const height = document.documentElement.scrollHeight - window.innerHeight;
      progress.style.width = height > 0 ? (top/height)*100 + '%' : '0%';
    };
    window.addEventListener('scroll', update);
    window.addEventListener('resize', update);
    update();
  };

  const setupIntersectionAnimations = () => {
    const items = document.querySelectorAll('.fade-in-up, .slide-in-left, .slide-in-right');
    if (!items.length) return;
    const obs = new IntersectionObserver((entries, o) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          o.unobserve(e.target);
        }
      });
    }, { threshold: 0.1 });
    items.forEach(el => obs.observe(el));
  };

  const setupSmoothNav = () => {
    document.querySelectorAll('.nav a[href^="#"]').forEach(a => {
      a.addEventListener('click', function(e) {
        e.preventDefault();
        const tgt = document.querySelector(this.getAttribute('href'));
        if (tgt) tgt.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  };

  const setupParallax = () => {
    const bg = document.querySelector('.parallax-bg');
    if (!bg) return;
    const update = () => {
      bg.style.transform = `translateY(${window.pageYOffset * 0.5}px)`;
    };
    window.addEventListener('scroll', update);
    window.addEventListener('resize', update);
    update();
  };

  const setupLoadClass = () => {
    window.addEventListener('load', () => {
      document.body.classList.add('loaded');
    });
  };

  const setupGlitchEffect = () => {
    const els = document.querySelectorAll('.glitch');
    if (!els.length) return;
    setInterval(() => {
      els.forEach(el => {
        if (Math.random() > 0.95) {
          el.classList.remove('glitch-active');
          void el.offsetWidth;
          el.classList.add('glitch-active');
        }
      });
    }, 3000);
  };

  const setupNavToggle = () => {
    const btn  = document.querySelector('.nav-toggle');
    const menu = document.querySelector('.nav-menu');
    if (!btn || !menu) return;
    btn.addEventListener('click', () => {
      const opened = menu.classList.toggle('show');
      btn.setAttribute('aria-label', opened ? 'Close menu' : 'Open menu');
    });
  };

  showAlertOnce();
  setupCursor();
  setupScrollProgress();
  setupIntersectionAnimations();
  setupSmoothNav();
  setupParallax();
  setupLoadClass();
  setupGlitchEffect();
  setupNavToggle();
};

document.addEventListener('DOMContentLoaded', createCodeParticles);