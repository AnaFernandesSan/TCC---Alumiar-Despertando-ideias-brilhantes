<?php
include "../includes/functions.php";
header('Content-Type: application/json');

$response = ['success' => false]; // Inicialize a resposta com falha

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $video = $_POST["video"];
    
    $result = adicionarVideo($titulo, $video, $descricao);

    if ($result) {
        $response = ['success' => true]; // Sucesso ao adicionar
    }
}

echo json_encode($response);
?>
