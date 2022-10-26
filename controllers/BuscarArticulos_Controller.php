<?php

require_once 'models/Articulos_Model.php';
require_once 'models/Carrito_Model.php';

class BuscarArticulos_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscar()
    {

        $buscStr = $_POST["buscar"] ?? "";
        $data    = $this->model->buscar($buscStr);

        foreach ($data as $row) {
            echo "<section style='background-image: url(../" . $row['img'] . ");background-size: 5vw, contain;background-repeat: no-repeat;background-position: left;background-position-x: 5vw;'><p class='nombre'>" . $row['nombre'] . "</p><p class='stock'>STOCK: " . $row['cantidad'] . "</p><p class='precio'>$" . $row['precio_venta'] . "</p><p class='descrip'>" . $row['descrip'] . "</p><p class='marca'>" . $row['marca'] . "</p><button onclick='carrito_charger(\"" . $row['pid'] . "\", \"" . $row['nombre'] . "\", \"" . $row['precio_venta'] . "\")'> <p>AÑADIR</button></section>";
        }

        //$this->view->render('cargararticulos/listar');

    }
}