<?php
include('server.php');
$_SESSION['site'] = "account";
if(!isset($_SESSION['username'])) header('location: login.php');
 ?>
 
<!DOCTYPE html>
<html>

<head>
<title>Tasty pizza</title>
<meta charset="utf-8">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="CSS/account.css">

<!-- JavaScript Bundle with Popper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black log-container">
    <?php
    include('Basic Components/navbar.php');
    ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2 span5"><span class="text-success"><?= $_SESSION['success'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif ?>

    <div class="row w-25 mt-4 mb-2 mx-auto text-center border border-2 border-secondary bg-black ">
        <div class="col-12">
            <?php include('Basic Components/errors.php') ?>
        </div>

        <div class="col-12">
            <span class="span5 text-light"> Witaj <span class="text-primary"><?= $_SESSION['username']?></span> </span>
        </div>

        <div class="col-12 mb-2">
            <span class="span6 text-secondary"> Twoje dane ( Możesz je edytować ) </span>
        </div>
        
        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-12 mb-2">
                    <input type="text" class="btn-outline-primary btn btnA bg-dark form-control w-75 text-light" name="username" value="<?= $_SESSION['email'] ?>" readonly>
                </div>

                <form method="POST">
                    <div class="col-12 mb-2">
                        <input type="text" class="btn-outline-primary btn btnA bg-dark form-control w-75 text-light" name="phone" minlength="9" maxlength="9" placeholder="Telefon" <?php if($_SESSION['phone'] != ""): ?> value="<?= $_SESSION['phone']; ?>" <?php endif ?>>
                    </div>

                    <div class="col-12 mb-2">
                        <input type="text" class="btn-outline-primary btn btnA bg-dark form-control w-75 text-light" name="city" placeholder="Miasto" <?php if($_SESSION['city'] != ""): ?> value="<?= $_SESSION['city']; ?>" <?php endif ?>>
                    </div>

                    <div class="col-12 mb-2">
                        <input type="text" class="btn-outline-primary btn btnA bg-dark form-control w-50 text-light" name="street" placeholder="Ulica" <?php if($_SESSION['street'] != ""): ?> value="<?= $_SESSION['street']; ?>" <?php endif ?>>
                        <input type="text" class="btn-outline-primary btn btnA bg-dark form-control w-25 text-light" name="houseNumber" placeholder="Nr.dom" <?php if($_SESSION['houseNumber'] != ""): ?> value="<?= $_SESSION['houseNumber']; ?>" <?php endif ?>>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="changeProfile" class="btn-outline-success btn btnA bg-dark form-control w-50" value="Zapisz dane">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row w-25 mt-4 mb-2 mx-auto text-center border border-2 border-secondary bg-black ">
        <div class="col-12">
            <span class="span5 text-warning"> Ustawienia konta</span>
        </div>

        <div class="col-12 mb-2">
            <span class="span6 text-secondary"> Uwaga zmian nie można cofnąć! </span>
        </div>
        
        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="accountEmail.php" class="btn-outline-success btn btnA bg-dark form-control w-50">Zmień email</a>
                </div>

                <div class="col-12">
                    <a href="accountDel.php" class="btn-outline-danger btn btnA bg-dark form-control w-50">Usuń konto</a>
                </div>
            </div>
            
        </div>

    </div>
</div>

<?php
include('Basic Components/footer.php');
?>
</body>



