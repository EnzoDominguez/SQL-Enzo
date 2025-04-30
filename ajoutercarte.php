<?php
require "init.php";

// Vérifier la session
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

$userId = $_SESSION['user_id'];
$imageUrl = $_POST['image_url'] ?? '';
$objectId = $_POST['object_id'] ?? '';

// Si un object ID est fourni, on peut enrichir avec des infos API
if ($objectId) {
    $apiKey = 'c5ca7eb1-4650-40b2-9b78-d950e894c1e9';
    $url = "https://api.harvardartmuseums.org/object/{$objectId}?apikey={$apiKey}";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    $title = $data['title'] ?? 'Titre inconnu';
    $artist = isset($data['people'][0]['name']) ? $data['people'][0]['name'] : 'Artiste inconnu';

    // Vérifie si l'œuvre est déjà dans la collection
    $stmt = $conn->prepare("SELECT id FROM collection WHERE user_id = ? AND object_id = ?");
    $stmt->execute([$userId, $objectId]);
    if (!$stmt->fetch()) {
        // Insertion
        $stmt = $conn->prepare("INSERT INTO collection (user_id, image_url, object_id, title, artist) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $imageUrl, $objectId, $title, $artist]);
    }
}

header("Location: ma_collection.php?message=Œuvre+ajoutée+avec+succès");
exit;
