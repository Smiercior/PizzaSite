<?php
include('server.php');
$_SESSION['site'] = "myOrders";
if(!isset($_SESSION['username'])) header('location: login.php');
getUserOrders($connection);

// Get filtered user orders and show them on the site - myOrders.php
if(isset($_POST['filterOrders']))
{
    $_SESSION['filterOption'] = $_POST['filterOption'];
    getFilteredUserOrders($connection,$_POST['filterOption']); 
}   

?>
 
<!DOCTYPE html>
<html>

<head>
<title>Tasty pizza</title>
<meta charset="utf-8">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="CSS/myOrders.css">
</head>

<body>

<div class="container-fluid overflow-hidden px-0 bg-black log-container">
    <?php
    include('Basic Components/navbar.php');
    ?>

    <div class="row w-100 m-0 justify-content-center">
        <div class="col-12 text-center mt-2 p-0">
            <form method="POST">
                <select class="btn-outline-primary btn text-start" name="filterOption">
                    <option value="Nie zaakceptowane" <?php if($_SESSION['filterOption'] == "Nie zaakceptowane"):?> selected <?php endif; ?> >Nie zaakceptowane</option>
                    <option value="Przygotowywanie" <?php if($_SESSION['filterOption'] == "Przygotowywanie"):?> selected <?php endif; ?> >Przygotowywanie</option>
                    <option value="Do odebrania" <?php if($_SESSION['filterOption'] == "Do odebrania"):?> selected <?php endif; ?> >Do odebrania</option>
                    <option value="W drodze" <?php if($_SESSION['filterOption'] == "W drodze"):?> selected <?php endif; ?> >W drodze</option>
                    <option value="Zrealizowane" <?php if($_SESSION['filterOption'] == "Zrealizowane"):?> selected <?php endif; ?> >Zrealizowane</option>
                    <option value="Wszystkie" <?php if($_SESSION['filterOption'] == "Wszystkie"):?> selected <?php endif; ?>>Wszystkie zamówienia</option>
                </select>
                <input type="submit" class="btn-outline-primary btn" name="filterOrders" value="Filtruj">
            </form>
        </div>
    </div>
    

    <?php if(isset($_SESSION['success'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2 span5"><span class="text-success"><?= $_SESSION['success'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2 span5"><span class="text-danger"><?= $_SESSION['error'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif ?>
    
    <?php foreach(array_reverse($_SESSION['orders']) as $order): ?>
        <div class="row w-25 mt-4 mb-2 mx-auto text-center border border-2 border-secondary bg-black ">
            <div class="col-12 border border-2 border-secondary">
                <span class="span5 text-light"> Zamówienie <span class="text-primary">#<?= $order[0] ?> </span> </span>
            </div>

            <?php if($_SESSION['role'] == "sell"): ?>
                <div class="col-12 text-start">
                    <span class="span6 text-light"> Użytkownik: <span class="text-primary"><?= $order[11] ?></span>
                </div>
            <?php endif; ?>

            <div class="col-12 text-start">
                <span class="span6 text-light"> Produkty: </span>
            </div>

            <?php foreach(explode(",",$order[1]) as $product): ?>
                <div class="col-12 text-start">
                    <?php if($product != ""): ?>
                        <span class="text-info span6">&#8226 <?= $product ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <div class="col-12 text-start">
                <span class="span6 text-light"> Cena: <span class="span6 text-info"> <?= $order[2] ?>zł </span> </span>
            </div>  

            <div class="col-12 text-start">
                <span class="span6 text-light"> Typ: 
                    <span class="span6 text-info">
                         <?php
                            if($order[3]  == "self") echo "Odbiór osobisty";
                            elseif($order[3] == "courier") echo "Kurier"; 
                         ?>
                    </span>
                </span>
            </div>

            <div class="col-12 text-start">
                <span class="span6 text-light"> Email: <span class="span6 text-info"> <?= $order[4] ?></span> </span>
            </div>
            
            <div class="col-12 text-start">
                <span class="span6 text-light"> Telefon: <span class="span6 text-info"> <?= $order[5] ?></span> </span>
            </div> 

            <?php if($order[6] != ""): ?>
            <div class="col-12 text-start">
                <span class="span6 text-light"> Adres dostawy: <span class="span6 text-info"> <?= $order[6] ?>, <?= $order[7] ?> <?= $order[8] ?></span> </span>
            </div>
            <?php endif; ?>

            <div class="col-12 text-start">
                <span class="span6 text-light"> Data złożenia: <span class="span6 text-info"> <?= $order[9] ?></span> </span>
            </div>
            
            <div class="col-12 text-start mb-1">
                <span class="span6 text-light"> Status:
                    <?php if($order[10]  == "Nie zaakceptowany"): ?>    
                        <span class="span6 text-danger"><?= $order[10] ?></span>
                    <?php elseif($order[10]  == "Przygotowywanie"): ?>    
                        <span class="span6 text-warning"><?= $order[10] ?></span>
                    <?php elseif($order[10]  == "W drodze" or $order[10]  == "Do odebrania"): ?>    
                        <span class="span6 text-success"><?= $order[10] ?></span>
                    <?php elseif($order[10]  == "Zrealizowane"): ?>    
                        <span class="span6 text-muted"><?= $order[10] ?></span>
                    <?php endif; ?>       
                </span>
            </div>

            <?php if($_SESSION['role'] == "sell"): ?>
                
                    <form method="POST">
                        <div class="row">
                            <div class="col-12 mt-1">
                                <select class="btn-outline-danger text-start btn btnMO" id="statusSelect" name="status">
                                    <option value="Nie zaakceptowany">Nie zaakceptowany</option>
                                    <option value="Przygotowywanie">Przygotowywanie</option>
                                    <?php if($order[3]  == "courier"): ?>
                                        <option value="W drodze">W drodze</option>
                                    <?php elseif($order[3]  == "self"): ?>
                                        <option value="Do odebrania">Do odebrania</option>
                                    <?php endif; ?>
                                    <option value="Zrealizowane">Zrealizowane</option>
                                </select>
                            </div>

                            <div class="col-12 mt-1 mb-2">
                                <input name="orderId" value="<?= $order[0] ?>" hidden>
                                <input type="submit" class="btn-outline-success btn btnMO" name="changeOrderStatus" value="Zatualizuj status">
                            </div>
                        </div>     
                    </form>
                
            <?php endif; ?>
        </div>
    <?php endforeach ?>
</div>

<?php
include('Basic Components/footer.php');
?>

<!-- JavaScript Bundle with Popper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
<script src="JS/myOrders.js" type="text/JavaScript"></script>


</body>



