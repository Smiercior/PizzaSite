<nav class="navbar navbar-expand-lg navbar-light navBar bg-dark">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="col-12">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto align-items-center w-75">
                            <li class="nav-item logo">
                            <img src="Img/logopizz.png" width="75%" height="75%">
                            </li>
                            <li class="nav-item  align-middle">
                                <a id="Index" class="nav-link text-primary fs-4" href="index.php">Strona główna</a>
                            </li>
                            <li class="nav-item">
                                <a id="Cars" class="nav-link text-light fs-4" href="offers.php">Oferty</a>
                            </li>
                            <li class="nav-item">
                                <a id="Orders" class="nav-link text-light fs-4" href="#">O Nas</a>
                            </li>
                            <li class="nav-item">
                                <a id="Contact" class="nav-link text-light fs-4" href="#">Kontakt</a>
                            </li>
                        </ul>
                        <?php if(!isset($_SESSION['username'])) : ?>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="text-light fs-4 btn-outline-success btn bg-dark" href="login.php">Zaloguj</a>
                            <a class="text-light fs-4 btn-outline-success btn bg-dark" href="register.php">Zarejestruj</a>
                        </div>
                        <?php elseif(isset($_SESSION['username'])) : ?>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="text-light fs-4 btn-outline-success btn bg-dark" href="login.php">Moje konto</a>
                            <form method="GET" accept="index.php">
                                <input type="submit" class="text-light fs-4 btn-outline-danger btn bg-dark" name="logout" value="Wyloguj">
                            </form>
                        </div> 
                        <?php endif ?>
                    </div>
                </div>

            </div>
            
            
            <!--<span class="ml-2" id="h3">Niezalogowany &nbsp;</span>-->
        </div>      
    </nav>