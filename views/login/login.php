<?php

/*if (isset($_SESSION['uid'])) {
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
        $_SESSION['uid']   = $results['uid'];
        $_SESSION['rango'] = $results['rango'];
        header("Location: ../ecommerce"); //Verifica que todo coincida
    } else {
        $message = 'Nombre o contraseña incorrectos'; // Sino, aparece esto
    }
}*/

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Iniciar sesión</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <!-- Cosas para que la pagina funcione -->
  <link rel="stylesheet" href="public/css/login/login.css">
  <link rel="stylesheet" href="public/css/index/header.css">
  <link rel="stylesheet" href="public/css/index/footer.css">
</head>

<body class="noselect">

  <?php include "views/index/header.php";?>

  

  <div class="login-box">

  <?php if (!empty($this->message)): ?>
  <p id="mensaje"> <?=$this->message;?></p>
  <?php endif;?>

    <h1>Iniciar sesión</h1>

    <form action="login" method="POST">
      <label for="user_correo">Correo</label>
      <input name="user_correo" type="text" placeholder="Ingrese su correo">

      <label for="user_pass">Contraseña</label>
      <input name="user_pass" type="password" placeholder="Ingrese su contraseña">


      <input type="submit" value="Iniciar sesión">

      <a href="<?php echo constant('URL'); ?>signup">¿No tienes una cuenta?</a>
    </form>
  </div>






  <?php include "views/index/footer.php";?>

  <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>
</body>

</html>