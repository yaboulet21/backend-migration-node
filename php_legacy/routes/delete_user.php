<?php
header('Content-Type: application/json');
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['id'])) {
        echo json_encode(["error" => "ID utilisateur requis"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(["id" => $input['id']]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Utilisateur supprimé"]);
        } else {
            echo json_encode(["error" => "Utilisateur non trouvé"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Méthode non autorisée"]);
}
?>
