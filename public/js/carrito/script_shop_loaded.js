let urlBase02;

function conteo_manual() {
  let tot = document.getElementById("totalProductos");
  let totalProductos = tot.innerHTML;
  parseInt(totalProductos);
  for (i = 1; i <= totalProductos; i++) {
    precioIndividual[i - 1] = 0;
  }
}

function recibirget(){
  let num1 = document.getElementById('get1');
  let num2 = document.getElementById('get2');
  let num3 = document.getElementById('get3');
  let get1 = num1.innerHTML;
  let get2 = num2.innerHTML;
  let get3 = num3.innerHTML;
  return get1, get2, get3;
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


      recibirget();
      carrito_charger(get1.innerHTML, get2.innerHTML, get3.innerHTML);



    })
    .catch(function (err) {
      console.log(err);
    });
}

document.addEventListener("DOMContentLoaded", function (event) {
  carrito = document.querySelector("#carrito_content");
  load_shop();
  //alert("cargo");
});
