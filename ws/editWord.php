<?php
include "../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capture os dados do formulário
    $id = $_POST['idWordEditar'];
    $word = $_POST['word_novo'];

    // Defina o diretório de upload
    $diretorioImagem = "../uploads/fotos";

    // Verifique se há um arquivo de imagem sendo enviado
    if (!empty($_FILES['nova_foto']['name'])) {
        // Gere um nome único para a imagem
        $imagem = uniqid() . "_" . basename($_FILES['nova_foto']['name']);
        $caminhoImagem = $diretorioImagem . '/' . $imagem;

        // Tente mover a imagem para o diretório
        if (!move_uploaded_file($_FILES['nova_foto']['tmp_name'], $caminhoImagem)) {
            echo json_encode(['success' => false, 'message' => 'Erro ao mover a nova imagem.']);
            exit;
        }
    } else {
        // Se não houver uma nova imagem, mantenha o valor da foto anterior
        // Se não houver imagem anterior, você pode passar NULL ou algum valor padrão
        $imagem = isset($_POST['imagem']) && !empty($_POST['imagem']) ? $_POST['imagem'] : null;
    }

    // Chama a função para editar a palavra
    $result = editarPalavra($id, $word, $imagem);

    // Crie a resposta JSON
    if ($result) {
        $response = ['success' => true, 'message' => 'Palavra editada com sucesso'];
    } else {
        $response = ['success' => false, 'message' => 'Erro ao editar a palavra'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Para garantir que nada mais seja enviado
}
?>
