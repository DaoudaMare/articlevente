<?php
class methode
{
    private static function connectDB()
    {
        $mysqli = new mysqli("localhost", "root", "", "italievente");
        if ($mysqli->connect_error) {
            die("Connexion échouée : " . $mysqli->connect_error);
        }
        return $mysqli;
    }
    
    public static function EnregistrerVoiture($nom, $annee, $etat, $photo, $disponible, $prix)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "italievente";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Configuration de PDO pour lever les exceptions en cas d'erreur
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $photoContent = file_get_contents($photo);

            // Requête SQL préparée
            $stmt = $conn->prepare("INSERT INTO voiture (nom, annee, etat, photo, disponible, prix) 
                                            VALUES (:nom, :annee, :etat, :photo, :disponible, :prix)");

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':etat', $etat);
            $stmt->bindParam(':photo', $photoContent, PDO::PARAM_LOB); // Utilisation de PDO::PARAM_LOB pour le BLOB
            $stmt->bindParam(':disponible', $disponible);
            $stmt->bindParam(':prix', $prix);

            $stmt->execute();
            echo 'succes';
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        $conn = null;
    }

    public static function electricPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $capacite = $_POST['capacite'];
            $etat = $_POST['Etat'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];

            $upload_dir = 'uploads/';
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            $image_files = ['photo', 'photo1', 'photo2'];
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

                    // Créer le répertoire de destination s'il n'existe pas
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    // Déplacer le fichier uploadé vers le répertoire désiré
                    if (!move_uploaded_file($_FILES[$image]['tmp_name'], $upload_file)) {
                        echo "Erreur lors de l'upload du fichier $image.";
                        exit;
                    }

                    $upload_files[$image] = $upload_file;
                    $image_types[$image] = $image_type;
                } else {
                    $upload_files[$image] = null;
                    $image_types[$image] = null;
                }
            }

            // Connexion à votre base de données (à adapter selon votre configuration)
            $mysqli = self::connectDB();

            // Préparer la requête SQL pour insérer les données dans la base de données
            $stmt = $mysqli->prepare("INSERT INTO electrique (nom, description, capacite, etat, photo, photo1, photo2, prix) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                echo "Erreur de préparation de la requête : " . $mysqli->error;
                exit;
            }
            $stmt->bind_param(
                "sssssssd",
                $nom,
                $description,
                $capacite,
                $etat,
                $upload_files['photo'],
                $upload_files['photo1'],
                $upload_files['photo2'],
                $prix
            );

            // Exécuter la requête
            if ($stmt->execute()) {
                header("Location: electriqueForms.php?success=1");
            } else {
                header("Location: electriqueForms.php?success=0");
            }

            // Fermer la connexion et le statement
            $stmt->close();
            $mysqli->close();
        }
    }


    static function authenticateUser($email, $password)
    {
        $mysqli = self::connectDB();

        // Préparer la requête SQL pour obtenir les informations de l'utilisateur
        $stmt = $mysqli->prepare("SELECT id, password FROM user WHERE email = ?");
        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $mysqli->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Vérifier si un utilisateur avec cet email existe
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            // Vérifier le mot de passe
            if (password_verify($password, $hashed_password)) {
                // Mot de passe correct, retourner l'ID de l'utilisateur
                echo "Authentification réussie";
                //return $user_id;
            } else {
                // Mot de passe incorrect
                echo "Données incorrectes";
                //return false;
            }
        } else {
            // Aucun utilisateur trouvé avec cet email
            echo "Échec de l'authentification!";
            //return false;
        }

        $stmt->close();
        $mysqli->close();
    }

    static function addUser($nom, $prenom, $email, $password, $numero)
    {
        $con = self::connectDB();
        // Hacher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer et exécuter la requête SQL
        $stmt = $con->prepare("INSERT INTO user (nom, prenom, email, password, numero) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nom, $prenom, $email, $hashed_password, $numero);

        if ($stmt->execute()) {
            echo "Nouvel utilisateur enregistré avec succès";
        } else {
            echo "Erreur : " . $stmt->error;
        }

        // Fermer la connexion
        $stmt->close();
        $con->close();
    }

    static function AuthUser($email, $password)
    {
        //include("./seconnecter.php");
        $mysqli = self::connectDB();
        // Préparer et exécuter la requête SQL
        $stmt = $mysqli->prepare("SELECT id, nom, prenom, password,numero FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // L'utilisateur existe
            $stmt->bind_result($id, $nom, $prenom, $hashed_password,$numero);
            $stmt->fetch();

            // Vérifier le mot de passe
            if (password_verify($password, $hashed_password)) {
                // Démarrer une session et enregistrer les informations de l'utilisateur
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['numero'] = $numero;
                $_SESSION['password'] = $hashed_password;

                header("Location: admin.php?success=1");
            } else {
                header("Location: connectAdmin.php?success=0");
            }
        } else {
            header("Location: connectAdmin.php?success=0");
        }

        // Fermer la connexion
        $stmt->close();
        $mysqli->close();
    }

    static function compteurVisites()
    {
        $mysqli = self::connectDB();

        // Vérifier si le compteur existe déjà
        $result = $mysqli->query("SELECT nombre_visites FROM compteur_visites LIMIT 1");

        if ($result->num_rows === 0) {
            // Si aucun enregistrement, initialiser le compteur
            $mysqli->query("INSERT INTO compteur_visites (nombre_visites) VALUES (0)");
            $nombre_visites = 0;
        } else {
            // Récupérer le compteur actuel
            $row = $result->fetch_assoc();
            $nombre_visites = $row['nombre_visites'];
        }

        // Incrémenter le compteur
        $nombre_visites++;

        // Mettre à jour le compteur dans la base de données
        $mysqli->query("UPDATE compteur_visites SET nombre_visites = $nombre_visites");

        // Fermer la connexion
        $mysqli->close();

        return $nombre_visites;
    }

    static function getElectrique()
    {
        // Connexion à la base de données
        $mysqli = self::connectDB();

        // Requête SQL pour récupérer les voitures
        $sql = "SELECT id, nom, description, capacite, photo, etat,photo,photo1,photo2,prix FROM electrique";
        $result = $mysqli->query($sql);

        $electriques = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Ajouter chaque voiture au tableau $voitures
                $electriques[] = $row;
            }
        }

        // Fermer la connexion à la base de données
        $mysqli->close();

        // Retourner le tableau contenant les données des voitures
        return $electriques;
    }

    static function getCuisine()
    {
        // Connexion à la base de données
        $mysqli = self::connectDB();

        // Requête SQL pour récupérer les voitures
        $sql = "SELECT id, nom,etat, description, photo,photo1,photo2,prix FROM cuisine";
        $result = $mysqli->query($sql);

        $cuisines = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Ajouter chaque voiture au tableau $voitures
                $cuisines[] = $row;
            }
        }

        // Fermer la connexion à la base de données
        $mysqli->close();

        // Retourner le tableau contenant les données des voitures
        return $cuisines;
    }

    static function getVetement()
    {
        // Connexion à la base de données
        $mysqli = self::connectDB();

        // Requête SQL pour récupérer les voitures
        $sql = "SELECT id, nom,etat,type, cible, photo,photo1,photo2,prix FROM vetement";
        $result = $mysqli->query($sql);

        $vetements = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Ajouter chaque voiture au tableau $voitures
                $vetements[] = $row;
            }
        }

        // Fermer la connexion à la base de données
        $mysqli->close();

        // Retourner le tableau contenant les données des voitures
        return $vetements;
    }

    static function getVoitureById($id)
    {
        // Connexion à la base de données
        $mysqli = methode::connectDB();

        // Préparer la requête SQL pour éviter les injections SQL
        $stmt = $mysqli->prepare("SELECT id, nom, annee, etat, photo, prix, typeboite, disponible, photo1,photo2,description,style FROM voiture WHERE id = ?");

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $mysqli->error);
        }

        // Lier le paramètre
        $stmt->bind_param("i", $id);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer le résultat
        $result = $stmt->get_result();

        $voitures = null;

        if ($result->num_rows > 0) {
            // Récupérer les données de la voiture
            $voitures = $result->fetch_assoc();
        }

        // Fermer la connexion à la base de données
        $stmt->close();
        $mysqli->close();

        // Retourner les données de la voiture
        return $voitures;
    }

    static function getAccessoireById($id)
    {
        // Connexion à la base de données
        $mysqli = self::connectDB();

        // Préparer la requête SQL pour éviter les injections SQL
        $stmt = $mysqli->prepare("SELECT id, nom, type, puissance, etat, description,  photo1,photo2,photo3,prix FROM accessoire WHERE id = ?");

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $mysqli->error);
        }

        // Lier le paramètre
        $stmt->bind_param("i", $id);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer le résultat
        $result = $stmt->get_result();

        $accessoires = null;

        if ($result->num_rows > 0) {
            // Récupérer les données de la voiture
            $accessoires = $result->fetch_assoc();
        }

        // Fermer la connexion à la base de données
        $stmt->close();
        $mysqli->close();

        // Retourner les données de la voiture
        return $accessoires;
    }


    static function getVoitures()
    {
        // Connexion à la base de données
        $mysqli = self::connectDB();
        // Requête SQL pour récupérer les voitures
        $sql = "SELECT id, nom, annee, etat,type, photo, prix,typeboite,disponible,style FROM voiture";
        $result = $mysqli->query($sql);

        $voitures = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Ajouter chaque voiture au tableau $voitures
                $voitures[] = $row;
            }
        }

        // Fermer la connexion à la base de données
        $mysqli->close();

        // Retourner le tableau contenant les données des voitures
        return $voitures;
    }

    static function formatNumber($number)
    {
        return number_format($number, 0, '', ' ');
    }

    public static function addCuisine() {
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
        $mysqli = self::connectDB();

        // Préparer la requête SQL pour insérer les données dans la base de données
        $stmt = $mysqli->prepare("INSERT INTO cuisine (nom, etat, description, photo, photo1, photo2, prix) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo "Erreur de préparation de la requête : " . $mysqli->error;
            exit;
        }
        $stmt->bind_param("ssssssi", $nom, $etat, $description, $upload_files[0], $upload_files[1], $upload_files[2], $prix);

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

    public static function addVetement() {

        $nom = $_POST['nom'];
        $etat = $_POST['etat'];
        $cible = $_POST['cible'];
        $type = $_POST['type'];
        $prix = $_POST['prix'];

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
        $mysqli = self::connectDB();

        // Préparer la requête SQL pour insérer les données dans la base de données
        $stmt = $mysqli->prepare("INSERT INTO vetement (nom, etat, type, cible, photo, photo1, photo2, prix) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo "Erreur de préparation de la requête : " . $mysqli->error;
            exit;
        }
        $stmt->bind_param("sssssssi", $nom, $etat, $type, $cible, $upload_files[0], $upload_files[1], $upload_files[2], $prix);

        // Exécuter la requête
        if ($stmt->execute()) {
            header("Location: vetementForms.php?success=1");
        } else {
            header("Location: vetementForms.php?success=0");
        }

        // Fermer la connexion et le statement
        $stmt->close();
        $mysqli->close();
    }

    public static function updateUser($id, $nom, $prenom, $email, $password, $numero) {

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=italievente", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }

        try {
            $sql = "UPDATE user SET nom = :nom, prenom = :prenom, email = :email, password = :password, numero = :numero WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Liaison des paramètres
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Exécution de la requête
            $stmt->execute();

            header("Location: profil.php?success=1");
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
            header("Location: profil.php?success=0");
        }
    }

}
