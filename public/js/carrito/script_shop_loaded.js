let urlBase;
function load_shop() {
  const market = document.querySelector(".celda_market");

  /*
  hacer esa funcion
  */
  let urlcargarmercado = urlBase + "load_market.php";

  fetch("load_market.php")
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (texto) {
      // market.innerHTML = " ";
      market.innerHTML = texto;
    })
    .catch(function (err) {
      console.log(err);
    });
}

document.addEventListener("DOMContentLoaded", function (event) {
  carrito = document.querySelector("#carrito_content");
  load_shop();
  let urlBase = document.getElementById("urlBase").value;
  console.log(urlBase);
  //alert("cargo");
});
