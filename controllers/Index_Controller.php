<?php

class index_controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->view->message = "Hay un error al cargar el recurso";

        //echo "<p>Controlador Index</p>";
    }

    public function render()
    {
        $this->view->render('index/index');
    }

    public function saludo()
    {
        echo "<p>Hola a todos<p>";
    }
}