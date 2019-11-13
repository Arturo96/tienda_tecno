<?php
$location = 'add_product.php';
if (!empty($_POST)) {

    // Conexión con la BD

    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php';

    $errores = [];

    // Recibir los campos del formulario

    $submit = $_POST['submitProduct'];

    if($submit == 'Actualizar') {
        $product_id = (int) $_POST['product_id'];
        $location = "edit_product.php?id=$product_id";
    } 

    $tipo_producto = (int) mysqli_real_escape_string($connection, $_POST['tipo_producto']);

    $marca_producto = mysqli_real_escape_string($connection, $_POST['marca_producto']);

    $modelo_producto = mysqli_real_escape_string($connection, $_POST['modelo_producto']);

    $precio_producto = (float) mysqli_real_escape_string($connection, $_POST['precio_producto']);

    $stock_producto = (int) mysqli_real_escape_string($connection, $_POST['stock_producto']);

    $fecha_producto = mysqli_real_escape_string($connection, $_POST['fecha_producto']);

    $desc_producto = mysqli_real_escape_string($connection, $_POST['desc_producto']);

    // Validar los campos recibidos

    // Tipo de producto (int)

    if (empty($tipo_producto) || is_nan($tipo_producto) || !filter_var($tipo_producto, FILTER_VALIDATE_INT) ) {
        $errores['tipo_producto'] = 'El tipo de producto ingresado no es válido.';
    }

    // Marca

    if (empty($marca_producto)) {
        $errores['marca_producto'] = 'La marca ingresada es obligatoria.';
    }

    // Modelo del producto

    if (empty($modelo_producto)) {
        $errores['modelo_producto'] = 'El modelo del producto ingresado es obligatorio.';
    }

    // Precio del producto

    if (empty($precio_producto) || is_nan($precio_producto) ) {
        $errores['precio_producto'] = 'El precio del producto ingresado no es válido.';
    } elseif ($precio_producto <= 0) {
        $errores['precio_producto'] = 'El precio ingresado debe ser mayor a 0';
    }

    // Stock del producto

    if (empty($stock_producto) || is_nan($stock_producto) ) {
        $errores['stock_producto'] = 'El stock del producto ingresado no es válido.';
    } elseif ($stock_producto <= 0) {
        $errores['stock_producto'] = 'El stock ingresado debe ser mayor a 0';
    }

    // Fecha de garantía

    $patron = '/^202\d{1}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

    // var_dump($patron);
    // die();

    if (empty($fecha_producto) || !preg_match($patron, $fecha_producto) ) {
        $errores['fecha_producto'] = 'La fecha del producto ingresado no es válida.';
    }

    if (count($errores) == 0) {
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
