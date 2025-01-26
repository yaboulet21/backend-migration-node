<?php
header('Content-Type: application/json'); // Définir le type de réponse en JSON
require '../db.php';

try {
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($users, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
