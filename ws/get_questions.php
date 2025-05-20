<?php
include "../includes/functions.php";
header('Content-Type: application/json');
$dificuldade = isset($_GET['dificuldade']) ? $_GET['dificuldade'] : null;


$questoes = getQuestoes($dificuldade);



echo json_encode($questoes);
?>
