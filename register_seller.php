<?php
$location = 'add_seller.php';
if (!empty($_POST)) {

    // Conexión con la BD

    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php';

    $errores = [];

    // Recibir los campos del formulario

    $submit = $_POST['submitSeller'];

    $seller_document = (int) mysqli_real_escape_string($connection, $_POST['seller_document']);

    $seller_name = mysqli_real_escape_string($connection, $_POST['seller_name']);

    $seller_last = mysqli_real_escape_string($connection, $_POST['seller_last']);

    // Validar los campos recibidos

    // Documento

    if (empty($seller_document) || is_nan($seller_document) || !filter_var($seller_document, FILTER_VALIDATE_INT) || strlen($seller_document) < 8) {
        $errores['seller_document'] = 'El documento ingresado no es válido.';
    } 

    if(existsDocument($connection, $seller_document)) {
        $errores['seller_document'] = 'El documento ingresado ya está registrado con otro usuario.';
    }

    // Nombres

    if (empty($seller_name) || is_numeric($seller_name) || preg_match("/[0-9]/", $seller_name)) {
        $errores['seller_name'] = 'Los nombres ingresados no son válidos.';
    } 

    // Apellidos

    if (empty($seller_last) || is_numeric($seller_last) || preg_match("/[0-9]/", $seller_last)) {
        $errores['seller_last'] = 'Los apellidos ingresados no son válidos.';
    } 

    if (count($errores) == 0) {
        if($submit != 'Actualizar') {
            $sql = "INSERT INTO vendedores VALUES(null, '$seller_name', '$seller_last', $seller_document);";
        } else {
            $sql = "UPDATE usuarios SET 
                        email = '$email',
                        rol_id  = $rol_id
                    WHERE email = '{$_POST['seller_email']}';";
        }
        
        $seller = mysqli_query($connection, $sql);

        if ($seller) {
            $string = 'insertado';
            if($submit == 'Actualizar') {
                $string = 'actualizado';
                $location = "edit_seller.php?id=$email";
                if($_POST['seller_email'] == $_SESSION['usuario']['email']) {
                    $_SESSION['usuario'] = getsellerByEmail($connection, $email);
                }
            }
            $_SESSION['completed'] = "Vendedor $string correctamente.";
        } else {
            $string = 'insertar';
            if($submit == 'Actualizar') {
                $string = 'actualizar';
            }
            $errores['db'] = "Error al $string el vendedor: " . mysqli_error($connection);
        }
    }

    $_SESSION['errores'] = $errores;
}

header("Location: $location");
