<?php

include "../includes/functions.php";

// Define o cabeçalho para falar que o conteúdo é um JSON
header("Content-Type: application/json");

$pontuacao = array("pontos" => 0); // Valor padrão para evitar retorno de JSON vazio

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Obtém o parâmetro de atividade_id da URL
    if (isset($_GET['atividade_id'])) {
        $atividade_id = intval($_GET['atividade_id']);
        $pontuacao = buscarPontuacao($atividade_id);
    }
}

// Codifica a resposta em JSON e envia
echo json_encode($pontuacao);