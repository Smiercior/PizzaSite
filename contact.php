<?php
include('server.php');
$_SESSION['site'] = "contact";
 ?>
 
<!DOCTYPE html>
<html>

<head>
<title>Tasty pizza</title>
<meta charset="utf-8">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="CSS/contact.css">

<!-- JavaScript Bundle with Popper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
<script src="JS/contact.js" type="text/JavaScript" defer></script>
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black log-container">
    <?php
    include('Basic Components/navbar.php');
    ?>

    <div class="row w-25 mt-4 mb-2 mx-auto text-center border border-2 border-secondary bg-black ">
        <div class="col-12 mb-4">
            <p class="span5 text-primary"> Skontaktuj się z nami! </span>
        </div>

        <div class="col-12 mb-2 text-start">
            <div class="row mb-2">
                <div class="col-4">
                    <p class="span6 text-light">Telefon:</p>
                </div>
                <div class="col-8">
                    <p class="span6 text-success">882 574 987</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-4">
                    <p class="span6 text-light">Email:</p>
                </div>
                <div class="col-8">
                    <p class="span6 text-success">BestPizza@gmail.com</p>
                </div>
            </div>  

            <div class="row" id="map">
                <div class="col-12 mb-2">
                    <p class="span6 text-light">Nasza lokacja:</p>
                </div>
                <div lang="col-12 w-100">
                    <iframe src="https://maps.google.com/maps?width=100%25&amp;height=500&amp;hl=en&amp;q=50.03265443153904,21.998823062693774+(Nasz%20lokacja)&amp;t=k&amp;z=19&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="100%" height="450" class="map" loading="lazy" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            
            </div>
        </div>
    </div>
</div>

<?php
include('Basic Components/footer.php');
?>
</body>