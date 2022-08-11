<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/index/login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Esto es para que se pueda conectar con el servidor de Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <!-- Esto es para que se pueda usar el tipo de letra Playfair Display -->

<body>
  <?php require 'partials/header.php';?>
  <h1>Login</h1>
  <span>or <a href="signup.php">Sign Up</a></span>

  <?php if (!empty($message)): ?>
  <!-- Si el message no está vacío -->
  <p><?=$message;?></p> <!-- Se muestra el message -->
  <?php endif;?>

  <!-- Login Form, action es a dónde se van a enviar todos los datos, el metodo post
        evita filtrar la información a través de la url.-->
  <form action="<?php echo constant('URL'); ?>login/sign" method="post"></form>
  <input type="text" name="email" placeholder="Ingresa tu correo">
  <input type="password" name="password" placeholder="Ingresa tu contraseña">
  <input type="submit" value="Login">
</body>

</html>