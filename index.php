<?php
session_start();
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "home.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'menu') {
    $page = 'menu.php';
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'transaksi') {
    $page = 'transaksi.php';
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'user') {
    if ($_SESSION["level_kantin"] == 1) {
        $page = 'user.php';
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'kios') {
    if ($_SESSION["level_kantin"] == 1) {
        $page = 'kios.php';
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'laporan') {
    $page = 'laporan.php';
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'history') {
    $page = 'history.php';
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include "validate/validate_logout.php";
} else {
    include "main.php";
}
?>