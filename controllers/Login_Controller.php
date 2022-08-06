<?php
/*require_once 'vendor/autoload.php';
require_once 'auth/Auth.php';*/

class Login_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->mensaje        = "";
        $this->view->resultadoLogin = "";
    }

    //base+login
    public function render()
    {
        //$alumnos = $this->model->get();
        $this->view->alumnos = "cargado";
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

        //rendeizar el formulario
        $this->view->render('login/signin');

    }
    public function sign()
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
            $this->view->mensaje = "error al ingresar";
        }
        /*recibir los datos*/

        //rendeizar el formulario

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $records = $connection->prepare('SELECT id, email, password FROM users WHERE email = :email');
            $records->bindParam(':email', $_POST['email']);
            $records->execute(); //Se ejecuta la conexión
            $results = $records->fetch(PDO::FETCH_ASSOC); //Se obtiene el resultado de la consulta
            $message = '';
            if (is_countable($results) > 0 && password_verify($_POST['password'], $results['password'])) { //Si el usuario existe y la contraseña es correcta
                session_start(); //Se inicia la sesión
                $_SESSION['user_id'] = $results['id']; //Se guarda el id del usuario en la sesión
                header("Location: index.php"); //Se redirecciona a la página principal
            } else { //Si el usuario no existe o la contraseña es incorrecta
                $message = 'Lo sentimos, tu email o contraseña no son correctos.'; //Se muestra un mensaje de error
            }
        }

        $this->view->render('login/sign');

    }
}