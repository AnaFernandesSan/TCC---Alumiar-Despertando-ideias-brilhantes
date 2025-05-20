<?php
include "../includes/functions.php"; // Inclua o arquivo de funções onde alterarSenha() está definida

header('Content-Type: application/json');
$response = ['success' => false, 'message' => 'Erro ao alterar a senha.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id']) && isset($data['senha']) && isset($data['senhanova'])) {
        $id = $data['id'];
        $senha = $data['senha'];
        $senhanova = $data['senhanova'];

        $resultado = alterarSenha($id, $senha, $senhanova);

        if ($resultado['success']) {
            $response = [
                'success' => true,
                'message' => 'Senha alterada com sucesso.'
            ];
        } else {
            $response['message'] = 'Erro na função alterarSenha: ' . $resultado['message'];
        }
    } else {
        $response['message'] = 'Dados não enviados corretamente. Verifique os campos do JSON.';
    }
} else {
    $response['message'] = 'Método de solicitação inválido. Utilize POST.';
}

echo json_encode($response);
?>