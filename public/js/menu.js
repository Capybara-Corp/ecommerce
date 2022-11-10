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
  if (document.getElementById("editar")) {
    document.getElementById("editar").classList.toggle("hide");
    document.getElementById("title").classList.toggle("hide");
  }
  if (document.getElementById("gestionarh1")) {
    document.querySelector("form").classList.toggle("hide");
    document.getElementById("gestionarh1").classList.toggle("hide");
    document.getElementById("total").classList.toggle("hide");
    document.querySelector(".crear").classList.toggle("hide");
    document.querySelector("#main").classList.toggle("hide");
  }
  if (document.getElementById("welcomeadmin")) {
    document.querySelector("#welcomeadmin").classList.toggle("hide");
  }
});
