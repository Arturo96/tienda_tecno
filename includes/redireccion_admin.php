<?php
$permissions = true;
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    $permissions = false;

} else {
    if ($_SESSION['usuario']['rol'] != 'Admin') header('Location: index.php');
    $permissions = false;

}