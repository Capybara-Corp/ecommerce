<?php 
    require 'database.php';
    
    $message = ''; //Variable para almacenar el mensaje de error.

//En caso de que los campos no esten vacíos puede empezar a añadir los datos a la base
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $statement = $connection->prepare($sql); //Se prepara la conexión para que se pueda ejecutar
    $statement->bindParam(':email', $_POST['email']); //Se le pasa el valor del campo email a la variable email
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //Se encripta la contraseña con el algoritmo de encriptación de contraseñas de bcrypt
    $statement->bindParam(':password', $password); //Se le pasa el valor del campo password a la variable password

    if ($statement->execute()) {
        $message = 'Nuevo usuario creado';
    } else {
        $message = 'No se pudo crear el usuario';
    }
}

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
    
    <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
    <?php endif; ?>
    
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