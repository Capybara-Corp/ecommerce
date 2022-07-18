<!--Conexión a la base de datos definida-->
<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'php_login_ecommerce';

try {
    $connection = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $error) {
    die("No se pudo conectar a la base de datos: " . $error->getMessage());
}
?>