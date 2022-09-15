let map_productos_carrito = new Map();
let carrito;
let urlBase;
function carrito_charger(id, nombre, precio) {
  if (map_productos_carrito.has(id)) {
    //alert("Producto añadido al carrito");
    cant = map_productos_carrito.get(id).cant + 1;
    precio = map_productos_carrito.get(id).precio;
  } else {
    cant = 1;
  }
  map_productos_carrito.set(id, {
    nombre: nombre,
    precio: precio,
    cant: cant,
  });
  refreshCarrito();
}

function clearoneoneCarrito(id) {
  map_productos_carrito.delete(String(id));
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

function fetch_async_compra(id, cant) {
  const data = new FormData();
  data.set("id", id);
  data.set("cantidad", cant);

  fetch("update_bd.php", {
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
