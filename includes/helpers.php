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

function existsDocument($connection, $document) {
    $sql = "SELECT * FROM vendedores WHERE documento = $document;";

    $seller = mysqli_query($connection, $sql);

    if($seller && mysqli_num_rows($seller) == 1) {
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

function getProducts($connection, $tipo = false) {

    $string = "productos";

    if($tipo) $string = "tipo_productos";

    $sql = "SELECT * FROM $string";

    $result = [];

    $product = mysqli_query($connection, $sql);

    if($product && mysqli_num_rows($product) >= 1) {
        $result = $product;
    }

    return $result;

}

function getRecords($connection, $tabla) {
    $sql = "SELECT * FROM $tabla";

    $result = mysqli_query($connection, $sql);

    if($result && mysqli_num_rows($result) >= 1) {
        return $result;
    }

    return [];

}

function getProductById($connection, $product_id, $tipo = false) {

    $string = "productos";

    if($tipo) $string = "tipo_productos";

    $sql = "SELECT * FROM $string WHERE id = $product_id";

    $result = [];

    $product = mysqli_query($connection, $sql);

    if($product && mysqli_num_rows($product) == 1) {
        $result = mysqli_fetch_assoc($product);
    }

    return $result;

}

function getProductByCategory($connection, $category_id) {
    $sql = "SELECT * FROM productos WHERE tipo_producto_id = $category_id";

    $result = [];

    $products = mysqli_query($connection, $sql);

    if($products && mysqli_num_rows($products) >= 1) {
        $result = $products;
    }

    return $result;
}

function existsProductInBuy($connection, $product_id) {

    $sql = "SELECT * FROM detalle_compras WHERE producto_id = $product_id;";

    $product = mysqli_query($connection, $sql);

    if($product && mysqli_num_rows($product) >= 1) {
        return true;
    }

    return false;

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

function getSellers($connection) {

    $sql = "SELECT * FROM vendedores ORDER BY apellidos;";

    $result = [];

    $sellers = mysqli_query($connection, $sql);

    if($sellers && mysqli_num_rows($sellers) >= 1) {
        $result = $sellers;
    }

    return $result;
}

function getSellerById($connection, $id) {
    $sql = "SELECT * FROM vendedores WHERE id = $id;";

    $result = [];

    $seller = mysqli_query($connection, $sql);

    if($seller && mysqli_num_rows($seller) == 1) {
        $result = mysqli_fetch_assoc($seller);
    }

    return $result;
}

function getUserByEmail($connection, $email) {

    $sql = "SELECT u.*, r.nombre AS rol FROM usuarios u
                JOIN roles r ON u.rol_id = r.id 
            WHERE u.email = '$email';";

    $result = [];

    $usuario = mysqli_query($connection, $sql);

    if($usuario && mysqli_num_rows($usuario) == 1) {
        $result = mysqli_fetch_assoc($usuario);
    }

    return $result;
}


function getCategories($connection) {
    $sql = 'SELECT * FROM tipo_productos LIMIT 10';

    $result = [];

    $product = mysqli_query($connection, $sql);

    if($product && mysqli_num_rows($product) >= 1) {
        $result = $product;
    }

    return $result;
}

