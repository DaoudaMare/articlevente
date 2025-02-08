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
    <?php include("entete.php");?>

<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-4 text-uppercase text-center mb-5">Nous contacter</h1>
        <div class="row">
            <div class="col-lg-7 mb-2">
                <div class="contact-form bg-light mb-4" style="padding: 30px;">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="text" id="nom" class="form-control p-4" placeholder="Nom" required>
                            </div>
                            <div class="col-6 form-group">
                                <input type="email" id="email" class="form-control p-4" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="objet" class="form-control p-4" placeholder="Objet" required>
                        </div>
                        <div class="form-group">
                            <textarea id="message" class="form-control py-3 px-4" rows="5" placeholder="Message..." required></textarea>
                        </div>
                        <div>
                            <button class="btn btn-primary py-3 px-5" type="button" onclick="envoyerEmail()">
                                Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-2">
                <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
                    <h2 class="text-light">Lieu de dépôt au Burkina Faso</h2>
                    <div class="d-flex mb-3">
                        <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                        <div class="mt-n1">
                            <h5 class="text-light">Ouagadougou</h5>
                            <p>Zone 1</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                        <div class="mt-n1">
                            <h5 class="text-light">ROME</h5>
                            <p>Centre ville</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                        <div class="mt-n1">
                            <h5 class="text-light">Pour d'autres services</h5>
                            <p>nonioumar1@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                        <div class="mt-n1">
                            <h5 class="text-light">Vos avis et préoccupations</h5>
                            <p class="m-0">avis@example.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<!-- Contact End -->

<script>
function envoyerEmail() {
    // Récupérer les valeurs du formulaire
    var nom = document.getElementById("nom").value;
    var email = document.getElementById("email").value;
    var objet = document.getElementById("objet").value;
    var message = document.getElementById("message").value;

    // Vérifier si tous les champs sont remplis
    if (!nom || !email || !objet || !message) {
        alert("Veuillez remplir tous les champs.");
        return;
    }

    // Construire l'email avec mailto
    var sujet = encodeURIComponent(objet);
    var corps = encodeURIComponent("Nom : " + nom + "\nEmail : " + email + "\n\nMessage : " + message);
    
    // Lien mailto
    var mailtoLink = "mailto:nonioumar1@gmail.com?subject=" + sujet + "&body=" + corps;

    // Ouvrir le client de messagerie
    window.location.href = mailtoLink;
}
</script>



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


    <?php include("pied.php");?>


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