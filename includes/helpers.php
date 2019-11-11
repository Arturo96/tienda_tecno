<?php

function cleanErrors() {
    $_SESSION['errores'] = null;
    $_SESSION['completed'] = null;
    unset($_SESSION['errores']);
    unset($_SESSION['completed']);
}

function existsEmail($connection, $email) {
    $sql = "SELECT * FROM usuarios WHERE email = '$email';";

    $usuario = mysqli_query($connection, $sql);

    if($usuario && mysqli_num_rows($usuario) == 1) {
        return true;
    }

    return false;


}

function showErrors($session, $error) {

    $message = '';

    if(isset($session[$error])) {
        $message = "<div class='alert danger'>".$session[$error]."</div>";
    }

    return $message;
}

function getProducts($connection) {

    $sql = 'SELECT * FROM productos';

    $result = [];

    $products = mysqli_query($connection, $sql);

    if($products && mysqli_num_rows($products) >= 1) {
        $result = $products;
    }

    return $result;

}

function getRoles($connection) {

    $sql = 'SELECT * FROM roles';

    $result = [];

    $roles = mysqli_query($connection, $sql);

    if($roles && mysqli_num_rows($roles) >= 1) {
        $result = $roles;
    }

    return $result;

}


function getUsuarios($connection) {

    $sql = "SELECT u.*, r.nombre AS rol FROM usuarios u
                JOIN roles r ON u.rol_id = r.id;";

    $result = [];

    $usuarios = mysqli_query($connection, $sql);

    if($usuarios && mysqli_num_rows($usuarios) >= 1) {
        $result = $usuarios;
    }

    return $result;

}

function getCategories($connection) {
    $sql = 'SELECT * FROM tipo_productos LIMIT 10';

    $result = [];

    $products = mysqli_query($connection, $sql);

    if($products && mysqli_num_rows($products) >= 1) {
        $result = $products;
    }

    return $result;
}

