<?php

  require 'connect.php';

  $message = '';

  if (!empty($_POST['user_correo']) && !empty($_POST['user_pass'])) {
    $sql = "INSERT INTO USUARIOS (correo, contraseña) VALUES (:user_correo, :user_pass)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_correo', $_POST['user_correo']);
    $user_pass = password_hash($_POST['user_pass'], PASSWORD_BCRYPT);
    $stmt->bindParam(':user_pass', $user_pass);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
  <body>


    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="user_correo" type="text" placeholder="Enter your email">
      <input name="user_pass" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>