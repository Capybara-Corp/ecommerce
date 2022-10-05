<?php
    /*me aseguro que existan los recursos por POST, con esto solo se procesa si se proviene del form configurado
     para ello*/
    if(!empty($_POST["user_correo"]) && !empty( $_POST["user_pass"]) && isset($_POST["user_correo"]) && isset($_POST["user_pass"])){process_login();}else 
    {
        /*redirecciono a login si es que no se provino con DATA SET via POST desde el*/
        header("Location: http://localhost/PHP%20devs/PDO/login%20example/login.php");
        exit();
    }
    
    function process_login()
    {
        include("connect.php");

        /*datos POST*/
        $array_dataset = 
        [
            "correo" => $_POST["user_correo"],
            "pass" => $_POST["user_pass"],
        ];

        /*configuracion consulta*/
        $data = $conn->query("SELECT * FROM USUARIOS")->fetchAll();
    
        /*recorro consulta*/
        $log_validate = false;
        foreach ($data as $row)
        {
            /*escucho coincidencia en usuario y pass*/
            if(strcmp($row['correo'], $array_dataset["correo"])==0 && strcmp($row['contraseña'], $array_dataset["pass"])==0){$log_validate = true;}
        }

        /*estimo resultado de consulta login*/
        $consulta_login = ($log_validate == true)? "credenciales válidas" : "credenciales inválidas";
        echo $consulta_login;
    };
?>