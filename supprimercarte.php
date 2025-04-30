
<?php
require "init.php";

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Vérifier si l'ID de la carte est fourni
if (isset($_POST['carte_id'])) {
    $carteId = $_POST['carte_id'];
    $userId = $_SESSION['user_id'];

    // Vérifier si la carte appartient à l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM collection WHERE id = ? AND user_id = ?");
    $stmt->execute([$carteId, $userId]);
    $carte = $stmt->fetch();

    if ($carte) {
        // Supprimer la carte de la collection
        $stmt = $conn->prepare("DELETE FROM collection WHERE id = ? AND user_id = ?");
        $stmt->execute([$carteId, $userId]);

        // Rediriger l'utilisateur avec un message de succès
        header("Location: ma_collection.php?message=Œuvre+supprimée+avec+succès");
        exit;
    } else {
        // Si la carte n'existe pas ou n'appartient pas à l'utilisateur
        echo "<p>Cette carte ne vous appartient pas ou n'existe pas.</p>";
    }
} else {
    // Si l'ID de la carte n'est pas fourni
    echo "<p>Aucune carte à supprimer.</p>";
}
