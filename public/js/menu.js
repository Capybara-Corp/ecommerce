const toggleMenuElement = document.getElementById("toggle-menu");
const mainMenuElement = document.getElementById("main-menu");

toggleMenuElement.addEventListener("click", () => {
  mainMenuElement.classList.toggle("main-menu--show");
  document.getElementById("buscadores").classList.toggle("hide");
  document.getElementById("contenedor_market").classList.toggle("hide");
});
