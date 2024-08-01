<?php
    class methode {
        public static function EnregistrerVoiture($nom, $annee, $etat, $photo, $disponible, $prix) {
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
                
            } catch(PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            
            $conn = null;
        }

        public static function electricPost() {
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
                $mysqli = new mysqli("localhost", "root", "", "italievente");
    
                // Vérifier la connexion
                if ($mysqli->connect_error) {
                    die("Connexion échouée : " . $mysqli->connect_error);
                }
    
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

        private static function connectDB() {
            $mysqli = new mysqli("localhost", "root", "", "italievente");
            if ($mysqli->connect_error) {
                die("Connexion échouée : " . $mysqli->connect_error);
            }
            return $mysqli;
        }

        static function authenticateUser($email, $password) {
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
    }
    


    function getVoitures() {
        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "italievente");
    
        // Vérifier la connexion
        if ($mysqli->connect_error) {
            die("Connexion échouée : " . $mysqli->connect_error);
        }
    
        // Requête SQL pour récupérer les voitures
        $sql = "SELECT id, nom, annee, etat, photo, prix,typeboite,disponible FROM voiture";
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

    function getVoitureById($id) {
        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "italievente");
    
        // Vérifier la connexion
        if ($mysqli->connect_error) {
            die("Connexion échouée : " . $mysqli->connect_error);
        }
    
        // Préparer la requête SQL pour éviter les injections SQL
        $stmt = $mysqli->prepare("SELECT id, nom, annee, etat, photo, prix, typeboite, disponible, photo1,photo2,description FROM voiture WHERE id = ?");
        
        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $mysqli->error);
        }
    
        // Lier le paramètre
        $stmt->bind_param("i", $id);
    
        // Exécuter la requête
        $stmt->execute();
    
        // Récupérer le résultat
        $result = $stmt->get_result();
    
        $voiture = null;
    
        if ($result->num_rows > 0) {
            // Récupérer les données de la voiture
            $voiture = $result->fetch_assoc();
        }
    
        // Fermer la connexion à la base de données
        $stmt->close();
        $mysqli->close();
    
        // Retourner les données de la voiture
        return $voiture;
    }

   

    
?>

