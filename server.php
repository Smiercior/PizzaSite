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
$errors = array();
include('databaseConnection.php');

//// Routes, Requests ////

// Log in 
if(isset($_POST['log']))
{
     // Get user input
     $username = mysqli_real_escape_string($connection,$_POST['username']);
     $password = mysqli_real_escape_string($connection,$_POST['password']);

     // Get user data from DB
     $userExist = "SELECT pass from user where username='$username' limit 1";
     $result = $connection->query($userExist);
     $pass = mysqli_fetch_row($result);
     
     // Check password
     if(password_verify($password,$pass[0]))
     {
          // Set session variables
          $_SESSION['username'] = $username;
          $userData = "SELECT email,city,street,houseNumber from user where username='$username' limit 1";
          $result = $connection->query($userData);
          $data = mysqli_fetch_row($result);
          $_SESSION['email'] = $data[0];
          $_SESSION['city'] = $data[1];
          $_SESSION['street'] = $data[2];
          $_SESSION['houseNumber'] = $data[3];

          unset($result);
          unset($pass);
          header('location: index.php');
     }
     else
     {
          unset($result);
          unset($pass);
          array_push($errors, "Niepoprawny login lub hasło");
     }  
}

// Register
if(isset($_POST['register']))
{
     // Get user input
     $username = mysqli_real_escape_string($connection,$_POST['username']);
     $email = mysqli_real_escape_string($connection,$_POST['email']);
     $password = mysqli_real_escape_string($connection,$_POST['password']);
     $rePassword = mysqli_real_escape_string($connection,$_POST['rePassword']);

     // Check if data is correct
     if(empty($username)) array_push($errors, "Musisz podać nazwę użytkownika");
     elseif(empty($email)) array_push($errors, "Musisz podać email");
     elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) array_push($errors, "Niepoprawny format emaila");
     elseif(empty($password)) array_push($errors, "Musisz podać hasło");
     elseif($password != $rePassword) array_push($errors, "Hasła nie są takie samie");
     else 
     {
          // Check if username or email already exist
          $duplicateUsernameCheck = "SELECT * from user where username='$username' limit 1";
          $duplicateEmailCheck = "SELECT * from user where email='$email' limit 1";
          $result = $connection->query($duplicateUsernameCheck);
          $user = mysqli_fetch_row($result);
          $result = $connection->query($duplicateEmailCheck);
          $em = mysqli_fetch_row($result);
          if($user) array_push($errors, "Taki użytkownik już istnieje");
          elseif($em) array_push($errors, "Taki email już istnieje");

          // Create new user
          else 
          {
               $hashPassword = password_hash($password,PASSWORD_BCRYPT); // PASSWORD_BCRYPT - lenght 60
               $sqlInsert = "INSERT INTO user (username,pass,email,role) VALUES ('$username','$hashPassword','$email','user')";
               if($connection->query($sqlInsert) === TRUE)
               {
                    $_SESSION['success'] = "Udało ci się utworzyć konto";
                    header('location: index.php'); 
               }
               else 
               {
                    array_push($errors, "Nie udało się stworzyć konta");
               }       
          }     
     }
}

// Logout
if(isset($_GET['logout']))
{
    session_destroy();
    //unset($_SESSION['username']);
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

// Change profile data
if(isset($_POST['changeProfile']))
{
     $sqlUpdate = "UPDATE user SET city='{$_POST['city']}', street='{$_POST['street']}', houseNumber='{$_POST['houseNumber']}' where username='{$_SESSION['username']}'";
     if($connection->query($sqlUpdate) === TRUE)
     {
          $_SESSION['success'] = "Dane zostały zapisane";
          $_SESSION['city'] = $_POST['city'];
          $_SESSION['street'] = $_POST['street'];
          $_SESSION['houseNumber'] = $_POST['houseNumber'];
     }
     else 
     {
          //var_dump($connection->error);
          array_push($errors, "Nie udało się zmienić danych");
     }     
}







// <!--
// array(2)
// {
//      [0]=> object(stdClass)#1 (3)
//       {
//            ["nazwa"]=> string(9) "MARGARITA"
//            ["ceny"]=> array(3)
//             {
//                  [0]=> object(stdClass)#2 (1) { ["mała"]=> string(5) "18zł" } 
//                  [1]=> object(stdClass)#3 (1) { ["średnia"]=> string(5) "25zł" } 
//                  [2]=> object(stdClass)#4 (1) { ["duża"]=> string(5) "30zł" } 
//             }
//             ["składniki"]=> string(38) "sos pomidorowy, ser, oregano, pomidor " 
//       }
//      [1]=> object(stdClass)#5 (3)
//       {
//            ["nazwa"]=> string(9) "PEPPERONI" 
//            ["ceny"]=> array(3) 
//            { 
//                [0]=> object(stdClass)#6 (1) { ["mała"]=> string(5) "20zł" } 
//                [1]=> object(stdClass)#7 (1) { ["średnia"]=> string(5) "27zł" } 
//                [2]=> object(stdClass)#8 (1) { ["duża"]=> string(5) "35zł" } 
//            } 
//            ["składniki"]=> string(49) "sos pomidorowy, ser, oregano, pepperoni, papryka " 
//       }
// }
// array(0)
//   {

//   } 
//  array(0)
//   {

//   }
//   array(0) {

//    }
// -->


// <!--
// array(4) 
// {
//      [0]=> object(stdClass)#9 (1)
//       {
//            ["pizze"]=> array(2)
//             {
//                  [0]=> object(stdClass)#1 (3)
//                   {
//                        ["nazwa"]=> string(9) "MARGARITA"
//                         ["ceny"]=> array(3) { [0]=> object(stdClass)#2 (1) { ["mała"]=> string(5) "18zł" } [1]=> object(stdClass)#3 (1) { ["średnia"]=> string(5) "25zł" } [2]=> object(stdClass)#4 (1) { ["duża"]=> string(5) "30zł" } }
//                         ["składniki"]=> string(38) "sos pomidorowy, ser, oregano, pomidor "
//                   }
//                   [1]=> object(stdClass)#5 (3)
//                    {
//                         ["nazwa"]=> string(9) "PEPPERONI" 
//                         ["ceny"]=> array(3) { [0]=> object(stdClass)#6 (1) { ["mała"]=> string(5) "20zł" } [1]=> object(stdClass)#7 (1) { ["średnia"]=> string(5) "27zł" } [2]=> object(stdClass)#8 (1) { ["duża"]=> string(5) "35zł" } }
//                         ["składniki"]=> string(49) "sos pomidorowy, ser, oregano, pepperoni, papryka "
//                    }
//             }
//       }
//       [1]=> object(stdClass)#10 (1)
//        {
//             ["sałatki"]=> array(0) { } } [2]=> object(stdClass)#11 (1) { ["napoje"]=> array(0) { } } [3]=> object(stdClass)#12 (1) { ["frytki"]=> array(0) { } } }

//     -->
?>




