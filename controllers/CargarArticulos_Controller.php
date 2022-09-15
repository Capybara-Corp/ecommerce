<?php

class CargarArticulos_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->message         = "";
        $this->view->resultado_login = "";
    }

    //base+
    public function render()
    {
        //$alumnos = $this->model->get();
        $this->view->alumnos = "cargado";
        $this->view->render('login/index');
    }

    public function listar()
    {
        //$alumnos = $this->model->get();
        $model                 = new Articulos_Model();
        $this->view->articulos = $model->listar();
        $this->view->render('articulos/listar');
    }

}