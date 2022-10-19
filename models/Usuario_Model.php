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


    

    public function login($correo, $contraseña)
    {
        $pdo          = $this->db->connect();

        if (!empty($correo) && !empty($contraseña)) {
        try {
            $query = $pdo->prepare('SELECT * FROM USUARIOS WHERE correo = :user_correo');
            $query->bindParam(':user_correo', $correo);
            $resultado = $query->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);

            $message = '';

            if (is_countable($resultado) > 0 && password_verify($contraseña, $resultado['contraseña'])) {
                $_SESSION['uid']   = $resultado['uid'];
                $_SESSION['rango'] = $resultado['rango'];
                header("Location: ../ecommerce"); //Verifica que todo coincida
            } else {
                $message = 'Nombre o contraseña incorrectos'; // Sino, aparece esto
            }


        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
        
        }   
    }
}
    