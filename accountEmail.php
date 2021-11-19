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
<link rel="stylesheet" href="CSS/accountEmail.css">

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
            <span class="span5 text-primary"><span class="text-success"><?= $_SESSION['username']?></span>:  Wprowadź nowy email  </span>
        </div>

        <div class="col-12 mb-2">
            <span class="span6 text-secondary"> Tej operacji nie można cofnąć! </span>
        </div>
        
        <div class="col-12 mb-2">
            <div class="row">
                <form method="POST">
                    <div class="col-12 mb-2">
                        <input type="email" class="btn-outline-primary btn btnA bg-dark form-control w-75 text-light" name="email" placeholder="Nowy email">
                    </div>
                    
                    <div class="col-12 mb-2">
                        <input type="submit" name="changeEmail" class="btn-outline-success btn btnA bg-dark form-control w-50" value="Zmień">
                    </div>

                    <div class="col-12">
                        <a href="account.php" class="btn-outline-warning btn btnA bg-dark form-control w-50">Anuluj</a>
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



