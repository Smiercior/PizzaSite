<?php
include('server.php');
$_SESSION['site'] = "login";
 ?>
 
<!DOCTYPE html>
<html>

<head>
<title>Tasty pizza</title>
<meta charset="utf-8">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="CSS/login.css">

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
            <?php include('Basic Components/errors.php') ?>
        </div>

        <div class="col-12">
            <span class="span5 text-light"> Zaloguj się </span>
        </div>

        <div class="col-12 mb-2">
            <span class="span6 text-secondary"> Wpisz swój login i hasło </span>
        </div>
        
        <div class="col-12 mb-2">
            <div class="row">
                <form method="POST">
                    <div class="col-12 mb-2">
                        <input type="text" class="btn-outline-primary btn btnL bg-dark form-control w-75 text-light" name="username" placeholder="Nazwa użytkownika">
                    </div>

                    <div class="col-12 mb-2">
                        <input type="password" class="btn-outline-primary btn btnL bg-dark form-control w-75 text-light" name="password" placeholder="Hasło">
                    </div>  

                    <div class="col-12">
                        <input type="submit" name="log" class="btn-outline-success btn btnL bg-dark form-control w-50" value="Zaloguj">
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>

<?php
include('Basic Components/footer.php');
?>
</body>



