<?php

session_start();

if (isset($_SESSION['user_id'])) { //Si ya hay una sesión iniciada
    header('Location: /login'); //Se redirige al usuario a la página de inicio para evitar que se inicie sesión dos veces
}

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $connection->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute(); //Se ejecuta la conexión
    $results = $records->fetch(PDO::FETCH_ASSOC); //Se obtiene el resultado de la consulta
    $message = '';
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) { //Si el usuario existe y la contraseña es correcta
        session_start(); //Se inicia la sesión
        $_SESSION['user_id'] = $results['id']; //Se guarda el id del usuario en la sesión
        header("Location: index.php"); //Se redirecciona a la página principal
    } else { //Si el usuario no existe o la contraseña es incorrecta
        $message = 'Lo sentimos, tu email o contraseña no son correctos.'; //Se muestra un mensaje de error
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Esto es para que se pueda conectar con el servidor de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet"> <!-- Esto es para que se pueda usar el tipo de letra Playfair Display -->
    <body>
    <?php require 'partials/header.php'?>
        <h1>Login</h1>
        <span>or <a href="signup.php">Sign Up</a></span>

        <?php if(!empty($message)): ?> <!-- Si el mensaje no está vacío -->
            <p><?= $message ?></p> <!-- Se muestra el mensaje -->
        <?php endif; ?>

        <!-- Login Form, action es a dónde se van a enviar todos los datos, el metodo post
        evita filtrar la información a través de la url.-->
        <form action="login.php" method="post"></form>
        <input type="text" name="email" placeholder="Ingresa tu correo">
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
        <input type="submit" value="Login">
    </body>
</html>