<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Edición de Productos</title>
</head>

<body>

    <?php
    require_once 'includes/header.php';
    require_once 'includes/redireccion_admin.php';

    $product_id = (int) $_GET['id'];
    $product = getProductById($connection, $product_id);

    if(empty($product)) header('Location: index.php');

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

                <!-- Id -->

                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                <!-- Tipo de producto -->

                <label>Tipo de producto:
                    <select name="tipo_producto">
                      <?php 
                            $tipo_productos = getProducts($connection, true);
                            while($tipo_producto = mysqli_fetch_assoc($tipo_productos)): 
                            $selected = '';
                                if($tipo_producto['id'] == $product['tipo_producto_id']) {
                                    $selected = 'selected';
                                }
                      ?>
                                <option value="<?= $tipo_producto['id'] ?>" <?= $selected ?>><?= $tipo_producto['nombre'] ?></option>
                      <?php endwhile; ?>
                    </select>
                </label>

                <label>Marca:
                    <input name="marca_producto" type="text" value="<?= $product['marca'] ?>">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'marca_producto') : ''  ?>

                <label>Modelo:
                    <input name="modelo_producto" type="text" value="<?= $product['modelo'] ?>">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'modelo_producto') : ''  ?>

                <label>Precio:
                    <input name="precio_producto" type="number" min='10000' step="10000" value="<?= $product['precio'] ?>">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'precio_producto') : ''  ?>

                <label>Stock:
                    <input name="stock_producto" type="number" min='1' value="<?= $product['stock'] ?>">
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'stock_producto') : ''  ?>

                <label>Fecha de la garantía:
                    <input name="fecha_producto" type="date" value="<?= $product['fecha_garantia'] ?>" >
                </label>

                <?php echo isset($_SESSION['errores']) ? showErrors($_SESSION['errores'], 'fecha_producto') : ''  ?>

                <label>Descripción:
                    <textarea name="desc_producto" rows="10"><?= $product['descripcion'] ?></textarea>
                </label>
        
                <input type="submit" name="submitProduct" value="Actualizar">

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