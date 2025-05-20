<?php

    include "../includes/functions.php";

    header("Content-Type: application/json");

    $usuario = buscarTodoUsuario(); 

    echo json_encode($usuario);

?>