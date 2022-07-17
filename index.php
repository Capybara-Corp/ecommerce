<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) { //Si ya hay una sesión iniciada
    $records = $connection->prepare('SELECT id, email, password FROM users WHERE id = :id'); //Se prepara la consulta
    $records->bindParam(':id', $_SESSION['user_id']); //Se le asigna el id del usuario a la consulta
    $records->execute(); //Se ejecuta la consulta
    $results = $records->fetch(PDO::FETCH_ASSOC); //Se obtiene el resultado de la consulta

    $user = null; //Se inicializa la variable user

    if (count($results) > 0) { //Si el usuario existe
        $user = $results; //Se guarda el usuario en la variable user
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome!</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    </head>
    <body> 
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?> <!-- Si el usuario existe -->
    <h1>Welcome, <?= $user['email']; ?></h1> <!-- Se muestra el email del usuario junto a un mensaje de bienvenida-->
    <a href="logout.php">Log out</a> <!-- Se muestra un enlace para cerrar la sesión -->

    <?php else: ?> <!-- Si el usuario no existe -->
    <h1>Please Login or Sign Up</h1> <!-- Se muestra un mensaje de error -->
    <a href="login.php">Login</a> <!-- Se muestra un enlace para iniciar sesión -->
    <a href="signup.php">Sign Up</a> <!-- Se muestra un enlace para registrarse -->
    <?php endif; ?>
        <h1>Please Login or Sign Up</h1>
        <a href="login.php">Login</a> or
        <a href="signup.php">Sign Up</a>
    </body>
</html>