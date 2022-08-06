<?php

session_start();

if (isset($_SESSION['user_id'])) { //Si ya hay una sesión iniciada
    header('Location: index.php'); //Se redirige al usuario a la página de inicio de sesión para que no pueda acceder a la página de inicio de sesión
}

require 'database.php';