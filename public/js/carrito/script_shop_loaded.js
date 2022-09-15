let urlBase02;
function load_shop() {
  const market = document.querySelector(".celda_market");

  /*
  hacer esa funcion
  */
  //let urlcargarmercado = urlBase + "load_market.php";
  let urlcargarmercado = urlBase02 + "CargarArticulos/listar";
  console.log("urlcargarmercado" + urlcargarmercado);

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
