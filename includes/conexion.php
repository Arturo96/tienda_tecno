<?php

$connection = mysqli_connect('localhost', 'root', 'itsecurity', 'tienda_tecnologica');

if(!$connection) {
    echo 'Error al conectar a la base de datos.';
    die();
} else {
    if(!isset($_SESSION)) session_start();

    mysqli_query($connection, "SET NAMES 'utf8';");
}

