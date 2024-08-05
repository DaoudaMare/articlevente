<?php 
    include("./methode/methode.php");
    if (isset($_POST["submit"])) {
        methode::AuthUser($_POST["email"],$_POST["password"]);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclure Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <?php if (isset($_GET['success']) && $_GET['success'] == 0): ?>
                            <div class="alert alert-danger" id="error-message" role="alert">
                                Connexion  échouée !, données incorrect!!
                            </div>
                         <?php endif; ?>
        <h1 class="text-center mb-4">Connectez Vous!</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post" class="bg-light p-4 rounded shadow-sm">
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Se connecter</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Inclure jQuery et Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#error-message").fadeOut("slow");
            }, 5000); // Le message disparaît après 5 secondes
        });
    </script>
</body>
</html>
