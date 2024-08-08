<?php
include("./methode/methode.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $etat = $_POST['etat'];
    $prix = $_POST['prix'];
    $description = $_POST["description"];

    $upload_dir = 'uploads/';
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $image_files = ['photo1', 'photo2', 'photo3'];
    $upload_files = [];
    $image_types = [];

    foreach ($image_files as $image) {
        if (isset($_FILES[$image]) && $_FILES[$image]['error'] == 0) {
            $upload_file = $upload_dir . basename($_FILES[$image]['name']);
            $image_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES[$image]['tmp_name']);
            if ($check === false) {
                echo "Le fichier $image n'est pas une image valide.";
                exit;
            }

            // Limiter la taille du fichier si nécessaire (ici, 20 Mo)
            if ($_FILES[$image]['size'] > 20000000) {
                echo "Le fichier $image est trop volumineux.";
                exit;
            }

            // Autoriser seulement certains types d'images
            if (!in_array($image_type, $allowed_types)) {
                echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés pour $image.";
                exit;
            }

            // Déplacer le fichier uploadé vers le répertoire désiré
            if (!move_uploaded_file($_FILES[$image]['tmp_name'], $upload_file)) {
                echo "Erreur lors de l'upload du fichier $image.";
                exit;
            }

            $upload_files[] = $upload_file;
            $image_types[] = $image_type;
        } else {
            $upload_files[] = null;
            $image_types[] = null;
        }
    }

    // Connexion à votre base de données (à adapter selon votre configuration)
    $mysqli = new mysqli("localhost", "root", "", "italievente");

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Connexion échouée : " . $mysqli->connect_error);
    }

    // Préparer la requête SQL pour insérer les données dans la base de données
    $stmt = $mysqli->prepare("INSERT INTO cuisine (nom, etat,  description,photo,photo1, photo2, prix) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $nom, $etat, $description,$upload_files[0], $upload_files[1], $upload_files[2],$prix);

    // Exécuter la requête
    if ($stmt->execute()) {
        header("Location: cuisineForms.php?success=1");
    } else {
        header("Location: cuisineForms.php?success=0");
    }

    // Fermer la connexion et le statement
    $stmt->close();
    $mysqli->close();
}
?>
