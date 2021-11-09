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
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black">
    <?php
    include('Basic Components/navbar.php');
     ?>

    <div class="row mt-4 mb-4">
        <div class="col-12 text-center">
            <span class="text-light">Twoje zamówienia: <span class="text-primary"><?= $_SESSION['cartProducts'] ?></span></span>
        </div>

        <div class="col-12 text-center mt-4">
            <form method="GET">
                <input type="submit" name="clearCart" value="Wyczyść koszyk">
            </form>
        </div>
        
    </div>
</div>


<?php
include('Basic Components/footer.php');
?>
</body>