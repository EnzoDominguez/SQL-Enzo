<?php 
require "haut_page.php"; 
require "init.php";

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Récupérer les cartes depuis l'API Harvard Art Museums
$apiKey = 'c5ca7eb1-4650-40b2-9b78-d950e894c1e9';
$url = "https://api.harvardartmuseums.org/object?apikey={$apiKey}";
$response = file_get_contents($url);
$data = json_decode($response, true);

// Vérification si l'API a retourné des données
if (!$data || !isset($data['records'])) {
    echo "<p>Aucune œuvre disponible dans la collection.</p>";
    exit;
}

$cartes = $data['records'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection des Œuvres</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-neutral-100">

    <!-- Section Collection depuis l'API -->
    <div class="max-w-7xl mx-auto px-8 py-12">
        <h2 class="text-3xl font-serif font-bold mb-8">Collection d'Œuvres d'Art</h2>

        <?php if (empty($cartes)): ?>
            <p class="text-lg text-neutral-700">Aucune œuvre n'est disponible à afficher.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php foreach ($cartes as $carte): ?>
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-md hover:shadow-lg transition">
                        <a href="ma_collection.php?id=<?php echo htmlspecialchars($carte['id']); ?>">
                            <img src="<?php echo htmlspecialchars($carte['primaryimageurl'] ?? 'https://via.placeholder.com/800'); ?>" alt="Carte" class="w-full h-60 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h4 class="text-lg font-bold"><?php echo htmlspecialchars($carte['title'] ?? 'Titre non disponible'); ?></h4>
                                <p class="text-sm text-neutral-600">Artiste : <?php echo htmlspecialchars($carte['people'][0]['name'] ?? 'Artiste inconnu'); ?></p>
                            </div>
                        </a>
                        <!-- Formulaire pour ajouter une œuvre à la collection de l'utilisateur -->
                        <form action="ajoutercarte.php" method="POST" class="p-4">
                            <input type="hidden" name="image_url" value="<?php echo htmlspecialchars($carte['primaryimageurl'] ?? 'https://via.placeholder.com/800'); ?>">
                            <input type="hidden" name="object_id" value="<?php echo htmlspecialchars($carte['id']); ?>">
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Ajouter à ma collection</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-neutral-100 p-8 text-center text-neutral-600 text-sm border-t border-neutral-300">
        &copy; <?php echo date('Y'); ?> Harvard Art Museum. Tous droits réservés.
    </footer>

</body>
</html>
