document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("badge-compact");
  const btn = document.getElementById("toggle-badges");

  btn.addEventListener("click", () => {
    const exp = container.classList.toggle("expanded");
    btn.classList.toggle("expanded", exp);
    btn.querySelector("span").textContent = exp ? "Show less" : "Show more";
  });
});
