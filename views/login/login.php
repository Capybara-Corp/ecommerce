<?php


  session_start();

  if (isset($_SESSION['uid'])) {
    header('Location: ../ecommerce');
  }
  require 'libs/connect.php';

  if (!empty($_POST['user_correo']) && !empty($_POST['user_pass'])) { // Si recibe algo...
    $records = $conn->prepare('SELECT * FROM USUARIOS WHERE correo=:user_correo');
    $records->bindParam(':user_correo', $_POST['user_correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (is_countable($results) > 0 && password_verify($_POST['user_pass'], $results['contraseña'])) {
      $_SESSION['uid'] = $results['uid'];
      $_SESSION['rango'] = $results['rango'];
      header("Location: ../ecommerce"); //Verifica que todo coincida
    } else {
      $message = 'Nombre o contraseña incorrectos'; // Sino, aparece esto
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="public/css/login/login.css">
  </head>
  <body>

  <?php include "views/index/header.php" ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="<?php echo constant('URL'); ?>signup">SignUp</a></span>

    <form action="login" method="POST">
      <input name="user_correo" type="text" placeholder="Enter your email">
      <input name="user_pass" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>

    <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>
  </body>
</html>