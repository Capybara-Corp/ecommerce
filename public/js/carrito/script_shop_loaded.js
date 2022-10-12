let urlBase02;

function conteo_manual() {
  let tot = document.getElementById("totalProductos");
  let totalProductos = tot.innerHTML;
  parseInt(totalProductos);
  for (i = 1; i <= totalProductos; i++) {
    precioIndividual[i - 1] = 0;
  }
}
function load_shop() {
  const market = document.querySelector(".celda_market");

  /*
  hacer esa funcion
  */
  //let urlcargarmercado = urlBase + "load_market.php";
  let urlcargarmercado = "/ecommerce/CargarArticulos/listar";
  fetch(urlcargarmercado)
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

      //cargo sistema de conteo
      conteo_manual();
    })
    .catch(function (err) {
      console.log(err);
    });
}

document.addEventListener("DOMContentLoaded", function (event) {
  carrito = document.querySelector("#carrito_content");
  urlBase02 = document.getElementById("urlBase").value;
  load_shop();
  console.log(urlBase02);
  //alert("cargo");
});
