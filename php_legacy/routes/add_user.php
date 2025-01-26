<?php
header('Content-Type: application/json');
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['name']) || !isset($input['email'])) {
        echo json_encode(["error" => "Champs name et email requis"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute(["name" => $input['name'], "email" => $input['email']]);
        echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée"]);
}
?>
