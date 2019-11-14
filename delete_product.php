<?php
$location = 'index.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
require_once 'includes/redireccion_admin.php';

if ($permissions) {
    
    $product_id = (int) mysqli_real_escape_string($connection, $_GET['id']);

    $product = getProductById($connection, $product_id);

    $errores = [];

    if (!empty($product) && !existsProductInBuy($connection, $product_id)) {
        
        $sql = "DELETE FROM productos WHERE id = $product_id;";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION['completed'] = 'Producto borrado correctamente.';
        } else {
            $errores['db'] = "Error al eliminar el producto: " . mysqli_error($connection);
        }

        
    } elseif(existsProductInBuy($connection, $product_id)) {
        $errores['db'] = "Error al eliminar el producto {$product['marca']} {$product['modelo']}: hay compras que dependen de ese producto. ";
    }
    $_SESSION['errores'] = $errores;
}

header("Location: $location");
