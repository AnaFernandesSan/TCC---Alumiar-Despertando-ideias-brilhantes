<?php
include "../includes/functions.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Verifica se o parâmetro id foi passado na URL
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = intval($_GET["id"]);
        $aula = buscarAulaPorId($id);
    } else {
        $aula = ['success' => false, 'message' => 'ID inválido'];
    }

    echo json_encode($aula);
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitação inválido.']);
}
?>
