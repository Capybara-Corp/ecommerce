<?php

//require_once 'config/config.php';

/*manejo de ccookies */
//var_dump(constant('URL'));

class Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new View();
        session_start();
        //echo "<p>Controlador principal</p>";
    }

    //carga el modelo si existe
    public function load_model($model)
    {
        //var_dump($this);

        $url = 'models/' . ucfirst($model) . '_model.php';
        //$url = 'models/' . ucfirst($model) . '_model.php';
        //var_dump($url);

        if (file_exists($url)) {
            require $url;

            $modelName   = ucfirst($model) . '_model';
            $this->model = new $modelName();
        }
    }
}