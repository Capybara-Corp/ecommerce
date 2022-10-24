<?php

class Direcciones_Controller extends controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->view->message = "Hay un error al cargar el recurso";

        //echo "<p>Controlador Index</p>";
    }

    public function render()
    {
        $this->view->render('login/direcciones');
    }
}