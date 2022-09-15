<?php

class Carrito_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //echo "Error al cargar el recurso";
    }

    public function market()
    {

        //$this->view->data = $this->model->market();
        $this->view->render('carrito/market');
    }

}