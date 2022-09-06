<?php
require_once 'vendor/autoload.php';
require_once 'auth.php';
use Firebase\JWT\JWT;
$token = $_GET['t'];
try {
    //code...
    auth::Check($token);
    echo "<h1>" . "autorizado" . "</h1>";
    var_dump(auth::GetData($token));
    echo "<br/>";
    echo auth::GetData($token)->role;
} catch (Exception $e) {
    echo "<h1>" . $e->getMessage() . "</h1>";
}

echo "<h1>" . "entro" . "</h1>";
