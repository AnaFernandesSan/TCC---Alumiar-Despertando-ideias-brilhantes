<?php
include "../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Receber os dados via POST
    $id = $_POST["idUser"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $data_nasc = $_POST["data_nasc"];

    $result = editarDadosUser($id, $nome, $sobrenome, $email, $data_nasc);

    if ($result['success']) {
        $response = ['success' => true, 'message' => 'Dados editados com sucesso'];
    } else {
        $response = ['success' => false, 'message' => $result['message']]; 
    }
    

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
