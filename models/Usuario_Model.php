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


    

    public function login($correo, $contrasena)
    {
        $pdo          = $this->db->connect();

        if (!empty($correo) && !empty($contrasena)) {
        try {
            $query = $pdo->prepare('SELECT * FROM USUARIOS WHERE correo = :user_correo');
            $query->bindParam(':user_correo', $correo);
            $resultado = $query->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);

            $message = '';

            if (is_countable($resultado) > 0 && password_verify($contrasena, $resultado['contrasena'])) {
                $_SESSION['uid']   = $resultado['uid'];
                $_SESSION['rango'] = $resultado['rango'];
                header("Location: ../ecommerce"); //Verifica que todo coincida
            } else {
                $message = 'Nombre o contrasena incorrectos'; // Sino, aparece esto
            }


        } catch (PDOException $e) {
            return false;
        } finally {
            $pdo = null;
        }
        
        }   
    }













    public function signup($correo, $contrasena, $nombre, $numero, $confirmpassword)
    {

        $pdo          = $this->db->connect();

        $message = '';

        if (!empty($correo) && !empty($contrasena) && !empty($nombre) && !empty($numero) && !empty($confirmpassword)) {
            if (($contrasena) == ($confirmpassword)){
            
            
            try{
            $query = $pdo->prepare("INSERT INTO USUARIOS (correo, contrasena, nombre, telefono, rango, avatar) VALUES (:user_correo, :user_pass, :user_name, :user_number, '2', 'public/img/perfil/default.jpg')");
            

            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $query->bindParam(':user_correo', $correo);
            $user_pass = password_hash($contrasena, PASSWORD_BCRYPT);
            $query->bindParam(':user_pass', $user_pass);
            $query->bindParam(':user_name', $nombre);
            $query->bindParam(':user_number', $numero);

            if ($query->execute()) {
            $records = $pdo->prepare('SELECT * FROM USUARIOS WHERE correo=:user_correo');
            $records->bindParam(':user_correo', $correo);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);

                if (is_countable($results) > 0) {
                $_SESSION['uid']   = $results['uid'];
                $_SESSION['rango'] = $results['rango'];
                header("Location: ../ecommerce"); 
            }
            } else {
            $message = 'Ha ocurrido un error';
            }
            }
            else{
            $message = "Correo inválido";
            }

            
        }
        catch(Exception $e){
            $message = "Ha ocurrido un error"; 
        }
        finally {
            $pdo = null;
        }
        }
        else{
            $message = "Las contraseñas no coinciden";
        }}

        return $message;

    }


}
    