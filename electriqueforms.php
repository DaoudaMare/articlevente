<?php
    include("./methode/methode.php");
    if (isset($_POST["submit"])) {
        methode::electricPost();
    }
?>
<!DOCTYPE html>
<html lang="fr">

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
    <?php include("enteteAdmin.php");?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulaire de publication des accessoires électriques</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success" id="success-message" role="alert">
                Donnée publiée avec succès !
            </div>
        <?php elseif (isset($_GET['success']) && $_GET['success'] == 0): ?>
            <div class="alert alert-danger" id="error-message" role="alert">
                Une erreur est survenue lors de la publication des données.
            </div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data" class="border p-4 shadow-sm bg-light rounded">
            <div class="form-group">
                <label for="nom"><i class="fas fa-plug"></i> Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom de l'accessoire" required>
            </div>

            <div class="form-group">
                <label for="capacite"><i class="fas fa-battery-full"></i> Capacité :</label>
                <input type="text" class="form-control" id="capacite" name="capacite" placeholder="Entrez la capacité de l'accessoire" required>
            </div>

            <div class="form-group">
                <label for="Etat"><i class="fas fa-info-circle"></i> État :</label>
                <select id="Etat" name="Etat" class="form-control" required>
                    <option value="Neuf">Neuf</option>
                    <option value="Occasion">Occasion</option>
                </select>
            </div>

            <div class="form-group">
                <label for="photo"><i class="fas fa-camera"></i> Photo :</label>
                <input type="file" class="form-control-file" id="photo" name="photo" required>
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
                <label for="description"><i class="fas fa-align-left"></i> Description :</label>
                <textarea name="description" id="description" class="form-control" placeholder="Saisissez la description ici" required></textarea>
            </div>

            <div class="form-group">
                <label for="prix"><i class="fas fa-dollar-sign"></i> Prix :</label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder="Entrez le prix" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Publier</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
