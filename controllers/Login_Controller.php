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

    //base+login
    public function render()
    {
        //$alumnos = $this->model->get();
        //$this->view->alumnos = "cargado";
        $this->view->render('login/index');
    }

    public function ingresar()
    {
        $nombre     = $_POST['nombre'];
        $pass       = $_POST['pass'];
        $exitoLogin = $this->model->ingresar($nombre, $pass);
        if ($exitoLogin) {
            $token = Auth::SignIn([
                'id' => 1,
                'name' => $nombre,
                'role' => 'cliente',
            ]);
            $this->view->token        = $token;
            $_SESSION["estalogueado"] = true;
            $_SESSION["nombre"]       = $nombre;
            $_SESSION["rol"]          = "cliente";
            $this->view->render('login/ingresar');
        } else {
            $this->view->resultadoLogin = "usuario o contraseña incorrectos";
            $this->view->render('login/index');
        }

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
    public function sign()
    {
        /*recibir los datos*/
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

        $this->view->render('login/sign'); //renderizar el formulario

    }
}