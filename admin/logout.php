<?php include "db.php"; ?>

<?php


    include_once "functions.php";
    session_start();
    $_SESSION['user_id'] = null;
    $_SESSION['username'] = null;
    $_SESSION['firstName'] = null;
    $_SESSION['lastName'] = null;
    $_SESSION['role'] = null;
    header("Location: ../index.php");




?>