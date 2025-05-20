<?php
include "../includes/functions.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = json_decode(file_get_contents("php://input"), true);
        
        $result = editarPalavra($data["titulo"], $data["video"],$data["id"]);
     
        if ($result) {
            $response = ['success' => true, 'message' => 'Aula editada com sucesso'];
        } else {
            $response = ['success' => false, 'message' => 'Erro ao editar a aula'];
        } 
        header('Content-Type: application/json');
        echo json_encode($response);
    }

   
?>