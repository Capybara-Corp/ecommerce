<?php
require_once 'models/Usuario_Model.php';
require_once 'entidades/UsuarioDto.php';
require_once 'entidades/ArticuloDto.php';

class Index_Controller extends controller
{
    public function __construct()
    {
        parent::__construct();
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

        $articulo = new ArticuloDto();
        $articulo->pid = "";
        $articulo->nombre = "";
        $articulo->precio_venta = "";
        $articulo->img = "";
        
        $this->view->articulo = new ArticuloDto();

        $modelo           = new Usuario_Model();
        $items             = $modelo->articulosindex();
        $this->view->items = $items;


        $this->view->render('index/index');
    }
}