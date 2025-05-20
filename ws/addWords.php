<?php
include "../includes/functions.php";

$response = ['success' => false, 'message' => 'Erro ao inserir a palavra'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de que há um ponto e vírgula após esta linha
    $word = $_POST["word"];
  
    if (isset($_FILES['foto'])) {
        $foto = $_FILES['foto'];
        $foto_nome = $foto['name'];
        $foto_erro = $foto['error'];
        $foto_tmp = $foto['tmp_name'];

        if ($foto_erro == UPLOAD_ERR_OK) {
            $destino = "../imagens/" . $foto_nome;
            if (move_uploaded_file($foto_tmp, $destino)) {
                $result = adicionarWord($word, $destino);

                if ($result) {
                    $response = ['success' => true, 'message' => 'Palavra e foto adicionadas com sucesso'];
                } else {
                    $response = ['success' => false, 'message' => 'Erro ao adicionar a palavra e foto no banco de dados'];
                }
            } else {
                $response = ['success' => false, 'message' => 'Erro ao mover a foto para o destino'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Erro ao fazer upload da foto'];
        }
    } else {
        $response = ['success' => false, 'message' => 'O campo de foto é obrigatório'];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
