<?php

Class Connect{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "ECOMMERCE";
    
    
    public function __construct() { // * Conecto a la base de datos
    try 
    {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) 
    {
    }
}
    public function getUsers(){
        $this->conn->query('SELECT * FROM USUARIOS');
    }


    
}
?>