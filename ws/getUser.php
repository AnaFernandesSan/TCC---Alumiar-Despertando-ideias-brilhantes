<?php
include "../includes/functions.php";


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET["id"];
    $usuario = buscarUserPorId($id);

    // Depure a variável $tarefa para verificar seu conteúdo
    // Isso imprimirá os detalhes da variável no servidor


    echo json_encode($usuario);
}
?>