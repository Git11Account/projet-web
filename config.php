<?php
$host = 'localhost';
$dbname = 'tourisme';
$user = 'root'; // adapte selon ton serveur
$pass = '';     // mot de passe XAMPP/MAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>