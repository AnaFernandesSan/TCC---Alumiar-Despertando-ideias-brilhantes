<?php

include "../includes/functions.php";

header("Content-Type: application/json");

$quiz = buscarTodosOsQuizzes(); 

echo json_encode($quiz);