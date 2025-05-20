<?php
    include "../includes/functions.php";

    $response = ['success' => false, 'message' => 'Erro ao inserir o usuário'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST["nome"], $_POST["sobrenome"], $_POST["data_nasc"], $_POST["email"], $_POST["senha"])) {

            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];
            $data_nasc = $_POST["data_nasc"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $tipo = "adm";

            $result = adicionarUsuario($nome, $sobrenome, $email, $senha, $data_nasc,$tipo);

            if ($result) {
                $response = ['success' => true, 'message' => 'Usuário adicionado com sucesso'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Dados incompletos para adicionar o usuário'];
        }
    } else {
        $response = ['success' => false, 'message' => 'Método de requisição inválido'];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
?>
