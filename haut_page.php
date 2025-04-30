<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harvard Style - Accueil</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Tailwind Config for fonts -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              serif: ['Merriweather', 'serif'],
              sans: ['Inter', 'sans-serif'],
            },
            colors: {
              harvardRed: '#A51C30',
            }
          }
        }
      }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
</head>

<body class="bg-white text-neutral-900 font-sans">
    
    <!-- Header -->
    <header class="flex items-center justify-between p-8 border-b border-neutral-300">
        <h1 class="text-3xl font-serif font-bold text-neutral-900">Harvard Art Museum</h1>
        <nav class="space-x-8">
            <a href="index.php" class="text-neutral-700 hover:text-neutral-900 transition">Home</a>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="connexion.php" class="text-neutral-700 hover:text-neutral-900 transition">Connexion</a>
            <?php else: ?>
                <a href="deconnexion.php" class="text-neutral-700 hover:text-neutral-900 transition">Déconnexion</a>
            <?php endif; ?>
            <a href="collection.php" class="text-neutral-700 hover:text-neutral-900 transition">Collections</a>
            <a href="ma_collection.php" class="text-neutral-700 hover:text-neutral-900 transition">Ma collection</a>
            <a href="propos.php" class="text-neutral-700 hover:text-neutral-900 transition">À propos</a>
        </nav>
    </header>
