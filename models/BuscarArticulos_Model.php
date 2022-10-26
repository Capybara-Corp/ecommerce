<?php

#require_once 'entidades/alumno.php';
require_once 'entidades/ArticuloDto.php';

class BuscarArticulos_Model extends Model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function buscar($buscStr)
    {

        $resultado = false;
        $pdo       = $this->db->connect();
        try {

            $query = $pdo->prepare("SELECT * FROM PRODUCTOS WHERE nombre LIKE LOWER('%" . $buscStr . "%')");

            if ($buscStr != "") {
                //codigo cuando busco
                $query = $pdo->prepare("SELECT * FROM PRODUCTOS");
            } else {
                $query = $pdo->prepare("SELECT * FROM PRODUCTOS");
                //muestro todo
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