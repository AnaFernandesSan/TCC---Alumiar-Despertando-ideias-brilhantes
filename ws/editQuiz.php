<?php
include "../includes/functions.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Recebendo os dados do formulário
    $id = $_POST["idQuizEditar"];
    $nome = $_POST["nome_novo"];
    $pergunta = $_POST["pergunta_novo"];
    $tipo = $_POST["opcao_novo"];
    $dificuldade = $_POST["novo_dificuldade"];

    // Garantir que as respostas são recebidas como um array
    if (isset($_POST['resposta_novo']) && is_array($_POST['resposta_novo'])) {
        $respostas_novo = $_POST['resposta_novo'];
    } else {
        echo json_encode(['success' => false, 'message' => 'Respostas não enviadas corretamente.']);
        exit;
    }

    // Garantir que a resposta correta seja recebida
    $correta_novo = isset($_POST['correta_novo']) ? $_POST['correta_novo'] : null;

    // Tratamento da imagem
    $diretorioImagem = "../uploads/fotos";
    if (!empty($_FILES['nova_foto']['name'])) {
        $imagem = uniqid() . "_" . basename($_FILES['nova_foto']['name']);
        $caminhoImagem = $diretorioImagem . '/' . $imagem;

        if (!move_uploaded_file($_FILES['nova_foto']['tmp_name'], $caminhoImagem)) {
            echo json_encode(['success' => false, 'message' => 'Erro ao mover a nova imagem.']);
            exit;
        }
    } else {
        $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : null;
    }


    $result = editarQuiz($id, $nome, $pergunta, $tipo, $dificuldade, $imagem, $respostas_novo, $correta_novo);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Quiz editado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao editar o quiz.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}
