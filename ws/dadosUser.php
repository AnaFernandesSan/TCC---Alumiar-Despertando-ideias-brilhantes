<?php

include "../includes/functions.php";

header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $id = $_GET["id"];
    $user = buscarUserPorId($id);
}

echo json_encode($user);