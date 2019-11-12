<?php
$location = 'list_users.php';
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
require_once 'includes/redireccion_admin.php';

if ($permissions) {
    $user_email = mysqli_real_escape_string($connection, $_GET['id']);

    $usuario = getUserByEmail($connection, $user_email);

    if (empty($usuario)) {
        $location = 'index.php';
    } else {
        $errores = [];

        $sql = "DELETE FROM USUARIOS WHERE email = '$user_email';";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $_SESSION['completed'] = 'Usuario borrado correctamente.';
        } else {
            $errores['db'] = "Error al eliminar el usuario: " . mysqli_error($connection);
        }

        $_SESSION['errores'] = $errores;
    }

    header("Location: $location");
}
