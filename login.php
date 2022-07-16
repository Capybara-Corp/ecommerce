<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/style.css">
    <body>
        <h1>Login</h1>
        <!-- Login Form, action es a dónde se van a enviar todos los datos, el metodo post
        evita filtrar la información a través de la url.-->
        <form action="login.php" method="post"></form>
        <input type="text" name="email" placeholder="Ingresa tu correo">
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
        <input type="submit" value="Login">
    </body>
</html>
