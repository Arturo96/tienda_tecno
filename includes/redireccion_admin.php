<?php

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
} else {
    if ($_SESSION['usuario']['rol'] != 'Admin') header('Location: index.php');
}