<?php
require 'config.php';
session_start();

$stmt = $pdo->query("SELECT * FROM destinations");
$destinations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Destinations touristiques</h1>
    <ul>
    <?php foreach ($destinations as $dest): ?>
        <li>
            <a href="destination.php?id=<?= $dest['id'] ?>">
                <?= htmlspecialchars($dest['nom']) ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>

    <?php if (isset($_SESSION['utilisateur_id'])): ?>
        <p><a href="deconnexion.php">Se déconnecter</a></p>
    <?php else: ?>
        <p><a href="connexion.php">Connexion</a> | <a href="inscription.php">Inscription</a></p>
    <?php endif; ?>
</div>
</body>
</html>


