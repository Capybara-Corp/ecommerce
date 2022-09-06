<?php
require_once 'entidades/articulo.php';

class articulos_controller extends controller
{
    public function __construct()
    {

        $cambio = "a eliminar";
        parent::__construct();
        $this->view->mensaje = "";
    }

    //http://localhost/prophp3bj/ecommerce/articulos
    public function render()
    {
        $articulos             = $this->model->get();
        $this->view->articulos = $articulos;
        $this->view->render('articulos/index');
    }

    public function ver_articulo($param = null)
    {
        $idarticulo = $param[0];
        $articulo   = $this->model->ver_articulo($idarticulo);

        $_SESSION["id_articulo"] = $idarticulo;

        $this->view->articulo = $articulo;
        $this->view->render('articulos/ver_articulo');
    }

    public function actualizar($param = null)
    {
        //var_dump($_POST);
        $resultado = true;
        try {
            $articulo              = new articulo();
            $articulo->id          = $_POST['articuloId'];
            $articulo->codigo      = $_POST['codigo'];
            $articulo->descripcion = $_POST['descripcion'];
            $articulo->fecha       = $_POST['fecha'];
            $precioSF              = $_POST['precio'];
            $precio                = floatval($precioSF);
            $articulo->precio      = number_format((float) $precio, 2, '.', '');
            $resultado             = $this->model->actualizar($articulo);
            $pathImg               = $_FILES['img']['tmp_name'];
            $tmpName               = $_FILES['img']['name'];
            $array                 = explode(".", $tmpName);
            $ext                   = $array[count($array) - 1];
            $ruta                  = 'public/imagenes/articulos/' . $articulo->id . "." . $ext;
            move_uploaded_file($pathImg, $ruta);
        } catch (\Throwable $th) {
            $resultado = false;
        }
        $this->view->respuesta = $resultado;
        $this->view->render('articulos/actualizar');
    }

    public function eliminarAlumno($param = null)
    {
        $matricula = $param[0];

        if ($this->model->delete($matricula)) {
            $mensaje = "Alumno eliminado correctamente";
            //$this->view->mensaje = "Alumno eliminado correctamente";
        } else {
            $mensaje = "No se pudo eliminar al alumno";
            //$this->view->mensaje = "No se pudo eliminar al alumno";
        }
        echo $mensaje;
    }

    public function listar($param = null)
    {

        //obtiene todos los articulos
        $articulos = $this->model->get();
        //lo asigna a la varible articulos
        $this->view->articulos = $articulos;
        //lista los articulos
        $this->view->render('articulos/listar');
        $arr = [];
    }

}