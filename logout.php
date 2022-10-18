<?php
session_start(); //Se inicia la sesión
session_unset(); //Se elimina toda la información de la sesión
session_destroy(); //Se destruye la sesión
header('Location: login.php'); //Se redirige al usuario a la página de inicio de sesión
?>