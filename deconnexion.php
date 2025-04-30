<?php
session_start(); // Démarre la session

// Supprime toutes les variables de session
$_SESSION = [];

// Détruit la session
session_destroy();

// Redirige vers la page de connexion
header("Location: connexion.php");
exit;
