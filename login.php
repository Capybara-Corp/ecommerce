<?php

session_start();

if (isset($_SESSION['user_id'])) { //Si ya hay una sesión iniciada
    header('Location: /index/index.php'); //Se redirige al usuario a la página de inicio de sesión para que no pueda acceder a la página de inicio de sesión
}

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $connection->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute(); //Se ejecuta la conexión
    $results = $records->fetch(PDO::FETCH_ASSOC); //Se obtiene el resultado de la consulta
    $message = '';
    if (is_countable($results) > 0 && password_verify($_POST['password'], $results['password'])) { //Si el usuario existe y la contraseña es correcta
        session_start(); //Se inicia la sesión
        $_SESSION['user_id'] = $results['id']; //Se guarda el id del usuario en la sesión
        header("Location: index.php"); //Se redirecciona a la página principal
    } else { //Si el usuario no existe o la contraseña es incorrecta
        $message = 'Lo sentimos, tu email o contraseña no son correctos.'; //Se muestra un message de error
    }
}