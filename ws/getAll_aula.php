<?php

include "../includes/functions.php";

header("Content-Type: application/json");

$aulas = buscarTodaAula();

echo json_encode($aulas);