let map_productos_carrito = new Map();
let carrito;
let urlBase;
let sum = 0;
let precioTotal = 0;

function carrito_charger(pid, nombre, precio) {
  precioIndividual = Array.from(precioIndividual, (item) =>
    typeof item === "undefined" ? 0 : item
  );
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
  precioIndividual[pid - 1] = 0;
  for (let i = 0; i < precioIndividual.length; i++) {
    sum += precioIndividual[i];
    if (precioIndividual[i - 1] == 0) {
      console.log("its me, " + precioIndividual[i - 1]);
      sum = 0;
      precioTotal = sum;
    }
  }
  console.log("esto es sum " + sum);
  console.log(precioIndividual);
  refreshCarrito();
  precioTotal = sum;
}

function refreshCarrito() {
  carrito.innerHTML = "";
  for (const [k, v] of map_productos_carrito.entries()) {
    carrito.innerHTML +=
      "<p onclick='clearoneoneCarrito(" +
      k +
      ")'>" +
      v.nombre +
      ", " +
      v.cant +
      " unidades" +
      ", $" +
      (precioIndividual[k - 1] = v.precio * v.cant);
    precioIndividual + "</p>";

    sum = 0;
    for (let i = 0; i < precioIndividual.length; i++) {
      sum += precioIndividual[i];
    }

    console.log("esto es sum " + sum);
    precioTotal = sum;

    console.log(precioIndividual);
  }
  document.getElementById("total").innerHTML = "$" + precioTotal;
}

function generar_compra() {
  if (sum > 0) {
    fetch_async_void_venta();
  } else {
    alert("Debes seleccionar un producto");
  }
}

function fetch_async_void_venta() {
  const data3 = new FormData();
  data3.set("sum", sum);

  fetch("/ecommerce/controllers/GenerarVentaVoid_Controller.php", {
    method: "POST",
    body: data3,
  })
    .then(function (response) {
      //alert('esto funciona');
      if (response.ok) {
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (texto) {
      //alert('esto funciona');
      for (const [k, v] of map_productos_carrito.entries()) {
        //alert('esto funciona');
        fetch_async_compra(k, v.cant);
      }
      fetch_async_venta();

      load_shop();
      window.location.href = "market";
      //alert('esto funciona');
    })
    .catch(function (err) {
      console.log(err);
    });
}

function fetch_async_compra(pid, cant) {
  //alert('esto funciona');

  const data = new FormData();
  data.set("pid", pid);
  data.set("cantidad", cant);

  let urlupdateCarrito = "/ecommerce/models/Carrito_Model.php";
  //console.log("urlupdateCarrito " + urlupdateCarrito);

  fetch("/ecommerce/controllers/UpdateProductos_Controller.php", {
    method: "POST",
    body: data,
  })
    .then(function (response) {
      //alert('esto funciona');
      if (response.ok) {
        //alert('esto funciona');
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (texto) {
      //alert('esto funciona');
      if (texto == "Stock Insuficiente") {
        alert(texto);
      }

      map_productos_carrito.clear();
      refreshCarrito();
      for (let i = 0; i < precioIndividual.length; i++) {
        precioIndividual[i] = 0;
      }
      sum = 0;
      precioTotal = sum;
      console.log("i am your father " + precioTotal);
      console.log("precio individual " + precioIndividual);
      document.getElementById("total").innerHTML = "$" + precioTotal;
      load_shop();
      window.location.href = "market";
      //alert('esto funciona');
    })
    .catch(function (err) {
      console.log(err);
    });
}

function fetch_async_venta() {
  const data2 = new FormData();
  data2.set("sum", sum);

  fetch("/ecommerce/controllers/GenerarVenta_Controller.php", {
    method: "POST",
    body: data2,
  })
    .then(function (response) {
      //alert('esto funciona');
      if (response.ok) {
        return response.text();
      } else {
        throw "Error";
      }
    })
    .then(function (texto) {
      //alert('esto funciona');
      if (texto != "") {
        alert(texto);
      }
      load_shop();
      window.location.href = "market";
      //alert('esto funciona');
    })
    .catch(function (err) {
      console.log(err);
    });
}

document.addEventListener("DOMContentLoaded", function (event) {
  carrito = document.querySelector("#carrito_content");
  //alert("script02");
});
