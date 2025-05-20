<?php
header("Content-Type: application/json");
include "../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET["id"];
    $result = buscarAulaPorId($id);

    if ($result) {
        echo json_encode(['success' => true, 'data' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Quiz não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitação inválido.']);
}
