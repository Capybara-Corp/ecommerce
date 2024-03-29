<?php

#require_once 'entidades/alumno.php';
require_once 'entidades/ArticuloDto.php';
$_SESSION['orden'] = "";
//dcds
class BuscarArticulos_Model extends Model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function mayoramenor($buscStr)
    {
        /*if($_POST['buscar'] == 'pacman'){
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Pacman_HD.png">';
        }*/
        $resultado = false;
        $pdo       = $this->db->connect();
        try {

            if ($buscStr != "") {
                $query = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE nombre LIKE :textostr ORDER BY precio_venta DESC");
                $term  = "%$buscStr%";
                $query->bindParam(':textostr', $term, PDO::PARAM_STR);

            } else {
                $query = $pdo->prepare("SELECT * FROM PRODUCTOS ORDER BY precio_venta DESC");
            }

            $query->execute();
            while ($row = $query->fetch()) {
                $item              = new ArticuloDto();
                $item->id_producto = $row['pid'];
                $item->img         = $row['img'];
                $item->nombre      = $row['nombre'];
                $item->precio      = $row['precio_venta'];
                $item->descrip     = $row['descrip'];
                $item->marca       = $row['marca'];
                $item->cantidad    = $row['cantidad'];
                //array_push($items, $item);
                $items[] = $item;

            } //end while

            return $items;

        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo               = null;
            $_SESSION['orden'] = "mayoramenor";
        }
    }
    public function menoramayor($buscStr)
    {
        /*if($_POST['buscar'] == 'pacman'){
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Pacman_HD.png">';
        }*/
        $resultado = false;
        $pdo       = $this->db->connect();
        try {

            if ($buscStr != "") {
                $query = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE nombre LIKE :textostr ORDER BY precio_venta ASC");
                $term  = "%$buscStr%";
                $query->bindParam(':textostr', $term, PDO::PARAM_STR);

            } else {
                $query = $pdo->prepare("SELECT * FROM PRODUCTOS ORDER BY precio_venta ASC");
            }

            $query->execute();
            while ($row = $query->fetch()) {
                $item              = new ArticuloDto();
                $item->id_producto = $row['pid'];
                $item->img         = $row['img'];
                $item->nombre      = $row['nombre'];
                $item->precio      = $row['precio_venta'];
                $item->descrip     = $row['descrip'];
                $item->marca       = $row['marca'];
                $item->cantidad    = $row['cantidad'];
                //array_push($items, $item);
                $items[] = $item;

            } //end while

            return $items;

        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo               = null;
            $_SESSION['orden'] = "menoramayor";
        }
    }

    public function buscar($buscStr)
    {
        /*if($_POST['buscar'] == 'pacman'){
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Pacman_HD.png">';
        }*/

        $resultado = false;
        $pdo       = $this->db->connect();
        $items     = [];
        try {

            //$query = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE nombre LIKE LOWER('%" . $buscStr . "%')");

            if ($buscStr != "") {
                $buscStr = trim($buscStr);
                $buscStr = strtolower($buscStr);
                /*if($buscStr == 'pacman'){
                echo '<img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Pacman_HD.png">';
                }*/
                //codigo cuando busco

                if ($_SESSION['orden'] == "mayoramenor") {
                    $query = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE nombre LIKE :textostr ORDER BY precio_venta DESC");
                } else if ($_SESSION['orden'] == "menoramayor") {
                    $query = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE nombre LIKE :textostr ORDER BY precio_venta ASC");
                } else {
                    $query = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE nombre LIKE :textostr");
                }
                //$query = $pdo->prepare('SELECT codigo, descripcion FROM productos WHERE descripcion LIKE :textostr');
                // $query = '%' . $search . '%';
                $term = "%$buscStr%";

//$query
                //$query->bindParam(':textostr', '%' . $search . '%');
                $query->bindParam(':textostr', $term, PDO::PARAM_STR);
//$query->execute(['nombre' => $nombre]);
                $query->execute();

                // } else {
                //  $query = $pdo->prepare("SELECT * FROM PRODUCTOS");
                //muestro todo
            } else {
                if ($_SESSION['orden'] == "mayoramenor") {
                    $query = $pdo->prepare("SELECT * FROM PRODUCTOS ORDER BY precio_venta DESC");
                } else if ($_SESSION['orden'] == "menoramayor") {
                    $query = $pdo->prepare("SELECT * FROM PRODUCTOS ORDER BY precio_venta ASC");
                } else {
                    $query = $pdo->prepare("SELECT * FROM PRODUCTOS");
                }

            }

            //$resultado = $query->execute();
            //$filasAf   = $query->rowCount();

            $query->execute();
            while ($row = $query->fetch()) {
                $item              = new ArticuloDto();
                $item->id_producto = $row['pid'];
                $item->img         = $row['img'];
                $item->nombre      = $row['nombre'];
                $item->precio      = $row['precio_venta'];
                $item->descrip     = $row['descrip'];
                $item->marca       = $row['marca'];
                $item->cantidad    = $row['cantidad'];
                //array_push($items, $item);
                $items[] = $item;

            } //end while

            return $items;

        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
    }

    //end actualizar

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