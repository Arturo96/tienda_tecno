<?php


function getProducts($connection) {

    $sql = 'SELECT * FROM productos';

    $result = [];

    $products = mysqli_query($connection, $sql);

    if($products && mysqli_num_rows($products) >= 1) {
        $result = $products;
    }

    return $result;

}

function getCategories($connection) {
    $sql = 'SELECT * FROM tipo_productos LIMIT 10';

    $result = [];

    $products = mysqli_query($connection, $sql);

    if($products && mysqli_num_rows($products) >= 1) {
        $result = $products;
    }

    return $result;
}

