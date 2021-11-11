<?php
include("server.php");
$_SESSION['site'] = "order";
$prices = explode(",",$_SESSION['productPrice']);
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
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black">
    <?php
    include('Basic Components/navbar.php');
     ?>

    <div class="row w-75 mx-auto mt-4 mb-5">
        <div class="col-6">
            <div class="row w-50 mb-2 text-center border border-2 border-secondary bg-black ">
                <div class="col-12">
                    <span class="fs-4 text-light"> <?= $_SESSION['productName'] ?> </span>
                </div>
                <div class="col-12 mb-2 text-start">
                    <span class="fs-6 text-secondary"> Rozmiar </span>
                </div>
                <div class="col-12 mb-2">
                    <div class="row">
                        <form method="POST">
                            <div class="col-12 mb-2 w-50 mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="small-<?= $prices[0]; ?>" id="flexRadioDefault1" checked>
                                    <label class="form-check-label text-light" for="flexRadioDefault1">
                                        Mała <span class="text-warning"><?= $prices[0]; ?></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mb-2 w-50 mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="normal-<?= $prices[1]; ?>" id="flexRadioDefault1">
                                    <label class="form-check-label text-light" for="flexRadioDefault1">
                                        Średnia <span class="text-warning"><?= $prices[1]; ?></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mb-2 w-50 mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="big-<?= $prices[2]; ?>" id="flexRadioDefault1">
                                    <label class="form-check-label text-light" for="flexRadioDefault1">
                                        Duża <span class="text-warning"><?= $prices[2]; ?></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <input type="submit" name="addToCart" class="btn-outline-success btn bg-dark form-control w-75" value="Dodaj do koszyka">
                            </div>

                            <div class="col-12 mt-2">
                                <a href="offers.php" class="btn-outline-danger btn bg-dark form-control w-75">Anuluj</a>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php if( $_SESSION['productComposition'] != ""): ?>
            <div class="row">
                <div class="col-12">
                    <span class="text-warning">Skład: </span>
                </div>
                <div class="col-12">
                    <span class="text-light"><?= $_SESSION['productComposition'] ?></span>
                </div>
            </div>
            <?php endif ?>
        </div>

        <div class="col-6">
            <img src="img/<?= $_SESSION['productImg'] ?>" width="100%" height="100%">
        </div>
    </div> 
</div>


<?php
include('Basic Components/footer.php');
?>
</body>