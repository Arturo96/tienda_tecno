<?php 
require_once 'includes/conexion.php'; 
require_once 'includes/helpers.php'; 

$type_products = getCategories($connection);

?>


<header>
    <a href="index.php" class="logo">
        <h1>SAG SOLUTIONS</h1>
    </a>

    <nav class="menu-nav">
        <ul class="menu">
            <?php if(!empty($type_products)): 
                    while($type_product = mysqli_fetch_assoc($type_products)): ?>
                        <li class="menu-item"><a href="" class="menu-link"><?= $type_product['nombre'] ?></a></li>
            <?php   endwhile;
                  endif; ?>
        </ul>
    </nav>

</header>