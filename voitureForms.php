<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Euro-Article</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include("enteteAdmin.php"); ?>
    
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulaire de Publication de voiture</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success" id="success-message" role="alert">
                Donnée publiée avec succès !
            </div>
        <?php elseif (isset($_GET['success']) && $_GET['success'] == 0): ?>
            <div class="alert alert-danger" id="error-message" role="alert">
                Une erreur est survenue lors de la publication des données.
            </div>
        <?php endif; ?>
        
        <form action="traitement.php" method="post" enctype="multipart/form-data" class="border p-4 shadow-sm bg-light rounded">
            <div class="form-group">
                <label for="nom"><i class="fas fa-car"></i> Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom de la voiture" required>
            </div>

            <div class="form-group">
                <label for="annee"><i class="fas fa-calendar-alt"></i> Année :</label>
                <input type="text" class="form-control" id="annee" name="annee" placeholder="Entrez l'année de la voiture" required>
            </div>
            
           
            <div class="form-group">
            <label for="etat"><i class="fas fa-info-circle"></i> État :</label>
                <select id="etat" name="etat" class="form-control" required>
                    <option value="occasion">Occasion</option>
                    <option value="neuf">Neuf</option>
                </select>
            </div>

            <div class="form-group">
                <label for="boite"><i class="fas fa-cogs"></i> Type Boite de vitesse:</label>
                <select id="boite" name="boite" class="form-control" required>
                    <option value="Auto">Automatique</option>
                    <option value="Manuel">Manuelle</option>
                    <option value="Semi">Semi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="type"><i class="fas fa-truck"></i> Type de voiture:</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="Automobile">Automobile</option>
                    <option value="Car">Car</option>
                    <option value="Camion">Camion</option>
                </select>
            </div>

            <div class="form-group">
                <label for="style"><i class="fas fa-car-side"></i> Style de voiture:</label>
                <select id="style" name="style" class="form-control" required>
                    <option value="Standard">Standard</option>
                    <option value="Luxe">Luxe</option>
                </select>
            </div>

            <div class="form-group">
                <label for="photo1"><i class="fas fa-camera"></i> Photo1 :</label>
                <input type="file" class="form-control-file" id="photo1" name="photo1">
            </div>

            <div class="form-group">
                <label for="photo2"><i class="fas fa-camera"></i> Photo2 :</label>
                <input type="file" class="form-control-file" id="photo2" name="photo2">
            </div>

            <div class="form-group">
                <label for="photo3"><i class="fas fa-camera"></i> Photo3 :</label>
                <input type="file" class="form-control-file" id="photo3" name="photo3">
            </div>

            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Description :</label>
                <textarea name="description" id="description" class="form-control" placeholder="Saisissez la description ici" required></textarea>
            </div>

            <div class="form-group">
                <label for="prix"><i class="fas fa-dollar-sign"></i> Prix :</label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder="Entrez le prix" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Publier</button>
        </form>
    </div>

    <?php include("pied.php"); ?>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-message").fadeOut("slow");
                $("#error-message").fadeOut("slow");
            }, 5000); // Le message disparaît après 5 secondes
        });
    </script>
    
</body>
</html>
