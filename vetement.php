<?php 
    include('./methode/methode.php');
    $vetements = array_reverse(methode::getvetement());
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Detail Accessoire</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include("entete.php");?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Catalogue de Vêtements</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Accueil</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Accessoires</h6>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Catalogue Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="row">
                <?php
                foreach ($vetements as $vetement) {
                    $prix = $vetement["prix"] == 0 ? "Discutez" : $vetement["prix"] . ' FCFA';
                    echo '<div class="col-lg-4 col-md-6 mb-2">
                            <div class="rent-item mb-4">
                                <img class="img-fluid mb-4" src="' . $vetement["photo"] . '" alt="' . $vetement["nom"] . '" style="max-width: 300px; height: 200px;">
                                <h4 class="text-uppercase mb-4">' . $vetement["nom"] . '</h4>
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="px-2">
                                        <i class="fas fa-battery-full text-primary mr-1"></i>
                                        <span>' . $vetement["type"] . '</span>
                                    </div>
                                    <div class="px-2 border-left border-right">
                                        <i class="bi bi-recycle text-warning"></i>
                                        <span>' . $vetement["etat"] . '</span>
                                    </div>
                                    <div class="px-2">
                                        <i class="bi bi-person-standing text-primary mr-1"></i>
                                        <span>' . $vetement["cible"] . '</span>
                                    </div>
                                </div>
                                <a class="btn btn-primary px-3" href="detail_acc.php?id=' . $vetement["id"] . '">' . $prix . '</a>
                            </div>
                        </div>';
                } 
                ?>
            </div>
        </div>
    </div>
    <!-- Catalogue End -->

    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0">
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-secondary d-flex align-items-center justify-content-between" style="height: 350px;">
                        <img class="img-fluid flex-shrink-0 ml-n5 w-50 mr-4" src="img/dress.png" alt="">
                        <div class="text-right">
                            <h3 class="text-uppercase text-light mb-3">Vêtement de qualité!</h3>
                            <p class="mb-4">Des voitures de luxe toutes marques confondues</p>
                            <a class="btn btn-primary py-2 px-4" href="">Catalogue</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-dark d-flex align-items-center justify-content-between" style="height: 350px;">
                        <div class="text-left">
                            <h3 class="text-uppercase text-light mb-3">et moin cher</h3>
                            <p class="mb-4">Un catalogue de voitures résistantes à votre disposition</p>
                            <a class="btn btn-primary py-2 px-4" href="">Catalogue</a>
                        </div>
                        <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4" src="img/jack.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <?php include("pied.php");?>
</body>

</html>
