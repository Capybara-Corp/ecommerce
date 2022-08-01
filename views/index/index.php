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
  <?php require 'partials/header.php';?>

  <?php if (!empty($user)): ?>
  <!-- Si el usuario existe -->
  <br>Welcome, <?=$user['email'];?></br> <!-- Se muestra el email del usuario junto a un mensaje de bienvenida-->
  <a href="logout.php">Log out</a> <!-- Se muestra un enlace para cerrar la sesión -->
  <?php else: ?>
  <!-- Si el usuario no existe -->
  <h1>Please:</h1> <!-- Se muestra un mensaje para que inicie una sesión correcta o se registre-->

  <a href="login.php">Login</a> <!-- Se muestra un enlace para iniciar sesión -->
  <p>or</p>
  <a href="signup.php">Sign Up</a> <!-- Se muestra un enlace para registrarse -->
  <?php endif;?>
</body>

</html>