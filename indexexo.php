<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=library;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Supprimer un livre
if (isset($_GET['id']) && $_GET['action'] === 'delete') {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM book WHERE titre = ?");
    $stmt->execute([$id]);
    header("Location: indexexo.php");
    exit;
}

// Ajouter un livre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['titre']) && !empty($_POST['auteur']) && !empty($_POST['date_publication'])) {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date_publication = (int)$_POST['date_publication'];
        $disponible = isset($_POST['disponible']) ? 1 : 0;

        $stmt = $pdo->prepare("INSERT INTO book (titre, auteur, date_publication, disponible) VALUES (?, ?, ?, ?)");
        $stmt->execute([$titre, $auteur, $date_publication, $disponible]);
        header("Location: indexexo.php");
        exit;
    }
}

// Récupérer tous les livres
$stmt = $pdo->query("SELECT * FROM book ORDER BY titre ASC");
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les livres publiés après 2000
$stmt2000 = $pdo->query("SELECT * FROM book WHERE date_publication > 2000 ORDER BY titre ASC");
$livres_apres_2000 = $stmt2000->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue des Livres</title>
</head>
<body>

    <h1>Catalogue complet</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Disponible</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $livre): ?>
                <tr>
                    <td><?= isset($livre['id']) ? $livre['id'] : 'N/A' ?></td>
                    <td><?= isset($livre['titre']) ? htmlspecialchars($livre['titre']) : 'N/A' ?></td>
                    <td><?= isset($livre['auteur']) ? htmlspecialchars($livre['auteur']) : 'N/A' ?></td>
                    <td><?= isset($livre['date_publication']) ? $livre['date_publication'] : 'N/A' ?></td>
                    <td><?= isset($livre['disponible']) ? ($livre['disponible'] ? 'Oui' : 'Non') : 'N/A' ?></td>
                    <td><a href="?id=<?= isset($livre['id']) ? $livre['id'] : '' ?>&action=delete" onclick="return confirm('Supprimer ce livre ?');">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Ajouter un livre</h2>
    <form method="POST">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required><br><br>

        <label for="auteur">Auteur :</label>
        <input type="text" name="auteur" id="auteur" required><br><br>

        <label for="date_publication">Année de publication :</label>
        <input type="number" name="date_publication" id="date_publication" required><br><br>

        <label for="disponible">Disponible :</label>
        <input type="checkbox" name="disponible" id="disponible" checked><br><br>

        <input type="submit" value="Ajouter le livre">
    </form>

    <h2>Livres publiés après 2000 (triés par titre)</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Disponible</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres_apres_2000 as $livre): ?>
                <tr>
                    <td><?= isset($livre['id']) ? $livre['id'] : 'N/A' ?></td>
                    <td><?= isset($livre['titre']) ? htmlspecialchars($livre['titre']) : 'N/A' ?></td>
                    <td><?= isset($livre['auteur']) ? htmlspecialchars($livre['auteur']) : 'N/A' ?></td>
                    <td><?= isset($livre['date_publication']) ? $livre['date_publication'] : 'N/A' ?></td>
                    <td><?= isset($livre['disponible']) ? ($livre['disponible'] ? 'Oui' : 'Non') : 'N/A' ?></td>
                </tr>
            <?php endforeach; ?>
