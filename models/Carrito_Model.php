<?php

#require_once 'entidades/alumno.php';
/* require_once 'entidades/ArticuloDto.php'; */

class Carrito_Model extends Model
{

    /*public function __construct()
    {

        parent::__construct();
    }

    public function market()
    {
        //define un arreglo en php
        //$items = array();
        $items = [];
        try {
            //$urlDefecto = "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17a3f093956%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17a3f093956%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22106.6640625%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E";
            $urlDefecto = constant('URL') . 'public/imagenes/articulos/imagenDefecto.svg';
            $query      = $this->db->connect()->query('SELECT pid, precio_venta, descrip, marca FROM PRODUCTOS');
            while ($row = $query->fetch()) {
                $item              = new ArticuloDto();
                $item->pid          = $row['pid'];
                //$item->codigo      = $row['codigo'];
                $item->descripcion = $row['descrip'];
                $item->precio      = $row['precio_venta'];
                $item->marca = $row['marca'];
                //$item->fecha       = $row['fecha'];
                //$item->url = isset($row['url']) ? $row['url'] : $urlDefecto;
                if (isset($row['url'])) {
                    $item->url = $row['url'];
                } else {
                    $item->url = $urlDefecto;
                }
                //$item->url = isset($row['url']) ? $row['url'] : $urlDefecto;
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }*/

    /*public function update($pid, $cantidad)
    {
        //define un arreglo en php
        //$items = array();
        $items     = [];
        $resultado = false;
        $pdo       = $this->db->connect();
        try {
            //$urlDefecto = "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17a3f093956%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17a3f093956%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22106.6640625%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E";
            //$urlDefecto = constant('URL') . 'public/imagenes/articulos/imagenDefecto.svg';
            $cantidad = 0;
            $query    = $pdo->query('SELECT * FROM PRODUCTOS');
            $query->execute();
            while ($row = $query->fetch()) {
                if (strcmp($row['pid'], $pid) == 0) {
                    $cantidad = $row['cantidad'];
                    $cantidad = $cantidad - $compra;
                }
                //array_push($items, $item);
            } //end while


            if ($cantidad < 0) {
                echo "Stock Insuficiente";
                # code...
            } else {
                // PARA ACÁ YA NO ENTRA
                $query = $pdo->query('UPDATE PRODUCTOS SET cantidad=:cantidad WHERE pid=:pid');
                $query->bindParam(':cantidad', $articulo->codigo);
                $query->bindParam(':pid', $pid);
                $query->execute();
                //$conn->prepare($sql)->execute([$cantidad, $id]);
                echo "Compra realizada con exito.";
            }
            return $cantidad;
        } catch (PDOException $e) {
            return [];
        } finally {
            $pdo = null;
        }
    }*/
}