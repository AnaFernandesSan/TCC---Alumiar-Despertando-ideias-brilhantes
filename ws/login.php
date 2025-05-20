<?php
include "../includes/functions.php";

$response = ['success' => false, 'message' => 'Email ou senha inválidos'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['email']) && isset($data['senha'])) {
        $email = $data['email'];
        $senha = $data['senha'];
        
        // Verifica o login e retorna os dados do usuário
        $resultado = verificarLogin($email, $senha);

        if ($resultado['success']) {
            $response = [
                'success' => true,
                'message' => 'Login efetuado com sucesso',
                'id' => $resultado['data']['id'], // Inclui o ID na resposta
                'token' => $resultado['data']['token'],
                'tipo' => $resultado['data']['tipo']
            ];
        } else {
            $response['message'] = $resultado['message'];

        }
    } else {
        $response['message'] = 'Email ou senha não foram enviados corretamente';
    }
}

echo json_encode($response);
?>

