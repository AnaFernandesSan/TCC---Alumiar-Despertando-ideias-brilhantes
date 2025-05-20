<?php
header("Content-Type: application/json; charset=UTF-8");

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saberler_db";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    $result = ["success" => false, "message" => "Conexão falhou: " . $conn->connect_error];
    echo json_encode($result);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (is_array($data)) {
        $conn->autocommit(FALSE);
        $stmt = $conn->prepare("INSERT INTO realiza (user_id, atividade_id, tentativa, pontuacao) VALUES (?, ?, ?, ?)");

        foreach ($data as $attempt) {
            $user_id = $attempt['user_id'];
            $atividade_id = $attempt['atividade_id'];
            $tentativa = $attempt['tentativa'];
            $pontuacao = $attempt['pontuacao'];

            $stmt->bind_param("iidi", $user_id, $atividade_id, $tentativa, $pontuacao);

            if (!$stmt->execute()) {
                $conn->rollback();
                $stmt->close();
                $conn->close();
                $result = ["success" => false, "message" => "Erro ao registrar tentativa: " . $stmt->error];
                echo json_encode($result);
                exit();
            }
        }

        $conn->commit();
        $stmt->close();
        $conn->close();
        $result = ["success" => true, "message" => "Todas as tentativas registradas com sucesso."];
        echo json_encode($result);
    } else {
        $result = ["success" => false, "message" => "Formato de dados inválido."];
        echo json_encode($result);
    }
} else {
    $result = ["success" => false, "message" => "Método de solicitação inválido."];
    echo json_encode($result);
}
?>
