<?php

require_once 'entidades/UsuarioDto.php';

class Usuario_Model extends Model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function existe($id)
    {

        $pdo          = $this->db->connect();
        $user         = new UsuarioDto();
        $user->nombre = "";
        $user->uid    = "";

        try {
            $query = $pdo->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
            $query->bindParam(':id', $id);
            $resultado = $query->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
            if (count($resultado) > 0) {
                $user         = new UsuarioDto();
                $user->nombre = $resultado["nombre"]; // Me carga en "$user" los datos de mi usuario de mi sesión
                $user->uid    = $resultado["uid"];
            }

            return $user;

        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
    }
    
    
    public function articulosindex()
    {
        $pdo          = $this->db->connect();
        $items     = [];

        try {
            $query = $pdo->prepare('SELECT * FROM PRODUCTOS');
            $resultado = $query->execute();
            while ($resultado = $query->fetch()) {
                $items[] = $resultado;
            }
            return $items;

        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
    }



        /*
        $pdo = $this->db->connect();

        $articulos = new ArticuloDto();
        $articulos->pid = "";
        $articulos->nombre = "";
        $articulos->precio_venta = "";
        $articulos->precio_compra = "";
        $articulos->marca = "";
        $articulos->tipo = "";
        $articulos->cantidad = "";
        $articulos->img = "";
        $articulos->descrip = "";

        try {
            $query = $pdo->prepare('SELECT * FROM PRODUCTOS');
            $resultado = $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
                $articulos         = new ArticuloDto();
                $articulos->pid = $resultado["pid"];
                $articulos->nombre = $resultado["nombre"];
                $articulos->precio_venta = $resultado["precio_venta"];
                $articulos->precio_compra = $resultado["precio_compra"];
                $articulos->marca = $resultado["marca"];
                $articulos->tipo = $resultado["tipo"];
                $articulos->cantidad = $resultado["cantidad"];
                $articulos->img = $resultado["img"];
                $articulos->descrip = $resultado["descrip"];

            return $articulos;

        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }*/
    
}