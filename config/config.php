<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "quanlydathang";
    $conn = mysqli_connect($hostname, $username, $password, $database);
    if ($conn) {
        $setLang = mysqli_query($conn, "SET NAMES 'utf-8'");
    }
    else{
        die("Kết nối thất bại".mysqli_connect_error());
    }
?>