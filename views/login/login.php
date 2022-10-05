<?php

require "../../config/config.php";

  session_start();

  if (isset($_SESSION['uid'])) {
    header('Location: index.php');
  }
  require 'connect.php';

  if (!empty($_POST['user_correo']) && !empty($_POST['user_pass'])) {
    $records = $conn->prepare('SELECT uid, correo, contraseña FROM USUARIOS WHERE correo=:user_correo');
    $records->bindParam(':user_correo', $_POST['user_correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (is_countable($results) > 0 && password_verify($_POST['user_pass'], $results['contraseña'])) {
      $_SESSION['uid'] = $results['uid'];
      header("Location: index.php");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/login/login.css">
  </head>
  <body>

  <nav class="noselect"> <!-- Es el menu superior -->
				<div id="toggle-menu" class="toggle-menu">
				<img src="../public/media/menu.png" id="menupic">
				</div>  <!-- Este div contiene la imagen del boton para abrir el menu -->
				<ul class="main-menu" id="main-menu">
			    <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
        	<li><a href="<?php echo constant('URL'); ?>nosotros">NOSOTROS</a></li>
        	<li><a href="<?php echo constant('URL'); ?>carrito/market">PRODUCTOS</a></li>
        	<li>NOTICIAS</li>
        	<li>CARRITO</li>
        	<li>CONTACTO</li>
			
					<li>|&nbsp;&nbsp;&nbsp;LOGIN</li>
				</ul>
			</nav> <!-- Aqui termina el menu -->

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="user_correo" type="text" placeholder="Enter your email">
      <input name="user_pass" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>

    <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>
  </body>
</html>