<?php
include "../includes/functions.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $data = json_decode(file_get_contents("php://input"),true);
    
    $result = excluirAula($data["id"]);

    if($result){
        $response = ['success' => true, 'message' => 'Aula removida com sucesso'];
    }else{
        $response = ['success' => false, 'message' => 'Erro ao remover a aula'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}