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
    $permissions = true;
    if (!isset($_SESSION['usuario'])) {
        $permissions = false;
    } else {
        if ($_SESSION['usuario']['rol'] != 'Admin') {
            $permissions = false;
        }
    }

    $products = getProducts($connection);

    ?>

    <!-- Content -->
    <div class="content">
        <main class="container">
            <h2 class="main-title">Nuestros Productos</h2>

            <section class="products">

                <?php if(isset($_SESSION['completed'])): ?>
                    <div class="alert success"><?= $_SESSION['completed'] ?></div>
                <?php endif; 
                if(isset($_SESSION['errores'])) {
                    echo showErrors($_SESSION['errores'], 'db');
                }
                  
                if($permissions): ?>
                    <a class="add-button" href="add_product.php">Agregar producto</a>
                <?php endif ; 

                if (!empty($products)) :
                    while ($product = mysqli_fetch_assoc($products)) : ?>
                        <article class="product">
                            <a href="">
                                <h3 class="product-name"><?= $product['marca'] . ' ' . $product['modelo'] ?></h3>
                            </a>
                            <div class="main-info">
                                <img src="assets/img/rn8-pro.jpg" alt="Imagen de Producto 1" class="product-image">
                                <div class="product-info">
                                    <?php if ($product['stock'] > 0) : ?>
                                        <h4 class="sale-banner">Sale</h4><br>
                                    <?php else : ?>
                                        <h4 class="empty-banner">Agotado</h4>
                                    <?php endif; 
                                        if($permissions): ?>
                                            <div class="banner-container">
                                                <a class="edit-button" href="edit_product.php?id=<?= $product['id'] ?>">Editar</a>
                                                <a class="product-delete-button" href="delete_product.php?id=<?= $product['id'] ?>">Borrar</a>
                                            </div>

                                    <?php endif; ?>

                                    <h4 class="price-product"><?= $product['precio'] ?> $</h4>
                                    <?php if ($product['stock'] <= 10 && $product['stock'] > 0) : ?>
                                        <h4 class="stock-product">¡ Quedan pocas unidades disponibles !</h4>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="especificaciones">
                                <?php
                                        $especificaciones = explode(';', $product['descripcion']);
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