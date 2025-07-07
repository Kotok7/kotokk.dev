'use strict';

function runCode() {
  const codeInput = document.getElementById("codeInput");
  const codeOutput = document.getElementById("codeOutput");
  let output = "";
  const originalConsoleLog = console.log;

  console.log = (...args) => {
    output += args.join(" ") + "\n";
    originalConsoleLog(...args);
  };

  try {
    const result = eval(codeInput.value);
    if (result !== undefined) {
      output += result;
    }
  } catch (e) {
    output += e;
  } finally {
    console.log = originalConsoleLog;
    codeOutput.innerText = output;
  }
}

if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream) {
  document.body.style.animation = "none";
}

document.addEventListener("DOMContentLoaded", () => {
  gsap.registerPlugin(ScrollTrigger);
  gsap.timeline({ scrollTrigger: { trigger: "main", start: "top 80%" } })
    .from("header", { opacity: 0, y: -50, duration: 1 })
    .from(".fade-in", { opacity: 0, y: 50, duration: 0.5, stagger: 0.2 }, "-=0.5");

  const mainEl = document.querySelector("main");
  const scrollDown = document.getElementById("scroll-down");
  const themeToggle = document.getElementById("themeToggle");
  const titleElement = document.getElementById("title");

  if (scrollDown && mainEl) {
    scrollDown.addEventListener("click", () => {
      window.scrollTo({ top: mainEl.offsetTop, behavior: "smooth" });
    });
  }

  themeToggle.addEventListener("change", () => {
    const isDarkMode = themeToggle.checked;
    document.body.classList.toggle("dark-mode", isDarkMode);
    localStorage.setItem("theme-preference", isDarkMode ? "dark" : "light");
    localStorage.setItem("theme-timestamp", Date.now().toString());
  });

  const savedTheme = localStorage.getItem("theme-preference");
  const savedTime = localStorage.getItem("theme-timestamp");
  if (savedTheme && savedTime) {
    const timeElapsed = Date.now() - parseInt(savedTime, 10);
    if (timeElapsed < 1800000) {
      document.body.classList.toggle("dark-mode", savedTheme === "dark");
      themeToggle.checked = (savedTheme === "dark");
    } else {
      localStorage.removeItem("theme-preference");
      localStorage.removeItem("theme-timestamp");
      const hour = new Date().getHours();
      const isDark = (hour >= 22 || hour < 9);
      document.body.classList.toggle("dark-mode", isDark);
      themeToggle.checked = isDark;
    }
  } else {
    const hour = new Date().getHours();
    const isDark = (hour >= 22 || hour < 9);
    document.body.classList.toggle("dark-mode", isDark);
    themeToggle.checked = isDark;
  }

  const lang = document.documentElement.lang;
  const text = lang === "en" ? "Hi, I'm Kotokk" : "Cześć, jestem Kotokk";
  let i = 0;
  const type = () => {
    if (i < text.length) {
      titleElement.innerHTML += text.charAt(i++);
      setTimeout(type, 150);
    }
  };
  type();

  const scrollProgress = document.getElementById("scrollProgress");

  window.addEventListener("scroll", () => {
    requestAnimationFrame(() => {
      const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = (window.scrollY / docHeight) * 100;
      scrollProgress.style.width = `${scrolled}%`;
    });
  });
});

window.addEventListener("load", () => {
  setTimeout(() => {
    const loader = document.getElementById("loader");
    loader.style.animation = "fadeOut 1s forwards";
    setTimeout(() => {
      loader.style.display = "none";
      const content = document.getElementById("content");
      content.style.display = "block";
      void content.offsetWidth;
      content.style.opacity = "1";

      particlesJS("particles-js", {
        "particles": {
          "number": { "value": 50, "density": { "enable": true, "value_area": 800 } },
          "color": { "value": "#ffffff" },
          "shape": { "type": "circle" },
          "opacity": { "value": 0.5 },
          "size": { "value": 3, "random": true },
          "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 },
          "move": { "enable": true, "speed": 2, "direction": "none", "out_mode": "out" }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": { "enable": true, "mode": "grab" },
            "onclick": { "enable": true, "mode": "push" },
            "resize": true
          },
          "modes": {
            "grab": { "distance": 140, "line_linked": { "opacity": 1 } },
            "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8 },
            "repulse": { "distance": 200, "duration": 0.4 },
            "push": { "particles_nb": 4 },
            "remove": { "particles_nb": 2 }
          }
        },
        "retina_detect": true
      });

      gsap.to(".popup-content", { duration: 1, opacity: 1, scale: 1, ease: "back.out(1.7)" });
      document.getElementById("closePopup").addEventListener("click", () => {
        gsap.to("#popup", {
          duration: 0.5,
          opacity: 0,
          ease: "power1.out",
          onComplete: () => {
            document.getElementById("popup").style.display = "none";
          }
        });
      });
    }, 1000);
  }, 1000);
});