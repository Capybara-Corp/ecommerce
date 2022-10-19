<?php

require_once 'models/Usuario_Model.php';
require_once 'entidades/UsuarioDto.php';

class Nosotros_Controller extends controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->view->message = "Hay un error al cargar el recurso";

        //echo "<p>Controlador Index</p>";
    }

    public function render()
    {

        $user         = new UsuarioDto();
        $user->nombre = "";
        $user->uid    = "";

        $this->view->user = new UsuarioDto();

        if (isset($_SESSION['uid'])) {
            $modelo           = new Usuario_Model();
            $user             = $modelo->existe($_SESSION['uid']);
            $this->view->user = $user;
        }

        $this->view->render('index/nosotros');
    }
}