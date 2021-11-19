<?php
include('server.php');
$_SESSION['site'] = "index";
?>

<!DOCTYPE html>
<html>

<head>
<title>Tasty pizza</title>
<meta charset="utf-8">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="CSS/index.css">
<!-- JavaScript Bundle with Popper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
</head>

<body>
<div class="container-fluid overflow-hidden px-0 bg-black">
    <?php
    include('Basic Components/navbar.php');
    ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2"><span class="text-success"><?= $_SESSION['success'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="row w-100 justify-content-center mt-4 text-light">
            <div class="col-4 text-center border border-2 border-secondary">
                <p class="mt-2 mb-2"><span class="text-danger"><?= $_SESSION['error'] ?></span></p>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif ?>

    <?php if(isset($_SESSION['username'])) : ?>
    <div class="row w-100 justify-content-center mt-4 text-light">
        <div class="col-4 text-center border border-2 border-secondary">
            <p class="mt-2 mb-2 ">Witaj <span class="text-primary"><?php echo $_SESSION['username']; ?></span></p>
        </div>
    </div>
    <?php endif ?>

    <div class="row w-100 mt-4 mb-4 justify-content-center">
        <div class="col-8">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="Img/pizza1.jpg" class="d-block w-100" alt="pizza1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Najlepsza pizza w mieście!</h5>
                        <p>Zamów już teraz</p>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="Img/pizza2.jpg" class="d-block w-100" alt="pizza2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Mamy wiele różnorodnych ofert!</h5>
                        <p>Tylko u nas niezwykłe smaki</p>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="Img/pizza3.jpg" class="d-block w-100" alt="pizza3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Nie czekaj!</h5>
                        <p>Zobacz nasze oferty i złóż zamówienie</p>
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row w-100 justify-content-center mb-4">
        <div class="col-8 text-center border border-2 border-secondary">
            <p class="mt-2 mb-2 fsB text-primary">Jedynie świeże składniki, zamawiane lokalnie</p>
            <p class="text-light">Dbamy w naszej kuchni by składniki były jak najwyższej jakości. Każdą pizze traktujemy wyjątkowo i staramy
                się serwować jak najdoskonalszy smak. Nasza obsługa jest wykwalifikowana i silnie pracuje by zadowolić każdego kilenta </p>
            <a href="offers.php" type="button" class="btn btn-success mb-2">Zamów online!</a>
        </div>
    </div>

    <div class="row w-100 m-0 openHours justify-content-center">
        <div class="col-3 mt-4">
            <ul class="list-group mb-4">
                <li class="list-group-item openHours text-center">
                    <p class="text-light"> Godziny otwarcia </p>
                </li>
                <li class="list-group-item  openHours">
                    <p class="text-light"> Pon <span class="text-success">8.00-20.00</span> </p>
                </li>
                <li class="list-group-item  openHours">
                    <p class="text-light"> Wt <span class="text-success">8.00-20.00</span> </p>
                </li>
                <li class="list-group-item  openHours">
                    <p class="text-light"> Śr <span class="text-success">8.00-20.00</span> </p>
                </li>
                <li class="list-group-item  openHours">
                    <p class="text-light"> Czw <span class="text-success">8.00-20.00</span> </p>
                </li>
                <li class="list-group-item  openHours">
                    <p class="text-light"> Pt <span class="text-success">12.00-20.00</span> </p>
                </li>
                <li class="list-group-item  openHours">
                    <p class="text-light"> Sob <span class="text-danger">zamknięte</span> </p>
                </li>
                <li class="list-group-item  openHours">
                    <p class="text-light"> Ndz <span class="text-danger">zamknięte</span> </p>
                </li>

            </ul>
        </div>
    </div>
</div>

<?php
include('Basic Components/footer.php');
?>
</body>
</html>