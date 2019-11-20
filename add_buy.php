<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Registro de Compras</title>
</head>

<body>

    <?php
    require_once 'includes/header.php';
    $permissions = true;
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
        $permissions = false;
    }
    if(isset($_GET['categoria'])) {
        $tipo_producto_id = (int) $_GET['categoria'];
    }
    ?>

    <div class="content">
        <main class="container">

            <h2 class="main-title">Registro de Compras</h2>

            <?php if (isset($_SESSION['completed'])) : ?>
                <div class="alert success">
                    <?= $_SESSION['completed'] ?>
                </div>
            <?php endif; ?>

            <form action="register_buy.php" id="formBuy" class="form-buy" method="post">

                <!-- Cliente -->

                <label>Cliente:
                    <select name="cliente_buy">
                        <?php
                        $clientes = getRecords($connection, 'clientes');
                        while ($cliente = mysqli_fetch_assoc($clientes)) : ?>
                            <option value="<?= $cliente['email'] ?>"><?= $cliente['email'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </label>

                <!-- Vendedor -->

                <label>Vendedor:
                    <select name="vendedor_buy">
                        <?php
                        $vendedores = getSellers($connection);
                        while ($vendedor = mysqli_fetch_assoc($vendedores)) : ?>
                            <option value="<?= $vendedor['id'] ?>"><?= $vendedor['apellidos'],' '.$vendedor['nombre'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </label>

                <!-- Producto -->
                            
                <label>Producto: 
                    <select class="product-buy" name="product-buy1" id="productoBuy">
                        <?php
                            $productos = getProducts($connection);
                        while ($producto = mysqli_fetch_assoc($productos)) : 
    
                        ?>
                            <option value="<?= $producto['id'] ?>"><?= $producto['marca'].' '.$producto['modelo'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </label>

                <label>Cantidad:
                    <input name="cantidad1" type="number" min='1' >
                </label>

                <div class="additionalProducts" id="additionalProducts"></div>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'cantidad') : ''  ?>

                <input type="button" class="add-button" id="addProductBuy" value="Agregar producto a compra" name="add-buy">

                <input type="submit" name="submitBuy" value="Registrar">

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'db') : '' ?> 

                <div id="numProductos"></div>

            </form>

        </main>

        <?php
        require_once 'includes/aside.php';
        require_once 'includes/footer.php';
        cleanErrors();
        ?>
</body>

</html>