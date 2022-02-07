<?php
    $mshh = $_GET['mshh'];
    session_start();
    if(isset($_SESSION['giohang'][$mshh])){
        $_SESSION['giohang'][$mshh] = $_SESSION['giohang'][$mshh] + 1;
    }else{
        $_SESSION['giohang'][$mshh] = 1;
    }
    header("location: ./index.php?page=card");
   
?>