<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $utilisateur['id'];
        header('Location: index.php');
        exit;
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<form method="post">
    Email : <input type="email" name="email" required><br>
    Mot de passe : <input type="password" name="mot_de_passe" required><br>
    <button type="submit">Se connecter</button>
</form>