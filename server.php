<?php
//// Session ////
session_start();
if(!isset($_SESSION['cartProductNumber']))
{
     $_SESSION['cartProductNumber'] = 0;
}
if(!isset($_SESSION['cartProducts']))
{
     $_SESSION['cartProducts'] = " ";
}

//// Variables ////
$json = file_get_contents("products.json");
$products = json_decode($json);
$pizzas = $products->produkty->pizze;
$salades = $products->produkty->sałatki;
$chips = $products->produkty->frytki;
$drinks = $products->produkty->napoje;

// foreach($pizzas as $pizza)
// {
//     echo $pizza->nazwa;
// }

//var_dump($products->produkty->pizze);
//var_dump($products->produkty->sałatki);


//// Routes, Requests ////

// Log in 
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

// Register
if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $emial = $_POST['emial'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];
    header('location: index.php');
}

// Logout
if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('location: index.php');
}

// For order.php, store chosen product name
if(isset($_POST['productName']))
{
     $_SESSION['productName'] = $_POST['productName'];
     $_SESSION['productComposition'] = $_POST['productComposition'];
     $_SESSION['productPrice'] = $_POST['productPrice'];
     $_SESSION['productImg'] = $_POST['productImg'];   
}

// Add item to cart
if(isset($_POST['addToCart']))
{
     $_SESSION['cartProductNumber'] = ($_SESSION['cartProductNumber'] + 1);
     $_SESSION['cartProducts'] = $_SESSION['cartProducts'] . $_SESSION['productName'] . "-" . $_POST['size'] . ",";
     header('location: offers.php');
}

// Clear cart
if(isset($_GET['clearCart']))
{
     unset($_SESSION['cartProductNumber']);
     unset($_SESSION['cartProducts']);
     header('location: offers.php');
}    
?>




<!--
array(2)
{
     [0]=> object(stdClass)#1 (3)
      {
           ["nazwa"]=> string(9) "MARGARITA"
           ["ceny"]=> array(3)
            {
                 [0]=> object(stdClass)#2 (1) { ["mała"]=> string(5) "18zł" } 
                 [1]=> object(stdClass)#3 (1) { ["średnia"]=> string(5) "25zł" } 
                 [2]=> object(stdClass)#4 (1) { ["duża"]=> string(5) "30zł" } 
            }
            ["składniki"]=> string(38) "sos pomidorowy, ser, oregano, pomidor " 
      }
     [1]=> object(stdClass)#5 (3)
      {
           ["nazwa"]=> string(9) "PEPPERONI" 
           ["ceny"]=> array(3) 
           { 
               [0]=> object(stdClass)#6 (1) { ["mała"]=> string(5) "20zł" } 
               [1]=> object(stdClass)#7 (1) { ["średnia"]=> string(5) "27zł" } 
               [2]=> object(stdClass)#8 (1) { ["duża"]=> string(5) "35zł" } 
           } 
           ["składniki"]=> string(49) "sos pomidorowy, ser, oregano, pepperoni, papryka " 
      }
}
array(0)
  {

  } 
 array(0)
  {

  }
  array(0) {

   }
-->


<!--
array(4) 
{
     [0]=> object(stdClass)#9 (1)
      {
           ["pizze"]=> array(2)
            {
                 [0]=> object(stdClass)#1 (3)
                  {
                       ["nazwa"]=> string(9) "MARGARITA"
                        ["ceny"]=> array(3) { [0]=> object(stdClass)#2 (1) { ["mała"]=> string(5) "18zł" } [1]=> object(stdClass)#3 (1) { ["średnia"]=> string(5) "25zł" } [2]=> object(stdClass)#4 (1) { ["duża"]=> string(5) "30zł" } }
                        ["składniki"]=> string(38) "sos pomidorowy, ser, oregano, pomidor "
                  }
                  [1]=> object(stdClass)#5 (3)
                   {
                        ["nazwa"]=> string(9) "PEPPERONI" 
                        ["ceny"]=> array(3) { [0]=> object(stdClass)#6 (1) { ["mała"]=> string(5) "20zł" } [1]=> object(stdClass)#7 (1) { ["średnia"]=> string(5) "27zł" } [2]=> object(stdClass)#8 (1) { ["duża"]=> string(5) "35zł" } }
                        ["składniki"]=> string(49) "sos pomidorowy, ser, oregano, pepperoni, papryka "
                   }
            }
      }
      [1]=> object(stdClass)#10 (1)
       {
            ["sałatki"]=> array(0) { } } [2]=> object(stdClass)#11 (1) { ["napoje"]=> array(0) { } } [3]=> object(stdClass)#12 (1) { ["frytki"]=> array(0) { } } }

    -->