<?php
require 'config.php';
session_start();

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->execute([$id]);
$destination = $stmt->fetch();

if (!$destination) {
    die("Destination introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['utilisateur_id'])) {
    $commentaire = $_POST['commentaire'];
    $utilisateur_id = $_SESSION['utilisateur_id'];

    $stmt = $pdo->prepare("INSERT INTO avis (utilisateur_id, destination_id, commentaire) VALUES (?, ?, ?)");
    $stmt->execute([$utilisateur_id, $id, $commentaire]);
}

$stmt = $pdo->prepare("SELECT a.commentaire, u.nom FROM avis a JOIN utilisateurs u ON a.utilisateur_id = u.id WHERE destination_id = ?");
$stmt->execute([$id]);
$avis = $stmt->fetchAll();
?>

<h2><?= htmlspecialchars($destination['nom']) ?></h2>
<p><?= htmlspecialchars($destination['description']) ?></p>

<h3>Avis :</h3>
<?php foreach ($avis as $a): ?>
    <p><strong><?= htmlspecialchars($a['nom']) ?> :</strong> <?= htmlspecialchars($a['commentaire']) ?></p>
<?php endforeach; ?>

<?php if (isset($_SESSION['utilisateur_id'])): ?>
    <form method="post">
        <textarea name="commentaire" required></textarea><br>
        <button type="submit">Poster un avis</button>
    </form>
<?php else: ?>
    <p><a href="connexion.php">Connectez-vous</a> pour laisser un avis.</p>
<?php endif; ?>