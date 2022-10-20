<?php
$host     = "localhost";
$username = "root";
$password = "";
$db_name  = "ECOMMERCE";

try
{
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "<script>console.log('DB connect succesfull');</script>";
} catch (PDOException $e) {
    //$err = $e->getMessage();
    //echo "<script>console.error('DB connect failed.');</script>";
}; // * Conecto a la base de datos