<?php

class Login_Model extends model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {
        //define un arreglo en php
        //$items = array();
        $items = [];
        try {
            //$urlDefecto = "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17a3f093956%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17a3f093956%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22106.6640625%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E";
            $urlDefecto = constant('URL') . 'public/imagenes/articulos/imagenDefecto.svg';
            $query      = $this->db->connect()->query('SELECT id_productos, codigo,descripcion,precio,fecha FROM productos');
            while ($row = $query->fetch()) {
                $item              = new Articulo();
                $item->id          = $row['id_productos'];
                $item->codigo      = $row['codigo'];
                $item->descripcion = $row['descripcion'];
                $item->precio      = $row['precio'];
                $item->fecha       = $row['fecha'];
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
    }

    public function ver_articulo($id)
    {
        $articulo = null;
        try {
            $query = $this->db->connect()->prepare('SELECT id_productos, codigo,descripcion,precio,fecha FROM productos WHERE id_productos=:id');
            $query->bindValue(':id', $id);
            //$query->execute(['nombre' => $nombre]);
            $query->execute();
            while ($row = $query->fetch()) {
                $articulo              = new Articulo();
                $articulo->id          = $row['id_productos'];
                $articulo->codigo      = $row['codigo'];
                $articulo->descripcion = $row['descripcion'];
                $articulo->precio      = $row['precio'];
                $articulo->fecha       = $row['fecha'];
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
            $query = $pdo->prepare('UPDATE productos SET codigo=:codigo, descripcion=:descripcion, precio= :precio, fecha= :fecha WHERE id_productos= :id');
            $query->bindParam(':codigo', $articulo->codigo);
            $query->bindParam(':descripcion', $articulo->descripcion);
            $query->bindParam(':precio', $articulo->precio);
            $query->bindParam(':fecha', $articulo->fecha);
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

        /*    public function sign($email, $pass)
            {

                $resultado = false;
                $pdo       = $this->db->connect();
                $message   = "fallo el ingreso";
                try {

                    $query = $connection->prepare('SELECT id, email, password FROM users WHERE email = :email');
                    $records->bindParam(':email', $_POST['email']);
                    $records->execute(); //Se ejecuta la conexión
                    $results = $records->fetch(PDO::FETCH_ASSOC); //Se obtiene el resultado de la consulta
                    $message = '';

                    if (is_countable($results) > 0 && password_verify($_POST['password'], $results['password'])) { //Si el usuario existe y la contraseña es correcta

                        $_SESSION['user_id'] = $results['id']; //Se guarda el id del usuario en la sesión
                        header("Location: index.php"); //Se redirecciona a la página principal
                    } else { //Si el usuario no existe o la contraseña es incorrecta
                        $message = 'Lo sentimos, tu email o contraseña no son correctos.'; //Se muestra un message de error
                    }

                    return $message;
                } catch (PDOException $e) {
                    return false;
                } finally {
                    //cerrar la conexion
                    $pdo = null;
                }
            } //end actualizar
            */

}