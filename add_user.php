<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Registro de Usuarios</title>
</head>

<body>

    <?php
    require_once 'includes/header.php';
    require_once 'includes/redireccion_admin.php';
    ?>

    <div class="content">
        <main class="container">

            <h2 class="main-title">Registro de Usuarios</h2>

            <?php if(isset($_SESSION['completed'])): ?>
                <div class="alert success">
                    <?= $_SESSION['completed'] ?>
                </div>
            <?php endif; ?>

            <form action="register_user.php" class="form-user" method="post">
                <label>Correo electrónico:
                    <input name="email" type="email">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'email') : ''  ?>

                <label>Contraseña:
                    <input name="password" type="password">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'password') : ''  ?>

                <label>Confirmar contraseña:
                    <input name="confirm_password" type="password">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'confirm_password') : ''  ?>
                
                <label>Rol:
                    <select name="rol">
                      <?php 
                            $roles = getRoles($connection);
                            while($rol = mysqli_fetch_assoc($roles)): ?>
                                <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
                      <?php endwhile; ?>
                    </select>
                </label>

                <input type="submit" name="submitUser" value="Registrar usuario">

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'usuario') : '' ?>

            </form>



        </main>

        <?php
        require_once 'includes/aside.php';
        require_once 'includes/footer.php';
        cleanErrors();
        ?>
</body>

</html>