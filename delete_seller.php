<?php
$location = 'vendedores.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
require_once 'includes/redireccion_admin.php';

if ($permissions) {
    
    $seller_id = (int) mysqli_real_escape_string($connection, $_GET['id']);

    $seller = getSellerById($connection, $seller_id);

    if (empty($seller)) {
        $location = 'index.php';
    } else {
        $errores = [];

        $sql = "DELETE FROM vendedores WHERE id = $seller_id;";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION['completed'] = 'Vendedor borrado correctamente.';
        } else {
            $errores['db'] = "Error al eliminar el vendedor: " . mysqli_error($connection);
        }

        $_SESSION['errores'] = $errores;
    }
}

header("Location: $location");
