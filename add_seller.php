<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Registro de Vendedores</title>
</head>

<body>

    <?php
    require_once 'includes/header.php';
    require_once 'includes/redireccion_admin.php';
    ?>

    <div class="content">
        <main class="container">

            <h2 class="main-title">Registro de Vendedores</h2>

            <?php if(isset($_SESSION['completed'])): ?>
                <div class="alert success">
                    <?= $_SESSION['completed'] ?>
                </div>
            <?php endif; ?>

            <form action="register_seller.php" class="form-seller" method="post">

                <label>Documento:
                    <input name="seller_document" type="text">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'seller_document') : ''  ?>

                <label>Nombres:
                    <input name="seller_name" type="text">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'seller_name') : ''  ?>

                <label>Apellidos:
                    <input name="seller_last" type="text">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'seller_last') : ''  ?>
        
                <input type="submit" name="submitSeller" value="Registrar">

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'db') : '' ?>

            </form>



        </main>

        <?php
        require_once 'includes/aside.php';
        require_once 'includes/footer.php';
        cleanErrors();
        ?>
</body>

</html>