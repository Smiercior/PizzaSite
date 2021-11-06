<?php
session_start();

if(isset($_POST['log']))
{
    $_SESSION['username'] = "Smiercior";
    header('location: index.php');
}

if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('location: index.php');
}

?>