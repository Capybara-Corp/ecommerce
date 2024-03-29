<?php

#require_once 'entidades/alumno.php';
require_once 'entidades/ArticuloDto.php';

class Articulos_Model extends Model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function listar()
    {
        //define un arreglo en php
        //$items = array();
        $items     = [];
        $resultado = false;
        $pdo       = $this->db->connect();
        try {
            //$urlDefecto = "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17a3f093956%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17a3f093956%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22106.6640625%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E";
            //$urlDefecto = constant('URL') . 'public/imagenes/articulos/imagenDefecto.svg';
            $query = $pdo->query('SELECT * FROM PRODUCTOS');
            $query->execute();
            while ($row = $query->fetch()) {
                $item              = new ArticuloDto();
                $item->id_producto = $row['pid'];
                $item->img = $row['img'];
                $item->nombre      = $row['nombre'];
                $item->precio      = $row['precio_venta'];
                $item->descrip     = $row['descrip'];
                $item->marca = $row['marca'];
                $item->cantidad    = $row['cantidad'];
                //array_push($items, $item);
                $items[] = $item;

            } //end while

            return $items;
        } catch (PDOException $e) {
            return [];
        } finally {
            $pdo = null;
        }

    }

    public function verArticulo($id)
    {
        $articulo = null;
        try {
            $query = $this->db->connect()->prepare('SELECT pid, precio_venta, descrip, marca FROM PRODUCTOS WHERE pid=:id');
            $query->bindValue(':id', $id);
            //$query->execute(['nombre' => $nombre]);
            $query->execute();
            while ($row = $query->fetch()) {
                $articulo              = new Articulo();
                $articulo->id          = $row['pid'];
                //$articulo->codigo      = $row['codigo'];
                $articulo->descripcion = $row['descrip'];
                $articulo->precio      = $row['precio_venta'];
                $articulo->marca = $row['marca'];
                //$articulo->fecha       = $row['fecha'];
            }
        } catch (PDOException $e) {
            var_dump($e);
        }
        return $articulo;
    } //end ver

    public function actualizar($articulo)
    {

        $resultado = false;
        $pdo       = $this->db->connect();
        try {
            $query = $pdo->prepare('UPDATE PRODUCTOS SET precio_venta= :precio WHERE pid= :id');
            //$query->bindParam(':codigo', $articulo->codigo);
            //$query->bindParam(':descripcion', $articulo->descripcion);
            $query->bindParam(':precio', $articulo->precio);
            //$query->bindParam(':fecha', $articulo->fecha);
            $query->bindParam(':id', $articulo->id);
            //:descripcion, :precio, :fecha
            //$resultado = $query->execute();
            $resultado = $query->execute();
            $filasAf   = $query->rowCount();
            /*if ($filasAf == 0) {
            $resultado = false;
            }*/
            //$str = "valor";
            //$resultado = $query->fetch(); // return (PDOStatement) or false on failure
            //$query->close();
            return $resultado;
        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
    } //end actualizar

    /* public function crear($articulo)
    {

        $pdo = $this->db->connect();
        try {
            $query = $pdo->prepare('insert into productos
            (codigo, descripcion,precio, fecha)
            values (:codigo, :descripcion, :precio, :fecha)');
            $query->bindParam(':codigo', $articulo->codigo);
            $query->bindParam(':descripcion', $articulo->descripcion);
            $query->bindParam(':precio', $articulo->precio);
            $query->bindParam(':fecha', $articulo->fecha);
            //:descripcion, :precio, :fecha
            $lastInsertId = 0;
            if ($query->execute()) {
                $lastInsertId = $pdo->lastInsertId();
            } else {
                //Pueden haber errores, como clave duplicada
                $lastInsertId = -1;
                //echo $consulta->errorInfo()[2];
            }
            //$query->close();
            return $lastInsertId;
        } catch (PDOException $e) {
            return -1;
        } finally {
            $pdo = null;
        }
    } //end crear
    */

    public function eliminar($id)
    {

        $resultado = false;
        $pdo       = $this->db->connect();

        try {
            $query = $pdo->prepare('DELETE FROM PRODUCTOS WHERE pid= :id');
            $query->bindParam(':id', $id);
            //:descripcion, :precio, :fecha
            //$resultado = $query->execute();
            $resultado = $query->execute();
            $filasAf   = $query->rowCount();
            /*if ($filasAf == 0) {
            $resultado = false;
            }*/
            //$str = "valor";
            //$resultado = $query->fetch(); // return (PDOStatement) or false on failure
            //$query->close();
            return $resultado;
        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
    } //end eliminar

    /*
    public function search($search)
    {
        $articulo = null;
        $pdo      = $this->db->connect();

        try {
            $query = $pdo->prepare('SELECT codigo, descripcion FROM productos WHERE descripcion LIKE :textostr');
            // $query = '%' . $search . '%';
            $term = "%$search%";

            //$query
            //$query->bindParam(':textostr', '%' . $search . '%');
            $query->bindParam(':textostr', $term, PDO::PARAM_STR);
            //$query->execute(['nombre' => $nombre]);
            $query->execute();
            while ($row = $query->fetch()) {
                $articulo              = new Articulo();
                $articulo->codigo      = $row['codigo'];
                $articulo->descripcion = $row['descripcion'];

            }
        } catch (PDOException $e) {
            var_dump($e);
        } finally {
            $pdo = null;
        }
        return $articulo;
    } //end ver
    */

}