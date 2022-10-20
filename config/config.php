<?php
if (!defined('URL')) {
    define('URL', 'http://' . $_SERVER['HTTP_HOST'] . '/ecommerce/');
}

//conexion a la base de datos
if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('PORT')) {
    define('PORT', '3307');
}
if (!defined('DB')) {
    define('DB', 'ECOMMERCE');
}
if (!defined('USER')) {
    define('USER', 'root');
}
if (!defined('PASSWORD')) {
    define('PASSWORD', "");
}

if (!defined('CHARSET')) {
    define('CHARSET', 'utf8mb4');

}