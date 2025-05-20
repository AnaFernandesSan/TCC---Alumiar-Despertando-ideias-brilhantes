<?php

    include "../includes/functions.php";


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tipo =  $_POST['tipo'];
        $dificuldade =  $_POST['dificuldade'];
    
        switch ($tipo) {
            case 'quiz':
                $tipo = 'quiz';
                break;
                case 'arrastar':
                $tipo = 'arrastar';
                break;
        }
        
        switch ($dificuldade) {
            case 'facil':
                $pontos = 10;
                break;
            case 'medio':
                $pontos = 20;
                break;
            case 'dificil':
                $pontos = 30;
                break;
        
        }

        $result_atividade = adicionarAtividade($tipo, $dificuldade, $pontos);
        header('Content-Type: application/json');
        echo json_encode($result_atividade);
        
    }else{
            $response = ['success' => false, 'message' => 'DEU MERDA'];
        }
?>
