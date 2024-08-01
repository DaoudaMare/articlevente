<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "italievente");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Connexion échouée : " . $mysqli->connect_error);
}

// Requête SQL pour récupérer les voitures
$sql = "SELECT id, nom, annee, etat, photo, prix FROM voiture";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Affichage des voitures sous forme de tableau
    echo "<h2>Liste des voitures</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Année</th><th>État</th><th>Photo</th><th>Prix</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["annee"] . "</td>";
        echo "<td>" . $row["etat"] . "</td>";
        echo "<td><img src='" . $row["photo"] . "' height='100'></td>"; // Affichage de l'image (taille ajustable)
        echo "<td>" . $row["prix"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucune voiture trouvée.";
}

// Fermer la connexion à la base de données
$mysqli->close();
?>
