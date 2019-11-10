<?php

if (!empty($_POST)) {
    echo 'Ingreso a login.php';

    require_once 'includes/conexion.php';

    // Recibir los campos del formulario

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Arreglo de errores

    $errores = [];

    // Validar los campos del formulario

    if(empty($username) || !filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errores['username'] = 'El nombre de usuario ingresado no es válido';
    }

    if(empty($password) || strlen($password) < 4) {
        $errores['password'] = 'La contraseña debe tener mínimo 4 carácteres';
    }

    if(count($errores) == 0) {
        $sql = "SELECT u.*, r.nombre AS rol FROM usuarios u
                    JOIN roles r ON u.rol_id = r.id
         WHERE u.email = '$username' AND u.password = '$password';";

        $user = mysqli_query($connection, $sql);

        if($user && mysqli_num_rows($user) == 1) {
            $_SESSION['usuario'] = mysqli_fetch_assoc($user);
        } else {
            $errores['usuario'] = 'El nombre de usuario o la contraseña no son correctos';
        }
    }

    $_SESSION['errores'] = $errores;
    

}

header('Location: index.php');
