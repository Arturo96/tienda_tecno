<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Registro de Productos</title>
</head>

<body>

    <?php
    require_once 'includes/header.php';
    require_once 'includes/redireccion_admin.php';
    ?>

    <div class="content">
        <main class="container">

            <h2 class="main-title">Registro de Productos</h2>

            <?php if(isset($_SESSION['completed'])): ?>
                <div class="alert success">
                    <?= $_SESSION['completed'] ?>
                </div>
            <?php endif; ?>

            <form action="register_product.php" class="form-product" method="post">

                <!-- Tipo de producto -->

                <label>Tipo de producto:
                    <select name="tipo_producto">
                      <?php 
                            $tipo_productos = getProducts($connection, true);
                            while($tipo_producto = mysqli_fetch_assoc($tipo_productos)): ?>
                                <option value="<?= $tipo_producto['id'] ?>"><?= $tipo_producto['nombre'] ?></option>
                      <?php endwhile; ?>
                    </select>
                </label>

                <label>Marca:
                    <input name="marca_producto" type="text">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'marca_producto') : ''  ?>

                <label>Modelo:
                    <input name="modelo_producto" type="text">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'modelo_producto') : ''  ?>

                <label>Precio:
                    <input name="precio_producto" type="number" min='10000' step="10000">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'precio_producto') : ''  ?>

                <label>Stock:
                    <input name="stock_producto" type="number" min='1'>
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'stock_producto') : ''  ?>

                <label>Fecha de la garantía:
                    <input name="fecha_producto" type="date" >
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'fecha_producto') : ''  ?>

                <label>Descripción:
                    <textarea name="desc_producto" rows="10"></textarea>
                </label>
        
                <input type="submit" name="submitProduct" value="Registrar">

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