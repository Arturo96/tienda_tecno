<?php
$location = 'add_user.php';
if (!empty($_POST)) {

    // Conexión con la BD

    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php';

    // Recibir los campos del formulario

    $submit = $_POST['submitUser'];

    $email = mysqli_real_escape_string($connection, $_POST['email']);

    $errores = [];

    // Password

    if ($submit != 'Actualizar') {
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

        if (empty($password) || strlen($password) < 4) {
            $errores['password'] = 'La contraseña debe tener mínimo 4 carácteres';
        } elseif (strcmp($password, $confirm_password) != 0) {
            $errores['confirm_password'] = 'La contraseña no concuerda en los dos campos';
        }
    } else {
        $location = "edit_user.php?id={$_POST['user_email']}";
    }

    $rol_id = (int) mysqli_real_escape_string($connection, $_POST['rol']);

    // Validar cada uno de los campos recibidos

    // Email

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El correo ingresado no es válido';
    } elseif (existsEmail($connection, $email)) {
        if($submit != 'Actualizar') {
            $errores['email'] = 'El correo ingresado ya está registrado';
        } else {
            if($email != $_POST['user_email']) {
                $errores['email'] = 'El correo ingresado ya está registrado';
            }
        }
        
    }

    if (count($errores) == 0) {
        if($submit != 'Actualizar') {
            $sql = "INSERT INTO usuarios VALUES('$email', $rol_id, '$password')";
        } else {
            $sql = "UPDATE usuarios SET 
                        email = '$email',
                        rol_id  = $rol_id
                    WHERE email = '{$_POST['user_email']}';";
        }
        
        $user = mysqli_query($connection, $sql);

        if ($user) {
            $string = 'insertado';
            if($submit == 'Actualizar') {
                $string = 'actualizado';
                $location = "edit_user.php?id=$email";
                if($_POST['user_email'] == $_SESSION['usuario']['email']) {
                    $_SESSION['usuario'] = getUserByEmail($connection, $email);
                }
            }
            $_SESSION['completed'] = "Usuario $string correctamente.";
        } else {
            $string = 'insertar';
            if($submit == 'Actualizar') {
                $string = 'actualizar';
            }
            $errores['usuario'] = "Error al $string el usuario: " . mysqli_error($connection);
        }
    }

    $_SESSION['errores'] = $errores;
}

header("Location: $location");
