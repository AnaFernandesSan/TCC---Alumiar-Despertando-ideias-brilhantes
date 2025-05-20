<?php
include "../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["idUser"];

    $result = excluirDadosUser($id);

    if ($result['success']) {
        $response = ['success' => true, 'message' => 'Dados editados com sucesso'];
    } else {
        $response = ['success' => false, 'message' => $result['message']]; 
    }
    

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
