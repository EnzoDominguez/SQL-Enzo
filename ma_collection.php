<?php
require "haut_page.php";
require "init.php";

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Initialiser les variables avec des valeurs par défaut
$title = 'Titre non disponible';
$artist = 'Artiste inconnu';
$image = 'https://via.placeholder.com/800';
$description = 'Aucune description disponible';
$medium = 'Non spécifié';
$date = 'Date inconnue';
$dimensions = 'Dimensions non spécifiées';

// Fonction pour récupérer les données de l'API Harvard Art Museums
function getArtworkDetails($objectId) {
    $apiKey = 'c5ca7eb1-4650-40b2-9b78-d950e894c1e9';
    $url = "https://api.harvardartmuseums.org/object/{$objectId}?apikey={$apiKey}";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $objectId = $_GET['id'];
    $data = getArtworkDetails($objectId);

    if ($data) {
        // Affecter les données de l'objet récupérées
        $title = $data['title'] ?? $title;
        $artist = isset($data['people'][0]['name']) ? $data['people'][0]['name'] : $artist;
        $image = $data['primaryimageurl'] ?? $image;
        $description = $data['description'] ?? $description;
        $medium = $data['medium'] ?? $medium;
        $date = $data['dated'] ?? $date;
        $dimensions = $data['dimensions'] ?? $dimensions;
    } else {
        echo "<p>Aucune donnée disponible pour cet objet.</p>";
    }
} else {
    echo "<p>Veuillez sélectionner une œuvre.</p>";
}

// Afficher un message si passé dans l'URL
if (isset($_GET['message'])) {
    echo "<p class='text-green-600'>" . htmlspecialchars($_GET['message']) . "</p>";
}

// Récupérer les cartes de l'utilisateur depuis la base de données
$stmt = $conn->prepare("SELECT * FROM collection WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$cartes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if (isset($_GET['message'])): ?>
    <p class="text-green-600"><?php echo htmlspecialchars($_GET['message']); ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Œuvre</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-neutral-100">
    <!-- Afficher les cartes de la collection -->
    <div class="max-w-7xl mx-auto px-8 py-12">
        <h2 class="text-3xl font-serif font-bold mb-8">Ma Collection</h2>

        <?php if (empty($cartes)): ?>
            <p class="text-lg text-neutral-700">Vous n'avez pas encore ajouté d'œuvres à votre collection.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php foreach ($cartes as $carte): ?>
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-md hover:shadow-lg transition">
                        <img src="<?php echo htmlspecialchars($carte['image_url']); ?>" alt="Carte" class="w-full h-60 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h4 class="text-lg font-bold"><?php echo htmlspecialchars($carte['title']); ?></h4>
                            <p class="text-sm text-neutral-600">Artiste : <?php echo htmlspecialchars($carte['artist']); ?></p>

                            <!-- Formulaire de suppression -->
                            <form action="supprimercarte.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette œuvre de votre collection ?');">
                                <input type="hidden" name="carte_id" value="<?php echo htmlspecialchars($carte['id']); ?>">
                                <button type="submit" class="mt-2 px-4 py-2 bg-red-600 text-white rounded">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Détails de l'œuvre -->
    <div class="max-w-7xl mx-auto px-8 py-12">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-4xl font-serif font-bold mb-6"><?php echo htmlspecialchars($title); ?></h2>
            <div class="flex flex-col md:flex-row items-center mb-6">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="w-96 h-auto object-cover rounded-lg mb-4 md:mb-0 md:mr-8">
                <div>
                    <p class="text-xl font-medium text-neutral-700 mb-2">Artiste : <?php echo htmlspecialchars($artist); ?></p>
                    <p class="text-lg text-neutral-700 mb-2">Date : <?php echo htmlspecialchars($date); ?></p>
                    <p class="text-lg text-neutral-700 mb-2">Média : <?php echo htmlspecialchars($medium); ?></p>
                    <p class="text-lg text-neutral-700 mb-2">Dimensions : <?php echo htmlspecialchars($dimensions); ?></p>
                </div>
            </div>
            <h3 class="text-2xl font-serif font-bold mb-4">Description</h3>
            <p class="text-lg text-neutral-700"><?php echo htmlspecialchars($description); ?></p>
        </div>
    </div>

    <footer class="bg-neutral-100 p-8 text-center text-neutral-600 text-sm border-t border-neutral-300">
        &copy; <?php echo date('Y'); ?> Harvard Art Museum. Tous droits réservés.
    </footer>
</body>
</html>
