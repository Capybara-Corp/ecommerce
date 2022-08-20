<?php

//define('URL', 'http://localhost/mvc/');
define('URL', 'http://' . $_SERVER['HTTP_HOST'] . '/login/');

//conexion a la base de datos
$server   = 'localhost';
$username = 'root';
$password = '';
$database = '';

try {
    $connection = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $error) {
    die("No se pudo conectar a la base de datos: " . $error->getMessage());
}
?>