<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Vendedores</title>

</head>

<body>

    <?php
    require_once 'includes/header.php';
    require_once 'includes/redireccion_admin.php';
    ?>

    <div class="content">
        <main class="container">
            <h2 class="main-title">Listado de Vendedores</h2>

        <?php if(!empty($_SESSION['errores'])) {
                echo showErrors($_SESSION['errores'], 'db');
            } 
                if(isset($_SESSION['completed'])): ?>
                    <div class="alert success">
                        <?= $_SESSION['completed'] ?>
                    </div>
        <?php   endif; ?>

            <div class="add-container">
                <a class="add-button" href="add_seller.php">Agregar vendedor</a>
            </div>


            <table class="sellers-table">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                        $sellers = getSellers($connection);
                        while($seller = mysqli_fetch_assoc($sellers)): ?>
                            <tr>
                                <td><?= $seller['documento'] ?></td>
                                <td><?= $seller['apellidos'] ?></td>
                                <td><?= $seller['nombre'] ?></td>
                                <td>
                                    <a href="edit_seller.php?id=<?= $seller['id'] ?>" class="edit-button">Editar</a>
                                    <a href="delete_seller.php?id=<?= $seller['id'] ?>"  class="delete-button">Eliminar</a>                                    
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