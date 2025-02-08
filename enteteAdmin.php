<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Euro Articles</title>
    <!-- Ajout des fichiers CSS nécessaires -->
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <link rel="stylesheet" href="path/to/fontawesome.css">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body pr-3" href="#"><i class="fa fa-phone-alt mr-2"></i>+39 351 813 2484</a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href="#"><i class="fa fa-envelope mr-2"></i>Espace administrateur</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-3" href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-3" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-body px-3" href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-body px-3" href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-body pl-3" href="#">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-5" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="#" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1">Euro Articles</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="admin.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : ''; ?>">Accueil</a>
                        <a href="voitureForms.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'voitureForms.php' ? 'active' : ''; ?>">Publier Voitures</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle <?php echo basename($_SERVER['PHP_SELF']) == 'electriqueForms.php' || basename($_SERVER['PHP_SELF']) == 'cuisineForms.php' || basename($_SERVER['PHP_SELF']) == 'vetementForms.php' ? 'active' : ''; ?>" data-toggle="dropdown">Accessoires</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="electriqueforms.php" class="dropdown-item">Accessoire Electrique</a>
                                <a href="cuisineForms.php" class="dropdown-item">Accessoire de cuisine</a>
                                <a href="vetementForms.php" class="dropdown-item">Vêtements</a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <a href="profil.php?id=<?php echo $_SESSION['id'];?>" class="nav-item nav-link"> <i class="fas fa-user"></i> Profil <div class="container"> </div></a>                            
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Search Start -->
    <!-- Contenu de la section de recherche à ajouter ici -->
    <!-- Search End -->

    <!-- Ajout des fichiers JavaScript nécessaires -->
    <script src="path/to/jquery.js"></script>
    <script src="path/to/bootstrap.js"></script>
</body>

</html>