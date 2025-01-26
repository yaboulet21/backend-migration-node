<?php
$host = 'localhost';
$dbname = 'testdb';
$username = 'root';
$password = ''; // Laisse vide si tu n'as pas défini de mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données!";
} catch (PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}
?>
