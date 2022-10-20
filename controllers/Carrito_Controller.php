<?php

require_once 'models/Usuario_Model.php';
require_once 'entidades/UsuarioDto.php';

class Carrito_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //echo "Error al cargar el recurso";
    }

    public function market()
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

        $this->view->render('carrito/market');
    }

}