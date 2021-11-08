<?php
session_start();

if(isset($_POST['log']))
{
    $_SESSION['username'] = $_POST['username'];
    if($_POST['password'] == "milk")
    {
        header('location: index.php');
    }
    else
    {
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }
    
}

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $emial = $_POST['emial'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];
    header('location: index.php');
}

if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('location: index.php');
}
?>