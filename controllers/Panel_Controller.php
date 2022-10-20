<?php

class Panel_Controller extends controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->view->message = "Hay un error al cargar el recurso";

        //echo "<p>Controlador Index</p>";
    }

    public function render()
    {
        $this->view->render('login/panel/index');
    }
    public function editar()
    {
        $this->view->render('login/panel/editarusuario');
    }
    public function editarperfil()
    {
        $this->view->render('login/panel/editarperfil');
    }
    public function producto()
    {
        $this->view->render('login/panel/editarproducto');
    }
    public function editarproducto()
    {
        $this->view->render('login/panel/modificarproducto');
    }

}