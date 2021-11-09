<?php
include("server.php");
$_SESSION['site'] = "offers";
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
<script src="JS/script.js" type="text/JavaScript" defer></script>
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black">
    <?php
    include('Basic Components/navbar.php');
     ?>
     
     <div class="row mt-4 mb-2 w-75 mx-auto text-start border border-2 border-secondary bg-black ">
        <div class="col-12 text-center">
            <span class="fs-2 text-light"> Menu </span>
        </div>
        <div class="border border-2 border-secondary mb-2"></div>
        
        <div class="col-12">
            <span class="fs-3 text-light">Pizze</span>
        </div>

        <?php foreach($pizzas as $pizza): ?>
            <div class="col-12 mb-2">
                <div class="row w-100">
                    <div class="col-10">
                        <div>
                        <span class="fs-4 text-success"> <?= $pizza->nazwa; ?> </span> <span class="fs-4 text-light"><?= $pizza->składniki ?> </span>
                        </div>
                        
                        <span class="text-warning">
                            <?php foreach($pizza->ceny as $cena): ?>
                                <?= $cena; ?>
                            <?php endforeach ?>
                        </span>
                    </div>

                    <div class="col-2 d-flex p-0 justify-content-end">
                        <button class="ml-2 btn btn-success" onclick="makeOrder('<?= $pizza->nazwa; ?>','pizza')">Zamów teraz</button> 
                    </div>
                </div>         
            </div>
        <?php endforeach; ?>

        <div class="col-12 mt-4">
            <span class="fs-3 text-light">Sałatki</span>

            <?php foreach($salades as $salade): ?>
            <div class="col-12 mb-2">
                <div class="row w-100">
                    <div class="col-10">
                        <div>
                        <span class="fs-4 text-success"> <?= $salade->nazwa; ?> </span> <span class="fs-4 text-light"><?= $salade->składniki ?> </span>
                        </div>
                        
                        <span class="text-warning">
                            <?php foreach($salade->ceny as $cena): ?>
                                <?= $cena; ?>
                            <?php endforeach ?>
                        </span>
                    </div>

                    <div class="col-2 d-flex p-0 justify-content-end">
                        <button class="ml-2 btn btn-success" onclick="makeOrder('<?= $salade->nazwa; ?>','salade')">Zamów teraz</button>
                    </div>
                </div>         
            </div>
        <?php endforeach; ?>
        </div>

        <div class="col-12 mt-4">
            <span class="fs-3 text-light">Frytki</span>

            <?php foreach($chips as $ch): ?>
                <div class="col-12 mb-2">
                    <div class="row w-100">
                        <div class="col-10">
                            <div>
                            <span class="fs-4 text-success"> <?= $ch->nazwa; ?> </span> <span class="fs-4 text-light"><?= $ch->składniki ?> </span>
                            </div>
                            
                            <span class="text-warning">
                                <?php foreach($ch->ceny as $cena): ?>
                                    <?= $cena; ?>
                                <?php endforeach ?>
                            </span>
                        </div>

                        <div class="col-2 d-flex p-0 justify-content-end">
                            <button class="ml-2 btn btn-success" onclick="makeOrder('<?= $ch->nazwa; ?>','chips')">Zamów teraz</button>
                        </div>
                    </div>         
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-12 mt-4 mb-4">
            <span class="fs-3 text-light">Napoje</span>

            <?php foreach($drinks as $drink): ?>
                <div class="col-12 mb-2">
                    <div class="row w-100">
                        <div class="col-10">
                            <div>
                            <span class="fs-4 text-success"> <?= $drink->nazwa; ?> </span> <span class="fs-4 text-light"><?= $drink->składniki ?> </span>
                            </div>
                            
                            <span class="text-warning">
                                <?php foreach($drink->ceny as $cena): ?>
                                    <?= $cena; ?>
                                <?php endforeach ?>
                            </span>
                        </div>

                        <div class="col-2 d-flex p-0 justify-content-end">
                            <button class="ml-2 btn btn-success" onclick="makeOrder('<?= $drink->nazwa; ?>','drink')">Zamów teraz</button>
                        </div>
                    </div>         
                </div>
            <?php endforeach; ?>
        </div>
     </div>
</div>

<div class="fixed-bottom shopCart text-end text-success mb-4">
    <a href="cart.php" class="text-reset text-decoration-none">
    <span class="text-light fs-3"> Koszyk (<?= $_SESSION['cartProductNumber'] ?>) </span>
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </svg>
    </a>
</div>



<?php
include('Basic Components/footer.php');
?>
</body>