<?php
include "../includes/functions.php";

// Inicializar a resposta padrão
$response = ['success' => false, 'message' => 'Erro ao enviar a imagem'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o arquivo foi enviado
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['fileInput'];
        $fileName = basename($file['name']);
        $uploadDir = "../imagens/";
        $destination = $uploadDir . $fileName;

        // Mover o arquivo para o diretório de upload
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Verificar se o userId foi enviado
            $userId = $_POST['userId'] ?? null;
            if ($userId) {
                // Atualizar o caminho da imagem no banco de dados
                $result = updateUserPhoto($userId, $destination); // Passe o caminho completo

                if ($result) {
                    $response = ['success' => true, 'message' => 'Imagem atualizada com sucesso'];
                } else {
                    $response = ['success' => false, 'message' => 'Erro ao atualizar o banco de dados'];
                }
            } else {
                $response = ['success' => false, 'message' => 'ID do usuário não fornecido'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Erro ao mover o arquivo'];
        }
    } else {
        $response = ['success' => false, 'message' => 'Nenhum arquivo enviado ou erro no upload'];
    }
} else {
    $response = ['success' => false, 'message' => 'Método de solicitação inválido. Utilize POST.'];
}

// Configurar o cabeçalho para JSON e retornar a resposta
header('Content-Type: application/json');
echo json_encode($response);
?>
