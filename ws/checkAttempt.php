<?php
include "../includes/functions.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém os dados da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['usuario_id']) && isset($data['atividade_id'])) {
        $usuarioId = intval($data['usuario_id']);
        $atividadeId = intval($data['atividade_id']);

        // Atualiza ou insere a tentativa
        $result = atualizarTentativa($usuarioId, $atividadeId);

        if ($result) {
            echo json_encode(["success" => true]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar ou inserir tentativa"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Dados inválidos"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}

?>
