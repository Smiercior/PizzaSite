<?php
//// Session variables ////
session_start();
if(!isset($_SESSION['cartProductNumber']))
{
     $_SESSION['cartProductNumber'] = 0;
}
if(!isset($_SESSION['cartProducts']))
{
     $_SESSION['cartProducts'] = " ";
}
$_SESSION['filterOption'] = "Wszystkie";

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

// Log in - login.php
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
     if(password_verify($password,$pass[0])) // Correct password
     {
          // Set session variables
          $_SESSION['username'] = $username;
          $userData = "SELECT id,email,phone,city,street,houseNumber,role from user where username='$username' limit 1";
          $result = $connection->query($userData);
          $data = mysqli_fetch_row($result);
          $_SESSION['userId'] = $data[0];
          $_SESSION['email'] = $data[1];
          $_SESSION['phone'] = $data[2];
          $_SESSION['city'] = $data[3];
          $_SESSION['street'] = $data[4];
          $_SESSION['houseNumber'] = $data[5];
          $_SESSION['role'] = $data[6];

          unset($result);
          unset($pass);
          header('location: index.php');
     }
     else // Incorrect password
     {
          unset($result);
          unset($pass);
          array_push($errors, "Niepoprawny login lub hasło");
     }  
}

// Register - register.php
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
     elseif($password != $rePassword) array_push($errors, "Hasła nie są takie same");
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
               if($connection->query($sqlInsert) === TRUE) // User account created
               {
                    $_SESSION['success'] = "Udało ci się utworzyć konto";
                    header('location: index.php'); 
               }
               else // Some error occured
               {
                    array_push($errors, "Nie udało się stworzyć konta");
               }       
          }     
     }
}

// Logout - navbar.php
if(isset($_GET['logout']))
{
    session_destroy();
    //unset($_SESSION['username']);
    header('location: index.php');
}

// For order.php, store chosen product name using JS/script.js - offers.php
if(isset($_POST['productName']))
{
     $_SESSION['productName'] = $_POST['productName'];
     $_SESSION['productComposition'] = $_POST['productComposition'];
     $_SESSION['productPrice'] = $_POST['productPrice'];
     $_SESSION['productImg'] = $_POST['productImg'];   
}

// Add item to cart - order.php
if(isset($_POST['addToCart']))
{
     $_SESSION['cartProductNumber'] = ($_SESSION['cartProductNumber'] + 1);
     $_SESSION['cartProducts'] = $_SESSION['cartProducts'] . $_SESSION['productName'] . "-" . $_POST['size'] . ",";
     header('location: offers.php');
}

// Remove item from cart - cart.php
if(isset($_POST['removeFromCart']))
{
     // Get data
     $delProduct = $_POST['delProduct'];
     $productsArray = explode(",",$_SESSION['cartProducts']);
     $newCartProducts = "";

     // Delete certain product from cart and save other products to temp string
     foreach($productsArray as $product)
     {
          if($product != $delProduct) // Add to cart all products excluding delProduct
          {
               $newCartProducts = $newCartProducts . $product . ",";
          }
          else // Decrease product numbers in cart if delProduct was detected
          {
               $_SESSION['cartProductNumber'] -= 1;
          } 
     }

     // Save all products from old cart to new cart without delProduct
     $newCartProducts = substr($newCartProducts,0,-1); // Remove additional ','
     $_SESSION['cartProducts'] = $newCartProducts;
     header('location: cart.php');     
}

// Clear cart - cart.php
if(isset($_GET['clearCart']))
{
     unset($_SESSION['cartProductNumber']);
     unset($_SESSION['cartProducts']);
     header('location: offers.php');
} 

// Get user orders and show then on the site - myOrders.php
function getUserOrders($connection) // Get all user orders
{
     if($_SESSION['role'] == "user")
     {
          $sqlGetOrders = "SELECT o.id,o.products,o.price,o.type,o.email,o.phone,o.city,o.street,o.houseNumber,o.date,o.status from ord o join user u on u.id = o.userId where username='{$_SESSION['username']}'";
     }
     elseif($_SESSION['role'] == "sell")
     {
          $sqlGetOrders = "SELECT o.id,o.products,o.price,o.type,o.email,o.phone,o.city,o.street,o.houseNumber,o.date,o.status,u.username from ord o join user u on u.id = o.userId";
     }
     
     $result = $connection->query($sqlGetOrders);
     $data = mysqli_fetch_all($result);
     $_SESSION['orders'] = $data;
}

function getFilteredUserOrders($connection,$filter) // Get filtered user orders
{
     if($filter == "Wszystkie")
     {
          if($_SESSION['role'] == "user")
          {
               $sqlGetOrders = "SELECT o.id,o.products,o.price,o.type,o.email,o.phone,o.city,o.street,o.houseNumber,o.date,o.status from ord o join user u on u.id = o.userId where username='{$_SESSION['username']}'";
          }
          elseif($_SESSION['role'] == "sell")
          {
               $sqlGetOrders = "SELECT o.id,o.products,o.price,o.type,o.email,o.phone,o.city,o.street,o.houseNumber,o.date,o.status,u.username from ord o join user u on u.id = o.userId";
          }
     }
     else
     {
          $conditionUser = "";
          $conditionSell = "";
          if($filter == "Nie zaakceptowane") $condition = "o.status='Nie zaakceptowany'";
          elseif($filter == "Przygotowywanie") $condition = "o.status='Przygotowywanie'";
          elseif($filter == "Do odebrania") $condition = "o.status='Do odebrania'";
          elseif($filter == "W drodze") $condition = "o.status='W drodze'";
          elseif($filter == "Zrealizowane") $condition = "o.status='Zrealizowane'";

          if($_SESSION['role'] == "user")
          {
               $sqlGetOrders = "SELECT o.id,o.products,o.price,o.type,o.email,o.phone,o.city,o.street,o.houseNumber,o.date,o.status from ord o join user u on u.id = o.userId where username='{$_SESSION['username']}' and {$condition}";
          }
          elseif($_SESSION['role'] == "sell")
          {
               $sqlGetOrders = "SELECT o.id,o.products,o.price,o.type,o.email,o.phone,o.city,o.street,o.houseNumber,o.date,o.status,u.username from ord o join user u on u.id = o.userId where {$condition}";
          }
     }
     
     
     $result = $connection->query($sqlGetOrders);
     $data = mysqli_fetch_all($result);
     $_SESSION['orders'] = $data;
}

if(isset($_POST['getUserOrders']))
{
     header('location: myOrders.php'); 
}

// Make order to DB - cart.php
if(isset($_POST['makeOrder']))
{
     // Get order data
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $deliveryType = $_POST['delivery'];
     $price = $_POST['price'];

     // Send order to DB
     if($deliveryType == "self") // Delivery self - email, phone
     {
          if($price == 0.0 ) array_push($errors, "Musisz mieć chociaż jeden produkt w koszyku");
          elseif($email == "" ) array_push($errors, "Musisz podać adres email");
          elseif(strlen($phone) != 9 ) array_push($errors, "Musisz podać prawidłowy numer telefonu");
          if(isset($_SESSION['username'])) // User logged in
          {
               $sqlInsert = "INSERT INTO ord (userId,type,price,products,email,phone,date,status) VALUES ('{$_SESSION['userId']}','$deliveryType',$price,'{$_SESSION['cartProducts']}','$email','$phone',NOW(),'Nie zaakceptowany')";    
          }
          else // User isn't logged in
          {
               $sqlInsert = "INSERT INTO ord (type,price,products,email,phone,date,status) VALUES ('$deliveryType',$price,'{$_SESSION['cartProducts']}','$email','$phone',NOW(),'Nie zaakceptowany')";    
          }
          
     }
     elseif($deliveryType == "courier") // Delivery by courier - email, phone, city, street, houseNumber
     {
          $city = $_POST['city'];
          $street = $_POST['street'];
          $houseNumber = $_POST['houseNumber'];

          if($price == 0.0 ) array_push($errors, "Musisz mieć chociaż jeden produkt w koszyku");
          elseif($email == "" ) array_push($errors, "Musisz podać adres email");
          elseif(strlen($phone) != 9 ) array_push($errors, "Musisz podać prawidłowy numer telefonu");
          elseif($city == "" ) array_push($errors, "Musisz podać miasto");
          elseif($street == "" ) array_push($errors, "Musisz podać ulicę");
          elseif($houseNumber == "" ) array_push($errors, "Musisz podać numer domu"); 
          if(isset($_SESSION['username'])) // User logged in
          {
               $sqlInsert = "INSERT INTO ord (userId,type,price,products,email,phone,city,street,houseNumber,date,status) VALUES ('{$_SESSION['userId']}','$deliveryType',$price,'{$_SESSION['cartProducts']}','$email','$phone','$city','$street','$houseNumber',NOW(),'Nie zaakceptowany')";
          }
          else // User isn't logged in
          {
               $sqlInsert = "INSERT INTO ord (type,price,products,email,phone,city,street,houseNumber,date,status) VALUES ('$deliveryType',$price,'{$_SESSION['cartProducts']}','$email','$phone','$city','$street','$houseNumber',NOW(),'Nie zaakceptowany')";
          }    
          
     }

     if(count($errors) == 0) // If data is correct
     {
          if($connection->query($sqlInsert) === TRUE)  // Order was send to DB
          {
               $_SESSION['success'] = "Zamówienie zostało złożone";
               unset($_SESSION['cartProductNumber']);
               unset($_SESSION['cartProducts']);
               header('location: offers.php'); 
          }
          else // Some error occured
          {
               $_SESSION['error'] = "Nie udało się złożyć zamówienia";
               header('location: offers.php');
          } 
     }




     // Check if user is logged in
     if(isset($_SESSION['username'])) // User logged in
     {

     }
     else // User isn't logged in
     {
          
          
     }
}

// Change order's status and send email to user - only role 'sell' can do that - myOrders.php
if(isset($_POST['changeOrderStatus']))
{
     if($_SESSION['role'] == "sell") // Check if user have role : sell ( seller )
     {
          // Update order status in DB
          $sqlChangeOrderStatus = "UPDATE ord SET status='{$_POST['status']}' where id='{$_POST['orderId']}'";
          if($connection->query($sqlChangeOrderStatus) === TRUE) // If order was updated
          {
               $_SESSION['success'] = "Status zamówienia '" . $_POST['orderId'] . "' zmieniony";

               // Send email to user, if certain status was selected
               if($_POST['status'] == "Do odebrania" | $_POST['status'] == "W drodze") 
               {
                    // Get order data
                    $sqlGetOrderData = "SELECT products,price,email,city,street,houseNumber from ord where id='{$_POST['orderId']}'";
                    $result = $connection->query($sqlGetOrderData);
                    $data = mysqli_fetch_row($result);

                    // Send email to user
                    $ini = parse_ini_file("app.ini");
                    $sendEmailToUser = $ini['sendEmailToUser'];
                    if($sendEmailToUser)
                    {
                         $to = $data[2]; //"smiercior@gmail.com"
                         $from = "smiercior44@gmail.com";
                         $fromName = "BestPizza";
                         $subject = "BestPizza - Twoje zamówienie jest gotowe!";
                         $message = "Witamy tu BestPizza!\nTwoje zamówienie nr.{$_POST['orderId']} jest : {$_POST['status']}";
                         $message = $message . "\nDANE ZAMÓWIENIA:\n";
                         $message = $message . "\n• Produkty: $data[0] \n";
                         $message = $message . "\n• Cena: $data[1]zł \n";
                         if($data[3] != "") $message = $message . "\n• Adres dostawy: $data[3], $data[4] $data[5] \n";
                         $message = $message . "\nŻyczymy miłego dnia :D";
                         include("sendMail.php");
                         sendSMTPMail($to,$from,$fromName,$subject,$message);      
                    }
               }
          } // If error occured
          else 
          {
               $_SESSION['error'] = "Nie udało się zmienić statusu zamówienia '" . $_POST['orderId'] . "'";
          }   
     }
}

// Change profile data - account.php
if(isset($_POST['changeProfile']))
{
     // Update user data in DB
     $sqlUpdate = "UPDATE user SET phone ='{$_POST['phone']}' ,city='{$_POST['city']}', street='{$_POST['street']}', houseNumber='{$_POST['houseNumber']}' where username='{$_SESSION['username']}'";
     if($connection->query($sqlUpdate) === TRUE) // If data was updated
     {
          $_SESSION['success'] = "Dane zostały zapisane";
          $_SESSION['phone'] = $_POST['phone'];
          $_SESSION['city'] = $_POST['city'];
          $_SESSION['street'] = $_POST['street'];
          $_SESSION['houseNumber'] = $_POST['houseNumber'];
     }
     else  // If error occured
     {
          //var_dump($connection->error);
          array_push($errors, "Nie udało się zmienić danych");
     }     
}

// Change user email - accountEmail.php
if(isset($_POST['changeEmail']))
{
     // Change user email in DB
     $sqlUpdate = "UPDATE user SET email='{$_POST['email']}' where username='{$_SESSION['username']}'";
     if($connection->query($sqlUpdate) === TRUE) // If user email was updated
     {
          $_SESSION['success'] = "Email został zmieniony";
          $_SESSION['email'] = $_POST['email'];
          header('location: account.php');
     }
     else // If error occured
     {
          //var_dump($connection->error);
          array_push($errors, "Nie udało się zmienić emaila");
          header('location: account.php');
     }     
}

// Delete user account - accountDel.php
if(isset($_POST['deleteAccount']))
{
     // Delete user account from DB
     $sqlDel = "DELETE from user where username='{$_SESSION['username']}'";
     if($connection->query($sqlDel) === TRUE) // If user account was deleted 
     {
          session_destroy();
          session_start();
          $_SESSION['success'] = "Konto zostało pomyślnie usunięte";
          header('location: index.php'); 
     }
     else // If error occured
     {
          $_SESSION['error'] = "Nie udało się usunąc konta";
          header('location: index.php'); 
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




