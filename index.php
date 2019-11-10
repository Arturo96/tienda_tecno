<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Tienda tecnológica</title>
</head>

<body>
    <?php
    require_once 'includes/header.php';

    $products = getProducts($connection);

    ?>

    <!-- Content -->
    <div class="content">
        <main class="container">
            <h2 class="main-title">Nuestros Productos</h2>

            <section class="products">
                <?php if (!empty($products)) :
                    while ($product = mysqli_fetch_assoc($products)) : ?>
                        <article class="product">
                            <a href="">
                                <h3 class="product-name"><?= $product['marca'] . ' ' . $product['modelo'] ?></h3>
                            </a>
                            <div class="main-info">
                                <img src="assets/img/rn8-pro.jpg" alt="Imagen de Producto 1" class="product-image">
                                <div class="product-info">
                                    <?php if ($product['stock'] > 0) : ?>
                                        <h4 class="sale-banner">Sale</h4>
                                    <?php else : ?>
                                        <h4 class="empty-banner">Agotado</h4>
                                    <?php endif; ?>

                                    <h4 class="price-product"><?= $product['precio'] ?> $</h4>
                                    <?php if ($product['stock'] <= 10 && $product['stock'] > 0) : ?>
                                        <h4 class="stock-product">¡ Quedan pocas unidades disponibles !</h4>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="especificaciones">
                                <?php
                                        $especificaciones = explode(',', $product['descripcion']);
                                        foreach ($especificaciones as $esp) {
                                            echo "<p class='product-description'>" . $esp . "</p>";
                                        }
                                        ?>
                            </div>

                        </article>
                <?php endwhile;
                endif;
                ?>
            </section>


        </main>

        <?php
        require_once 'includes/aside.php';
        require_once 'includes/footer.php';
        cleanErrors();
        ?>

</body>

</html>