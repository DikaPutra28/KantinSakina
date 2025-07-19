<?php
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "home.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'makanan') {
    $page = 'makanan.php';
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'minuman') {
    $page = 'minuman.php';
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
} else {
    include "main.php";
}
?>