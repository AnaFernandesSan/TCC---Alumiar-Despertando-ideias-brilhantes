<?php

    include "../includes/functions.php";

    header("Content-Type: application/json");

    $video = buscarTodaAula(); 

    echo json_encode($video);

?>