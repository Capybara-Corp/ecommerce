<?php

require_once 'models/Articulos_Model.php';
require_once 'models/Carrito_Model.php';

class CargarArticulos_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->message         = "";
        $this->view->resultado_login = "";
    }

    public function listar()
    {
        //$alumnos = $this->model->get();
        $model            = new Articulos_Model();
        $this->view->data = $model->listar();
        $this->view->render('cargararticulos/listar');
    }
    public function update()
    {
        //$alumnos = $this->model->get();
        $id       = $_POST['id'];
        $compra   = $_POST['cantidad'];
        $cantidad = 0;
        $model    = new Carrito_Model();
        $cantidad = $model->update($id, $compra);
        //$this->view->data = $model->listar();
        // $this->view->render('cargararticulos/update');
        if ($cantidad < 0) {
            echo "Stock Insuficiente";
        } else {
            echo "Compra realizada con exito.";
        }
    }


}