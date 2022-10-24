<?php

require_once 'models/Usuario_Model.php';
require_once 'entidades/UsuarioDto.php';

class Login_Controller extends controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {

        if (isset($_SESSION['uid'])) {
            header('Location: ../ecommerce');
        } else if (isset($_POST['user_correo']) && (isset($_POST['user_pass']))) {
            $modelo = new Usuario_Model();
            $modelo->login($_POST['user_correo'], $_POST['user_pass']);
            

            // Problemas retornando $message;

        }

        $this->view->render('login/login');
    }
}