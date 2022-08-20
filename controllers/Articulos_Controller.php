<?php

class articulos_controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->message        = "";
        $this->view->resultadoLogin = "";
    }

    public function render()
    {
        $this->view->alumnos = "cargado";
        $this->view->render('login/index');
    }

    public function nuevo()
    {
        $this->view->alumnos = "cargado";
        $this->view->render('articulos/nuevo');
    }

    public function crear()
    {
        $this->view->lista = $this->model->listar();
        $this->view->render('articulos/crear');
    }

    public function listar()
    {
        $this->view->lista = $this->model->listar();
        $this->view->render('articulos/listar');
    }

}