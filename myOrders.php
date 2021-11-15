<?php
include('server.php');
$_SESSION['site'] = "myOrders";
if(!isset($_SESSION['username'])) header('location: login.php');
getUserOrders($connection)
?>
 
<!DOCTYPE html>
<html>

<head>
<title>Tasty pizza</title>
<meta charset="utf-8">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

<!-- JavaScript Bundle with Popper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
<script src="JS/myOrders.js" type="text/JavaScript" defer></script>
</head>

<body>

<div class="container-fluid overflow-hidden px-0 bg-black log-container">
    <?php
    include('Basic Components/navbar.php');
    ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2 fs-5"><span class="text-success"><?= $_SESSION['success'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2 fs-5"><span class="text-danger"><?= $_SESSION['error'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif ?>
    
    <?php foreach(array_reverse($_SESSION['orders']) as $order): ?>
        <div class="row w-25 mt-4 mb-2 mx-auto text-center border border-2 border-secondary bg-black ">
            <div class="col-12 border border-2 border-secondary">
                <span class="fs-5 text-light"> Zamówienie <span class="text-primary">#<?= $order[0] ?> </span> </span>
            </div>

            <?php if($_SESSION['role'] == "sell"): ?>
                <div class="col-12 text-start">
                    <span class="fs-6 text-light"> Użytkownik: <span class="text-primary"><?= $order[9] ?></span>
                </div>
            <?php endif; ?>

            <div class="col-12 text-start">
                <span class="fs-6 text-light"> Produkty: </span>
            </div>

            <?php foreach(explode(",",$order[1]) as $product): ?>
                <div class="col-12 text-start">
                    <?php if($product != ""): ?>
                        <span class="text-info">&#8226 <?= $product ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <div class="col-12 text-start">
                <span class="fs-6 text-light"> Cena: <span class="fs-6 text-info"> <?= $order[2] ?>zł </span> </span>
            </div>  

            <div class="col-12 text-start">
                <span class="fs-6 text-light"> Typ: 
                    <span class="fs-6 text-info">
                         <?php
                            if($order[3]  == "self") echo "Odbiór osobisty";
                            elseif($order[3] == "courier") echo "Kurier"; 
                         ?>
                    </span>
                </span>
            </div>

            <div class="col-12 text-start">
                <span class="fs-6 text-light"> Email: <span class="fs-6 text-info"> <?= $order[4] ?></span> </span>
            </div> 

            <?php if($order[5] != ""): ?>
            <div class="col-12 text-start">
                <span class="fs-6 text-light"> Adres dostawy: <span class="fs-6 text-info"> <?= $order[5] ?>, <?= $order[6] ?> <?= $order[7] ?></span> </span>
            </div>
            <?php endif; ?>
            
            <div class="col-12 text-start mb-1">
                <span class="fs-6 text-light"> Status:
                    <?php if($order[8]  == "Nie zaakceptowany"): ?>    
                        <span class="fs-6 text-danger"><?= $order[8] ?></span>
                    <?php elseif($order[8]  == "Przygotowywanie"): ?>    
                        <span class="fs-6 text-warning"><?= $order[8] ?></span>
                    <?php elseif($order[8]  == "W drodze" or $order[8]  == "Do odebrania"): ?>    
                        <span class="fs-6 text-success"><?= $order[8] ?></span>
                    <?php elseif($order[8]  == "Zrealizowane"): ?>    
                        <span class="fs-6 text-muted"><?= $order[8] ?></span>
                    <?php endif; ?>       
                </span>
            </div>

            <?php if($_SESSION['role'] == "sell"): ?>
                
                    <form method="POST">
                        <div class="row">
                            <div class="col-12 mt-1">
                                <select class="btn-outline-danger btn" id="statusSelect" name="status">
                                    <option value="Nie zaakceptowany">Nie zaakceptowany</option>
                                    <option value="Przygotowywanie">Przygotowywanie</option>
                                    <option value="W drodze">W drodze</option>
                                    <option value="Do odebrania">Do odebrania</option>
                                    <option value="Zrealizowane">Zrealizowane</option>
                                </select>
                            </div>

                            <div class="col-12 mt-1 mb-2">
                                <input name="orderId" value="<?= $order[0] ?>" hidden>
                                <input type="submit" class="btn-outline-success btn" name="changeOrderStatus" value="Zatualizuj status">
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


</body>



