<?php

require_once 'controllers/errores_controller.php';

class App
{
    public function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if (empty($url[0])) {
            $archivo_controller = 'controllers/index_controller.php';
            require $archivo_controller;
            $controller = new index_controller();
            $controller->load_model('index');
            $controller->render();
            return false;
        } else {
            $archivo_controller = 'controllers/' . ucfirst($url[0]) . '_Controller.php';
        }

        //var_dump($archivo_controller);
        if (file_exists($archivo_controller)) {

            //var_dump($archivo_controller);
            require $archivo_controller;

            //var_dump($archivo_controller);
            $controller_name = ucfirst($url[0]) . '_Controller';
            //var_dump($controller_name);
            //$controller = new $url[0]();
            $controller = new $controller_name();

            $controller->load_model($url[0]);

            // Se obtienen el número de param
            $nparam = sizeof($url);
            // si se llama a un método
            if ($nparam > 1) {
                // hay parámetros
                if ($nparam > 2) {
                    $param = [];
                    for ($i = 2; $i < $nparam; $i++) {
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                } else {
                    // solo se llama al método
                    $controller->{$url[1]}();
                }
            } else {
                // si se llama a un controlador, por defecto
                //echo "<b>ejecuta el metodo por defecto</b>";
                //var_dump($controller);
                $controller->render();
            }
        } else {
            $controller = new errores_controller();
        }
    }
}