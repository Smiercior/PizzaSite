<?php
include("server.php")
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
                        <button class="ml-2 btn btn-success">Kup teraz</button>
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
                        <button class="ml-2 btn btn-success">Kup teraz</button>
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
                            <button class="ml-2 btn btn-success">Kup teraz</button>
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
                            <button class="ml-2 btn btn-success">Kup teraz</button>
                        </div>
                    </div>         
                </div>
            <?php endforeach; ?>
        </div>
     </div>
</div>


<?php
include('Basic Components/footer.php');
?>
</body>