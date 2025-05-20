<?php

include "../includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $pergunta = isset($_POST['pergunta']) ? $_POST['pergunta'] : null;
    $tipo = isset($_POST['opcao']) ? $_POST['opcao'] : 'normal';
    $imagem = '';
    $respostas = isset($_POST['respostas']) ? $_POST['respostas'] : [];
    $resposta_correta = isset($_POST['resposta_correta']) ? $_POST['resposta_correta'] : null;

    if ($tipo === 'imagem' && isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $imagem = $_FILES['foto'];
        $imagem_nome = basename($imagem['name']);
        $imagem_tmp = $imagem['tmp_name'];
        $destino = '../uploads/fotos/' . $imagem_nome;

        if (move_uploaded_file($imagem_tmp, $destino)) {
            $imagem = $destino;
        } else {
            $response = ['success' => false, 'message' => 'Erro ao mover a imagem para o destino'];
            echo json_encode($response);
            exit();
        }
    }

    $respostas_array = [];
    foreach ($respostas as $id_resposta => $resposta_texto) {
        $respostas_array[$id_resposta] = $resposta_texto;
    }

    $result = adicionarQuiz($nome, $tipo, $pergunta, $imagem, $respostas_array, $resposta_correta);
    echo json_encode($result);
} else {
    echo "Método de solicitação inválido.";

}
?>

