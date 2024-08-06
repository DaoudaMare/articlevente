<?php
include('./methode/methode.php');
$voitures = methode::getVoitures();
$poidlourd = [];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Euro-Article</title>
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
    <?php include("entete.php"); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Section</a></h6>
        </div>
        <h1 class="display-3 text-uppercase text-white mb-3">Camion - Car</h1>

    </div>
    <!-- Page Header Start -->

    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase text-center mb-5">Trouve ta voiture</h1>
            <div class="row">
                <?php
                foreach ($voitures as $voiture) {

                    if ($voiture["type"] == "Camion" || $voiture["type"] == "Car") {
                        array_push($poidlourd, $voiture);
                    }
                }
                foreach ($poidlourd as $car) {
                    if ($car["prix"] == 0) {
                        $prix = "Discutez";
                    } else {
                        $prix = (int)$car["prix"];
                    }
                    if ($car["typeboite"] == null) {
                        $boite = "--";
                    } else {
                        $boite = $car["typeboite"];
                    }

                    echo '<div class="col-lg-4 col-md-6 mb-2">
                            <div class="rent-item mb-4">
                                <img class="img-fluid mb-4" src="' . $car["photo"] . '" alt="' . $car["nom"] . '" style="max-width: 300px; height: 200px;">
                                <h4 class="text-uppercase mb-4">' . $car["nom"] . '</h4>
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="px-2">
                                        <i class="fa fa-car text-primary mr-1"></i>
                                        <span>' . $car["annee"] . '</span>
                                    </div>
                                    <div class="px-2 border-left border-right">
                                        <i class="fa fa-cogs text-primary mr-1"></i>
                                        <span>' . $boite . '</span>
                                    </div>
                                    <div class="px-2">
                                        <i class="fa fa-road text-primary mr-1"></i>
                                        <span>25Km</span>
                                    </div>
                                </div>
                                
 <a class="btn btn-primary px-3" href="detail.php?id=' . htmlspecialchars($car["id"]) . '">';

                    if (is_int($prix) || is_float($prix) || is_double($prix)) {
                        echo methode::formatNumber($prix) . ' FCFA';
                    } else {
                        echo htmlspecialchars($prix) . '';
                    }

                    echo '</a>                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Rent A Car End -->


    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0">
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-secondary d-flex align-items-center justify-content-between" style="height: 350px;">
                        <img class="img-fluid flex-shrink-0 ml-n5 w-50 mr-4" src="img/banner-left.png" alt="">
                        <div class="text-right">
                            <h3 class="text-uppercase text-light mb-3">Voulez-vous le luxe?</h3>
                            <p class="mb-4">Des voitures de luxe toutes marques confondues</p>
                            <a class="btn btn-primary py-2 px-4" href="">Catalogue</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-dark d-flex align-items-center justify-content-between" style="height: 350px;">
                        <div class="text-left">
                            <h3 class="text-uppercase text-light mb-3">Voulez-vous la résistance?</h3>
                            <p class="mb-4">Un catalogue de voiture resistante à votre disposition</p>
                            <a class="btn btn-primary py-2 px-4" href="">Catalogue</a>
                        </div>
                        <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4" src="img/banner-right.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="img/vendor-1.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-2.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-3.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-4.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-5.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-6.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-7.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-8.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

    <?php include("pied.php") ?>

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
</body>

</html>