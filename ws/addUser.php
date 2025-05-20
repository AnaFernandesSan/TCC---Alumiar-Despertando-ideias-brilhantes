<?php
include "../includes/functions.php";

$response = ['success' => false, 'message' => 'Erro ao inserir o usuário'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["nome"]) && !empty($_POST["sobrenome"]) && !empty($_POST["data_nasc"]) && !empty($_POST["email"]) && !empty($_POST["senha"])) {

        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $data_nasc = $_POST["data_nasc"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $tipo = $_POST["tipo"] ?? 'user';

        // Função que insere o usuário no banco
        $result = adicionarUsuario($nome, $sobrenome, $email, $senha, $data_nasc, $tipo);

        if ($result) {
            $response = ['success' => true, 'message' => 'Usuário adicionado com sucesso'];
        } else {
            $response = ['success' => false, 'message' => 'Falha ao adicionar usuário no banco'];
        }
    } else {
        $response = ['success' => false, 'message' => 'Campos obrigatórios estão faltando'];
    }
} else {
    $response = ['success' => false, 'message' => 'Método de requisição inválido'];
}

header('Content-Type: application/json');
echo json_encode($response);
