<?php

include "../includes/functions.php";

header("Content-Type: application/json");

$words = buscarTodaPalavra();

echo json_encode($words);