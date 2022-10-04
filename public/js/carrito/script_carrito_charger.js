let map_productos_carrito = new Map();
let carrito;
let urlBase;
function carrito_charger(pid, nombre, precio) {
  if (map_productos_carrito.has(pid)) {
    //alert("Producto añadido al carrito");
    cant = map_productos_carrito.get(pid).cant + 1;
    precio = map_productos_carrito.get(pid).precio;
  } else {
    cant = 1;
  }
  map_productos_carrito.set(pid, {
    nombre: nombre,
    precio: precio,
    cant: cant,
  });
  refreshCarrito();
}

function clearoneoneCarrito(pid) {
  map_productos_carrito.delete(String(pid));
  refreshCarrito();
}

function refreshCarrito() {
  carrito.innerHTML = "<br><br>";
  for (const [k, v] of map_productos_carrito.entries()) {
    carrito.innerHTML +=
      "<p onclick='clearoneoneCarrito(" +
      k +
      ")'>producto: " +
      v.nombre +
      ". cantidad: " +
      v.cant +
      ". precio: " +
      v.precio * v.cant +
      "</p>";
  }
}

function generar_compra() {
  for (const [k, v] of map_productos_carrito.entries()) {
    fetch_async_compra(k, v.cant);
  }
}

function fetch_async_compra(pid, cant) {
  const data = new FormData();
  data.set("pid", pid);
  data.set("cantidad", cant);

  let urlupdateCarrito = "/ecommerce/CargarArticulos/listar";
  console.log("urlupdateCarrito " + urlupdateCarrito);

  fetch(urlupdateCarrito, {
    method: "POST",
    body: data,
  })
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (texto) {
      alert(texto);
      map_productos_carrito.clear();
      refreshCarrito();
      load_shop();
    })
    .catch(function (err) {
      console.log(err);
    });
}

document.addEventListener("DOMContentLoaded", function (event) {
  carrito = document.querySelector("#carrito_content");
  //alert("script02");
  let urlBase = document.getElementById("urlBase").value;
  console.log(urlBase);
});
