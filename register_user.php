<?php 
    if(!empty($_POST)) {

        // Conexión con la BD

        require_once 'includes/conexion.php';
        require_once 'includes/helpers.php';

        // Recibir los campos del formulario

        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);
        $rol_id = (int) mysqli_real_escape_string($connection, $_POST['rol']);

        // Validar cada uno de los campos recibidos

        // Email

        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El correo ingresado no es válido';
        } elseif(existsEmail($connection, $email)) {
            $errores['email'] = 'El correo ingresado ya está registrado';
            
        }

        // Password
    
        if(empty($password) || strlen($password) < 4) {
            $errores['password'] = 'La contraseña debe tener mínimo 4 carácteres';
        } elseif (strcmp($password, $confirm_password) != 0) {
            $errores['confirm_password'] = 'La contraseña no concuerda en los dos campos';
        }

        if(count($errores) == 0) {
            $sql = "INSERT INTO usuarios VALUES('$email', $rol_id, '$password')";
    
            $user = mysqli_query($connection, $sql);
    
            if($user) {
                $_SESSION['completed'] = 'Usuario insertado correctamente.';
            } else {
                $errores['usuario'] = 'Error al insertar el usuario: '. mysqli_error($connection);
            }
        }
    
        $_SESSION['errores'] = $errores;
    }

    header('Location: add_user.php');
?>