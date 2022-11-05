const toggleMenuElement = document.getElementById("toggle-menu");
const mainMenuElement = document.getElementById("main-menu");

toggleMenuElement.addEventListener("click", () => {
  mainMenuElement.classList.toggle("main-menu--show");
  if (document.getElementById("buscadores")) {
    document.getElementById("buscadores").classList.toggle("hide");
    document.getElementById("contenedor_market").classList.toggle("hide");
  }
  if (document.getElementById("muro")) {
    document.getElementById("muro").classList.toggle("hide");
    document.getElementById("rosa").classList.toggle("hide");
  }
});
