<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Usuarios</title>

</head>

<body>

    <?php
    require_once 'includes/header.php';

    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
    } else {
        if ($_SESSION['usuario']['rol'] != 'Admin') header('Location: index.php');
    }

    ?>

    <div class="content">
        <main class="container">
            <h2 class="main-title">Listado de Usuarios</h2>

            <div class="add-container">
                <a class="add-button" href="add_user.php">Agregar usuario</a>
            </div>


            <table class="users-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                        $usuarios = getUsuarios($connection);
                        while($usuario = mysqli_fetch_assoc($usuarios)): ?>
                            <tr>
                                <td><?= $usuario['email'] ?></td>
                                <td><?= $usuario['rol'] ?></td>
                                <td>
                                    <a href="edit_user.php?id=<?= $usuario['email'] ?>" class="edit-button">Editar</a>
                                    <a href="delete_user.php?id=<?= $usuario['email'] ?>" class="delete-button">Eliminar</a>                                    
                                </td>
                            </tr>    
                  <?php endwhile; ?>
                </tbody>

            </table>

        </main>

        <?php
        require_once 'includes/aside.php';
        require_once 'includes/footer.php';
        ?>


</body>

</html>