
<?php
include("./methode/methode.php");
$img = methode::getVoitureById($_GET["id"]);
$similarCar = methode::getVoitures();
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
        <h1 class="display-3 text-uppercase text-white mb-3">Détails</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Car Detail</h6>
        </div>
    </div>
    <!-- Page Header Start -->

    <!-- Detail Start -->
    <div class="container-fluid pt-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <h1 class="display-4 text-uppercase mb-5"><?php echo $img["nom"]; ?></h1>
                    <div class="row mx-n2 mb-3">
    <?php if (!empty($img["photo"])): ?>
        <div class="col-md-3 col-6 px-2 pb-2">
            <img class="img-fluid w-100" src="<?php echo $img["photo"]; ?>" alt="" onclick="afficherImage('<?php echo $img["photo"]; ?>')">
        </div>
    <?php endif; ?>
    <?php if (!empty($img["photo1"])): ?>
        <div class="col-md-3 col-6 px-2 pb-2">
            <img class="img-fluid w-100" src="<?php echo $img["photo1"]; ?>" alt="" onclick="afficherImage('<?php echo $img["photo1"]; ?>')">
        </div>
    <?php endif; ?>
    <?php if (!empty($img["photo2"])): ?>
        <div class="col-md-3 col-6 px-2 pb-2">
            <img class="img-fluid w-100" src="<?php echo $img["photo2"]; ?>" alt="" onclick="afficherImage('<?php echo $img["photo2"]; ?>')">
        </div>
    <?php endif; ?>
</div>


                    <p><?php echo $img["description"]; ?></p>
                    <div class="row pt-2">
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-car text-primary mr-2"></i>
                            <span>Model: <?php echo $img["annee"]; ?></span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-cogs text-primary mr-2"></i>
                            <span><?php echo $img["typeboite"]; ?></span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-road text-primary mr-2"></i>
                            <span><?php echo $img["etat"]; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="bg-secondary p-5">
                        <h3 class="text-primary text-center mb-4">Contactez le vendeur</h3>
                         
                    
                        <div class="form-group mb-0">
                            <a class="text-white" href="https://wa.me/07684843">
                                <button class="btn btn-primary btn-block" style="height: 50px;">
                                    <img src="./img/social.png" alt="" style="max-width: 32px; height: 32px;"> Contacter le vendeur 
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->

    <!-- Related Car Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <h2 class="mb-4">Propositions similaires</h2>
            <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
                <?php
                $luxecar = [];
                foreach ($similarCar as $car) {
                    if ($car["style"] == $img["style"]) {
                        $luxecar[] = $car;
                    }
                }
                if (count($luxecar)>=5) {
                    $num=5;
                }else{
                    $num=count($luxecar);
                }

                for ($i = 0; $i <$num; $i++) {
                    $car = $luxecar[$i];
                    $prix = isset($car["prix"]) ? methode::formatNumber($car["prix"]) . ' FCFA' : "Voir";
                    $boite = $car["typeboite"] ?? "--";

                    echo '<div class="rent-item">
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
                            <span>25K</span>
                        </div>
                    </div>
                    <a class="btn btn-primary px-3" href="detail.php?id=' . $car["id"] . '">' . $prix . '</a>
                    </div>';
                }

                
                ?>
            </div>
        </div>
    </div>
    <!-- Related Car End -->

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

    <?php include("pied.php"); ?>

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


    <!-- JavaScript pour afficher l'image dans le modal -->
<script>
    function afficherImage(url) {
        document.getElementById("modalImage").src = url;
        $('#imageModal').modal('show'); // Afficher le modal
    }
</script>

<!-- Modal pour afficher les images -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" class="img-fluid" src="" alt="Aperçu de l'image">
            </div>
        </div>
    </div>
</div>

    <!-- Modal pour afficher les images -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" class="img-fluid" src="" alt="Aperçu de l'image">
            </div>
        </div>
    </div>
</div>

</body>

</html>
