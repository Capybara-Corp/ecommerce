<?php 
    require 'database.php' 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php require 'partials/header.php' ?>
    <h1>Sign Up</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Ingresa tu correo">
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
        <input type="password" name="confirm_password" placeholder="Confirma tu contraseña">
        <input type="submit" value="Sign Up">
    </form>
    </body>
</html>