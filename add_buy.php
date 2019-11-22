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
    if (isset($_GET['categoria'])) {
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
            <?php endif;
                echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'cantidad') : '';
            
            ?>

            <form action="register_buy.php" id="formBuy" class="form-buy" method="post">

                <!-- Cliente -->

                <label>Cliente:
                    <select name="cliente_buy">
                        <?php
                        $clientes = getRecords($connection, 'clientes');
                        while ($cliente = mysqli_fetch_assoc($clientes)) : 
                            $selected = '';
                            if (isset($_SESSION['cliente_buy']) && $cliente['email'] == $_SESSION['cliente_buy']) {
                                $selected = 'selected';
                            }
                        ?>
                            <option value="<?= $cliente['email'] ?>" <?= $selected ?> ><?= $cliente['email'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'cliente_buy') : ''  ?>

                <!-- Vendedor -->

                <label>Vendedor:
                    <select name="vendedor_buy">
                        <?php
                        $vendedores = getSellers($connection);
                        while ($vendedor = mysqli_fetch_assoc($vendedores)) : 
                            $selected = '';
                            if (isset($_SESSION['vendedor_buy']) && $vendedor['id'] == $_SESSION['vendedor_buy']) {
                                $selected = 'selected';
                            }
                        ?>
                            <option value="<?= $vendedor['id'] ?>" <?= $selected ?>><?= $vendedor['apellidos'], ' ' . $vendedor['nombre'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'vendedor_buy') : ''  ?>

                <!-- Producto -->
                <?php
                if (isset($_SESSION['products_buy'])) {
                    $products_buy = $_SESSION['products_buy'];
                    $cantidad_products = $_SESSION['cantidad_products'];
                    foreach ($products_buy as $index => $product_buy) { ?>
                        <label>Producto <?= $index + 1 ?>:
                            <select class="product-buy" name="product-buy<?= $index + 1 ?>" id="productoBuy">
                                <?php
                                        $productos = getProducts($connection);
                                        while ($producto = mysqli_fetch_assoc($productos)) :
                                            $selected = '';
                                            if ($producto['id'] == $products_buy[$index]) {
                                                $selected = 'selected';
                                            }
                                            ?>
                                    <option value="<?= $producto['id'] ?>" <?= $selected ?>><?= $producto['marca'] . ' ' . $producto['modelo'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </label>
                        <label>Cantidad:
                            <input name="cantidad<?= $index + 1 ?>" type="number" value="<?= $cantidad_products[$index] ?>" min='1'>
                        </label>
                    <?php    }
                    } else { ?>
                    <label>Producto 1:
                        <select class="product-buy" name="product-buy1" id="productoBuy">
                            <?php
                                $productos = getProducts($connection);
                                while ($producto = mysqli_fetch_assoc($productos)) :

                                    ?>
                                <option value="<?= $producto['id'] ?>"><?= $producto['marca'] . ' ' . $producto['modelo'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </label>

                    <label>Cantidad:
                        <input name="cantidad1" type="number" min='1'>
                    </label>
                <?php } ?>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'product-buy1') : ''  ?>

                <div class="additionalProducts" id="additionalProducts"></div>

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