<?php
include("server.php");
$_SESSION['site'] = "offers";
$allCategories = array($pizzas, $salades, $chips, $drinks);
 ?>
<!DOCTYPE html>
<html>

<head>
<title>Tasty pizza</title>
<meta charset="utf-8">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="CSS/offers.css">

<!-- JavaScript Bundle with Popper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
<script src="JS/script.js" type="text/JavaScript" defer></script>
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black">
    <?php
    include('Basic Components/navbar.php');
     ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2"><span class="text-success"><?= $_SESSION['success'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2"><span class="text-danger"><?= $_SESSION['error'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif ?>
     
     <div class="row mt-4 mb-2 w-75 mx-auto text-start border border-2 border-secondary bg-black ">
        <div class="col-12 text-center">
            <span class="text-light span2 "> Menu </span>
        </div>
        <div class="border border-2 border-secondary mb-2"></div>


        <?php $i = 0; foreach($allCategories as $category):?>
            <div class="col-12 <?php if($i != 0): ?>mt-5 <?php endif; ?>">
                <?php if(++$i == 1): ?>
                    <span class="span3 text-light">Pizze</span>
                <?php elseif($i == 2): ?>
                    <span class="span3 text-light">Sałatki</span>
                <?php elseif($i == 3): ?>
                    <span class="span3 text-light">Frytki</span>
                <?php elseif($i == 4): ?>
                    <span class="span3 text-light">Napoje</span>
                <?php endif; ?>
            </div>

            <?php foreach($category as $product): ?>
                <div class="col-12 mb-2 colSM">
                    <div class="row w-100">
                        <div class="col-10">
                            <div class="col-12 colSm">
                                <span class="span4 text-success"> <?= $product->nazwa; ?> </span> 
                            </div>

                            <div class="col-12 colSm">
                                <span class="span4 text-light"><?= $product->składniki ?> </span>
                            </div>

                            <div class="col-12 colSm">
                                <span class="span5 text-warning">
                                    <?php foreach($product->ceny as $cena): ?>
                                        <?= $cena; ?>
                                    <?php endforeach ?>
                                </span>
                            </div>
                        </div>

                        <div class="col-2 p-0 justify-content-end">
                            <?php $priceString = ""; foreach($product->ceny as $cena){ $priceString = $priceString . $cena . ","; } ?> 
                            <button class="ml-2 btn btn-success btnSm" onclick="makeOrder('<?= $product->nazwa; ?>','<?= $product->składniki; ?>','<?= $priceString ?>','<?= $product->zdjęcie; ?>')">Zamów teraz</button> 
                        </div>
                    </div>         
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>   
        </div>
     </div>
</div>

<div class="fixed-bottom shopCart text-end text-success cartDiv">
    <a href="cart.php" class="text-reset text-decoration-none">
    <span class="text-light cartText"> Koszyk (<?= $_SESSION['cartProductNumber'] ?>) </span>
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart cartIcon" viewBox="0 0 16 16">
    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </svg>
    </a>
</div>



<?php
include('Basic Components/footer.php');
?>
</body>