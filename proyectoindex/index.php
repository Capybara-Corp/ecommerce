<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) { //Si ya hay una sesión iniciada
    $records = $connection->prepare('SELECT id, email, password FROM users WHERE id = :id'); //Se prepara la consulta
    $records->bindParam(':id', $_SESSION['user_id']); //Se le asigna el id del usuario a la consulta
    $records->execute(); //Se ejecuta la consulta
    $results = $records->fetch(PDO::FETCH_ASSOC); //Se obtiene el resultado de la consulta

    $user = null; //Se inicializa la variable user

    if (is_countable($results) > 0) { //Si el usuario existe
        $user = $results; //Se guarda el usuario en la variable user
    }
}