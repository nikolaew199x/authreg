<?php
    require "db.php";
    unset($_SESSION['login_user']);
    header('location: index.php');
?>
