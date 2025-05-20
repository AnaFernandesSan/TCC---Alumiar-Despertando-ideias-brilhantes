<?php
header("Content-Type: application/json");
include "../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["idVideoEditar"];
    $titulo = $_POST["titulo_novo"];
    $descricao = $_POST["descricao_novo"];
    $video = $_POST["video-caminho"];

    $result = editarAula($id, $titulo, $video, $descricao);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Vídeo editado com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao editar o vídeo no banco de dados.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitação inválido.']);
}
