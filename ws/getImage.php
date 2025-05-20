<?php

include "../includes/functions.php";
//define o cabecalho para falar que o conteudo é um json
header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $id = $_GET["id"];
    $foto= buscarFotodoUsuarioPorId($id);
}
echo json_encode($foto);
?>