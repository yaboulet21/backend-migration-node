<?php
header('Content-Type: application/json');
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['id']) || !isset($input['name']) || !isset($input['email'])) {
        echo json_encode(["error" => "ID, name et email requis"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->execute([
            "id" => $input['id'],
            "name" => $input['name'],
            "email" => $input['email']
        ]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Utilisateur mis à jour"]);
        } else {
            echo json_encode(["error" => "Aucune modification effectuée ou utilisateur non trouvé"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée"]);
}
?>
