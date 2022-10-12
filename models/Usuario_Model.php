<?php

#require_once 'entidades/alumno.php';
require_once 'entidades/ArticuloDto.php';
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
            //:descripcion, :precio, :fecha
            //$resultado = $query->execute();

            /*if ($filasAf == 0) {
            $resultado = false;
            }*/
            //$str = "valor";
            //$resultado = $query->fetch(); // return (PDOStatement) or false on failure
            //$query->close();
            //$user = null;

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