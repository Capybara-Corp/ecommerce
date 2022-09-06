<?php
if(!isset($_GET['t'])) die('Debe especificar el token');

$token = $_GET['t'];

var_dump(
    auth::GetData(
        $token
    )
);