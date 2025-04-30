<?php
require "haut_page.php";
session_start();

// Connexion à la base de données en PDO
$host = 'localhost';
$dbname = 'projetdaxe';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
if (isset($_POST['update_password'])) {
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Récupérer les infos utilisateur
    $stmt = $conn->prepare("SELECT ID, password FROM User WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($old_password, $user['password'])) {
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update = $conn->prepare("UPDATE User SET password = ? WHERE ID = ?");
            if ($update->execute([$new_hashed_password, $user['ID']])) {
                $message = "Mot de passe modifié avec succès.";
            } else {
                $message = "Erreur lors de la mise à jour.";
            }
        } else {
            $message = "Ancien mot de passe incorrect.";
        }
    } else {
        $message = "Utilisateur introuvable.";
    }
}
?>
