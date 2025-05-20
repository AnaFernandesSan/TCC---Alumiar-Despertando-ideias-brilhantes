<?php
include "../includes/functions.php";
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] === "GET" || $_SERVER["REQUEST_METHOD"] === "POST") {

// Obtém o ID do usuário a partir dos dados GET ou POST
$userId = '';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $userId = isset($_GET["user_id"]) ? $_GET["user_id"] : '';
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = isset($data["user_id"]) ? $data["user_id"] : '';
}

// Verifica se o ID do usuário foi fornecido
if (!$userId) {
    echo json_encode(["error" => "User ID is required."]);
    http_response_code(400); // Bad Request
    exit;
}

// Calcula a pontuação total do usuário
$totalScore = buscarPontuacaoTotal($userId);

// Determina o nível com base na pontuação
$level = 0;
if ($totalScore >= 300) {
    $level = 2;
} elseif ($totalScore >= 100) {
    $level = 1;
} else {
    $level = 0;
}

// Responde com a pontuação total e o nível
echo json_encode([
    "totalScore" => $totalScore,
    "level" => $level
]);

} else {
// Se não for uma requisição GET ou POST, retorna um erro
echo json_encode(["error" => "Invalid request method."]);
http_response_code(405); // Method Not Allowed
}
?>