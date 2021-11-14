<?php
include('server.php');
$_SESSION['site'] = "about";
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

<div class="container-fluid overflow-hidden px-0 bg-black log-container">
    <?php
    include('Basic Components/navbar.php');
    ?>

    <div class="row w-25 mt-4 mb-2 mx-auto text-center border border-2 border-secondary bg-black ">
        <div class="col-12">
            <span class="fs-5 text-primary"> Witamy! </span>
        </div>

        <div class="col-12 mb-2 text-start">
            <span class="fs-6 text-light">
                Jesteśmy firmą działającą na rynku już od wielu lat. Od tego czasu udoskonaliliśmy nasze receptury
                i nabraliśmy dużego doświadczenia.
            </span>
        </div>

        <div class="col-12 mb-2 text-start">
            <span class="fs-6 text-light">
                Staramy się by każde zamówienie było traktowane jak najlepiej. Nasi kucharze wkładają ogrom serca w
                swoje dania, używają tylko świeżych składników i sprawdzonych receptur. 
            </span>
        </div>

        <div class="col-12 mb-2 text-start">
            <span class="fs-6 text-light">
                Przez lata naszej działalności wszyscy nasi klienci byli zadowoleni. Nasza obsługa starannie komponowała
                każde zamówienie i doradzała w przypadkach niezdecydowania.
            </span>
        </div>

        <div class="col-12 mb-2 text-start">
            <span class="fs-6 text-success">
                Także nie czekaj głodny! Zamów u nas, gwarantujemy ci, nie zawiedziesz się :D
            </span>
        </div>

        <div class="col-12 mb-2 mt-2 text-center">
            <a href="offers.php" type="button" class="btn btn-success mb-2">Zamów online!</a>
        </div>
    </div>
</div>

<?php
include('Basic Components/footer.php');
?>


</body>