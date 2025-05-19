<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $mot_de_passe]);

    echo "<p>Inscription réussie. <a href='connexion.php'>Connectez-vous</a></p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Inscription</h2>
    <form method="post">
        Nom : <input type="text" name="nom" required><br>
        Email : <input type="email" name="email" required><br>
        Mot de passe : <input type="password" name="mot_de_passe" required><br>
        <button type="submit">S'inscrire</button>
    </form>
</div>
</body>
</html>