<?php
$location = 'add_buy.php';
if (!empty($_POST)) {

    // Conexión con la BD

    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php';

    $errores = [];

    // Recibir los campos del formulario

    $submit = $_POST['submitBuy'];

    $cliente_buy = mysqli_real_escape_string($connection, $_POST['cliente_buy']);

    $vendedor_buy = (int) $_POST['vendedor_buy'];

    $numProducts = 0;
    $products_buy = [];
    $cantidad_products = [];

    if (isset($_POST['numProductos'])) {
        $numProductos = (int) $_POST['numProductos'];
    } else {
        $numProductos = 1;
    }

    for ($i = 1; $i <= $numProductos; $i++) {
        $products_buy[] = (int) $_POST["product-buy$i"];
        $cantidad_products[] =  (int) $_POST["cantidad$i"];
    }

    // Creamos sesiones de cada campo para que el usuario no los digite otra vez

    $_SESSION['cliente_buy'] = $cliente_buy;
    $_SESSION['vendedor_buy'] = $vendedor_buy;
    $_SESSION['products_buy'] = $products_buy;
    $_SESSION['cantidad_products'] = $cantidad_products;

    // Validar los campos recibidos

    // Cliente

    if (empty($cliente_buy)) {
        $errores['cliente_buy'] = 'Es obligatorio ingresar el cliente.';
    }

    // Vendedor

    if (empty($vendedor_buy) || is_nan($vendedor_buy))  {
        $errores['vendedor_buy'] = 'Es obligatorio ingresar el vendedor.';
    }

    // Productos (id_producto y cantidad)

    for ($i = 1; $i <= $numProductos; $i++) {
        $product_buy = $products_buy[$i - 1];
        $cantidad_product = $cantidad_products[$i - 1];
        if (empty($product_buy) || is_nan($product_buy)) {
            $errores["product-buy$i"] = 'Producto no válido.';
        }
        $productInStock = getProductById($connection, $product_buy);
        $error_string = "Error en el producto $i";
        if ($cantidad_product <= 0 || is_nan($cantidad_product)) {
            $errores["cantidad"] .=  "$error_string: Cantidad no válida.<br>";
        } elseif($productInStock['stock'] < $cantidad_product) {
            $errores["cantidad"] .= "$error_string: Solo quedan {$productInStock['stock']} unidades.<br>";
        }

    }


    if (count($errores) == 0) {
        echo 'Sin errores';
        die();

        if ($submit == 'Actualizar') {
            $sql = "UPDATE productos SET 
                         tipo_producto_id = $tipo_producto,
                         marca            = '$marca_producto',
                         modelo           = '$modelo_producto',
                         precio           = $precio_producto,
                         stock            = $stock_producto,
                         fecha_garantia   = '$fecha_producto',
                         descripcion      =  '$desc_producto'
                     WHERE id = $product_id;";
        } else {
            $sql = "INSERT INTO productos VALUES(null, $tipo_producto,'$marca_producto', '$modelo_producto', $precio_producto, $stock_producto, '$fecha_producto', '$desc_producto');";
        }

        $product = mysqli_query($connection, $sql);

        if ($product) {
            $string = 'insertado';
            if ($submit == 'Actualizar') {
                $string = 'actualizado';
            }
            $_SESSION['completed'] = "Producto $string correctamente.";
        } else {
            $string = 'insertar';
            if ($submit == 'Actualizar') {
                $string = 'actualizar';
            }
            $errores['db'] = "Error al $string el producto: " . mysqli_error($connection);
        }
    }

    $_SESSION['errores'] = $errores;
}

header("Location: $location");
