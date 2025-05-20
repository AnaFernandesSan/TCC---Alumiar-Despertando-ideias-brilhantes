<?php

include "../includes/functions.php";
$dificuldade = isset($_GET['dificuldade']) ? $_GET['dificuldade'] : null;

$result = getQuestoesArrastar($dificuldade);
header("Content-Type: application/json");
echo json_encode($result);
?>
