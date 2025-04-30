<?php

// Inclure le fichier de configuration de la base de données
require_once 'init.php';

// Vérifier si la session est déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupérer les données envoyées par le formulaire
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Vérifier que les champs sont remplis
if (empty($email) || empty($password)) {
    header("Location: connexion.php?error=Veuillez+remplir+tous+les+champs.");
    exit;
}

// Vérifier si l'email existe dans la base de données (avec la table `user`)
$stmt = $conn->prepare("SELECT id, name, password FROM user WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe et si le mot de passe est correct
if ($user && password_verify($password, $user['password'])) {
    // Si l'utilisateur existe et le mot de passe est valide, on commence une session
    $_SESSION['user_id'] = $user['id'];  // Enregistrer l'ID de l'utilisateur dans la session
    $_SESSION['name'] = $user['name'];   // Enregistrer le nom d'utilisateur dans la session
    
    // Rediriger vers la page de la collection après une connexion réussie
    header("Location: ma_collection.php");
    exit;
} else {
    // Si les informations sont incorrectes
    header("Location: connexion.php?error=Identifiants+incorrects.");
    exit;
}

?>
