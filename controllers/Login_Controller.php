<?php
/*require_once 'vendor/autoload.php';
require_once 'auth/Auth.php';*/

class login_controller extends controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->message        = "";
        $this->view->resultadoLogin = "";
    }

    public function render()
    {
        $this->view->render('login/index');
    }

    public function ingresar()
    {
        try {
            if (!isset($_POST['email'])) {
                throw new Exception();
            }
            if (!isset($_POST['password'])) {
                throw new Exception();
            }
            $email     = trim($_POST['email']);
            $pass      = trim($_POST['password']);
            $resultado = $this->model->sign($email, $pass);
            //code...
        } catch (Exception $e) {
            //throw $th;
            $this->view->message = "error al ingresar";
        }
        /*recibir los datos*/

        //renderizar el formulario
        $this->view->render('login/sign');

    }

    public function salir()
    {
        //$_SESSION["estalogueado"] = false;
        unset($_SESSION["estalogueado"]);
        unset($_SESSION["nombre"]);
        session_destroy();
        $this->view->render('index/index');

    }

    public function signin()
    {

        //renderizar el formulario
        $this->view->render('login/signin');

    }
}