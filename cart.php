<?php
include("server.php");
$_SESSION['site'] = "order";
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
<script src="JS/cart.js" type="text/JavaScript" defer></script>
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black">
    <?php
    include('Basic Components/navbar.php');
     ?>

    <div class="row w-25 mt-4 mb-4 border mx-auto">
        <div class="p-2 col-12 text-start ml-2 bg-dark border">
            <span class="text-light fs-4">Twoje zamówienia</span>
        </div>

        <div class="col-12 text-center text-warning mt-1">
            <?php if($_SESSION['cartProducts'] != " "): ?>
                <?php $productsArray = explode(",",$_SESSION['cartProducts']) ?>
                <?php foreach($productsArray as $product): ?>
                    <div class="col-12 text-primary fs-5"><?= $product ?></div>
                <?php endforeach ?>
                
            <?php else: ?>
                <span class="text-danger fs-5">Brak produktów</span>
            <?php endif ?>
        </div>
            
        <div class="p-2 col-12 text-start ml-2 bg-dark border mt-2">
            <span class="text-light fs-4">Sposób realizacji</span>
        </div>

        <form class="m-0 p-0" method="POST">
            <div class="col-12 text-center text-warning mt-2">
                <div class="form-check w-50 mx-auto text-start">
                    <input class="form-check-input" type="radio" name="delivery" value="self" id="delivery1" checked>
                    <label class="form-check-label text-light" for="flexRadioDefault1">
                        Odbiór osobisty
                    </label>
                </div>
                <div class="form-check w-50 mx-auto text-start">
                    <input class="form-check-input" type="radio" name="delivery" value="courier" id="delivery2">
                    <label class="form-check-label text-light" for="flexRadioDefault1">
                        Dostawa
                    </label>
                </div>
            </div>


            <div class="col-12 mt-3">
                <div id="formInputs" class="text-center">
                    <input type="email" class="btn-outline-primary btn bg-dark form-control w-75 text-light" name="email" placeholder="Email">
                </div>
            </div>

            <div class="p-2 col-12 text-start ml-2 bg-dark border mt-2">
                <?php
                    $sum = 0.0;
                    if($_SESSION['cartProducts'] != " ")
                    {
                        $productsArray = explode(",",$_SESSION['cartProducts']);
                        foreach($productsArray as $product)
                        {
                            if($product != "")
                            {
                                $productData = explode("-",$product);
                                $sum = $sum +  floatval($productData[2]);
                            }   
                        }
                    }        
                 ?>

                <span class="text-light fs-4">Kwota: <span class="text-warning"><?= $sum ?>zł</span></span>
            </div>

            <div class="col-12 w-50 mx-auto mt-2">
                <input id="orderButton" type="submit" name="makeOrder" class="btn-outline-success btn bg-dark form-control" value="Zamów">
            </div>

            <div class="col-12 w-50 mx-auto mt-1">
                <a id="continueLink" href="offers.php" class="btn-outline-warning btn bg-dark form-control">Kontynuuj zakupy</a>
            </div>

        </form>

        <div class="col-12 w-50 p-0 mx-auto mt-1 mb-2">
            <form method="GET">
                <input class="btn-outline-danger btn bg-dark form-control" type="submit" name="clearCart" value="Wyczyść koszyk">
            </form>
        </div>
            
    
        
        
    </div>
</div>


<?php
include('Basic Components/footer.php');
?>
</body>