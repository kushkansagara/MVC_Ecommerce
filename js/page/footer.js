const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const navbarMenu = document.getElementById("navbarMenu");

mobileMenuBtn.addEventListener("click", () => {
  navbarMenu.classList.toggle("active");
  mobileMenuBtn.innerHTML = navbarMenu.classList.contains("active")
    ? '<i class="fas fa-times"></i>'
    : '<i class="fas fa-bars"></i>';
});

const scrollTop = document.getElementById("scrollTop");

window.addEventListener("scroll", () => {
  if (window.scrollY > 300) {
    scrollTop.classList.add("visible");
  } else {
    scrollTop.classList.remove("visible");
  }
});

scrollTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});
