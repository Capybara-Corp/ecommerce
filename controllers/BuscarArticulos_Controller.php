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
        if($buscStr == 'pacman'){
            echo '<a style="width: 20vw; height: 20vw;" href="../public/media/PacMan/index.html"><img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Pacman_HD.png"></a>';
        }
        $data    = $this->model->buscar($buscStr);

        

        foreach ($data as $row) {
            //$var += 1;
            echo "<section style='background-image: url(../$row->img);
    background-size: 5vw, contain;
    background-repeat: no-repeat;
    background-position: left;
    background-position-x: 5vw;'
    ><p class='nombre'>" . $row->nombre . "</p><p class='stock'>STOCK: " . $row->cantidad . "</p><p class='precio'>$" . $row->precio . "</p><p class='descrip'>" . $row->descrip . "</p><p class='marca'>" . $row->marca . "</p><button onclick='carrito_charger
    (\"" . $row->id_producto . "\", \"" . $row->nombre . "\", \"" . $row->precio . "\")'> <p>AÑADIR</button></section>";
        }

        /*foreach ($data as $row) {
        echo "<section style='background-image: url(../" . $row['img'] . ");background-size: 5vw, contain;background-repeat: no-repeat;background-position: left;background-position-x: 5vw;'><p class='nombre'>" . $row['nombre'] . "</p><p class='stock'>STOCK: " . $row['cantidad'] . "</p><p class='precio'>$" . $row['precio_venta'] . "</p><p class='descrip'>" . $row['descrip'] . "</p><p class='marca'>" . $row['marca'] . "</p><button onclick='carrito_charger(\"" . $row['pid'] . "\", \"" . $row['nombre'] . "\", \"" . $row['precio_venta'] . "\")'> <p>AÑADIR</button></section>";
        }*/

        //$this->view->render('cargararticulos/listar');

    }
    public function mayoramenor()
    {


        $data    = $this->model->mayoramenor($buscStr);


        foreach ($data as $row) {
            //$var += 1;
            echo "<section style='background-image: url(../$row->img);
    background-size: 5vw, contain;
    background-repeat: no-repeat;
    background-position: left;
    background-position-x: 5vw;'
    ><p class='nombre'>" . $row->nombre . "</p><p class='stock'>STOCK: " . $row->cantidad . "</p><p class='precio'>$" . $row->precio . "</p><p class='descrip'>" . $row->descrip . "</p><p class='marca'>" . $row->marca . "</p><button onclick='carrito_charger
    (\"" . $row->id_producto . "\", \"" . $row->nombre . "\", \"" . $row->precio . "\")'> <p>AÑADIR</button></section>";
        }

        /*foreach ($data as $row) {
        echo "<section style='background-image: url(../" . $row['img'] . ");background-size: 5vw, contain;background-repeat: no-repeat;background-position: left;background-position-x: 5vw;'><p class='nombre'>" . $row['nombre'] . "</p><p class='stock'>STOCK: " . $row['cantidad'] . "</p><p class='precio'>$" . $row['precio_venta'] . "</p><p class='descrip'>" . $row['descrip'] . "</p><p class='marca'>" . $row['marca'] . "</p><button onclick='carrito_charger(\"" . $row['pid'] . "\", \"" . $row['nombre'] . "\", \"" . $row['precio_venta'] . "\")'> <p>AÑADIR</button></section>";
        }*/

        //$this->view->render('cargararticulos/listar');

    }
}