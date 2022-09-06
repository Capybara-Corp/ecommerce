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
            $archivocontroller = 'controllers/index_controller.php';
            require $archivocontroller;
            $controller = new index_controller();
            $controller->loadModel('index');
            $controller->render();
            return false;
        } else {
            $archivocontroller = 'controllers/' . ucfirst($url[0]) . '_controller.php';
        }

        //var_dump($archivocontroller);
        if (file_exists($archivocontroller)) {

            //var_dump($archivocontroller);
            require $archivocontroller;

            //var_dump($archivocontroller);
            $controllerName = ucfirst($url[0]) . '_controller';
            //var_dump($controllerName);
            //$controller = new $url[0]();
            $controller = new $controllerName();

            $controller->loadModel($url[0]);

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
                // si se llama a un controlador, por defecct
                //echo "<b>ejecuta el metodo por defecto</b>";
                //var_dump($controller);
                $controller->render();
            }
        } else {
            $controller = new errores_controller();
        }
    }
}
