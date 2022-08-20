<?php

class errores_controller extends controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->message = "Hay un error al cargar el recurso";
        $this->view->render('errores/index');
        //echo "Error al cargar el recurso";
    }
}