<?php
  session_start();

  require 'connect.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT uid, correo, contraseña FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
  </head>
  <body>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['correo']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
  </body>
</html>