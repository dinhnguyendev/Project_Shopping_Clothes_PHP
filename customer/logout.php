<?php 

    require_once 'conect.php';
    session_start();
    unset($_SESSION['customer']);
    unset($_SESSION['cart']);
    header('Location:index.php');
?>