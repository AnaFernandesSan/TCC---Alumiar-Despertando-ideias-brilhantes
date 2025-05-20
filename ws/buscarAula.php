<?php

include "../includes/functions.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $videos = buscarVideos(); // Chamando a função buscarVideos() que foi definida na resposta anterior
    echo json_encode($videos);
} else {
    // Se a solicitação não for GET, você pode retornar um erro ou outra resposta apropriada.
    echo json_encode(['error' => 'Método não suportado']);
}
