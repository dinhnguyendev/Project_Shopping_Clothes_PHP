<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $data="quanlyshopping";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $data);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
    mysqli_set_charset($conn,'UTF8'); 
?>