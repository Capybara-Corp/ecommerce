<?php

require_once 'models/Usuario_Model.php';
require_once 'entidades/UsuarioDto.php';

class Signup_Controller extends controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {

        $modelo           = new Usuario_Model();
        $modelo->signup($_POST['user_correo'], $_POST['user_pass'], $_POST['user_name'], $_POST['user_number'], $_POST['confirm_password']);
        $this->view->message = $message;


        $this->view->render('login/signup');
    }
}