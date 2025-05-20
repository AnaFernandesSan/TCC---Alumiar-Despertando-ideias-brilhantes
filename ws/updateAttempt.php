<?php
include "../includes/functions.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['user_id']) && isset($data['atividade_id'])) {
        $userId = intval($data['user_id']);
        $atividadeId = intval($data['atividade_id']);

        // Atualiza o número de tentativas
        $success = atualizarTentativa($userId, $atividadeId);

        echo json_encode(["success" => $success]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Dados inválidos"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}

?>
