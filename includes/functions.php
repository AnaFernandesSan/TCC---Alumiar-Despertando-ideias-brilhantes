<?php

include "../banco/conn.php";

function alterarSenha($id, $senha, $senhanova)
{
    $conn = connect();
    if (!$conn) {
        return ['success' => false, 'message' => 'Não foi possível conectar ao banco de dados.'];
    }

    $sql = "SELECT senha FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($result);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $senhaNovaHash = password_hash($senhanova, PASSWORD_BCRYPT);

        $sql = "UPDATE usuario SET senha = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $senhaNovaHash, $id);
        $success = mysqli_stmt_execute($stmt);

        mysqli_close($conn);

        return $success ? ['success' => true] : ['success' => false, 'message' => 'Erro ao atualizar a senha.'];
    } else {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Senha antiga incorreta.'];
    }
}

function buscarUserPorId($id)
{
    $conn = connect();
    $sql = "SELECT id,  nome,sobrenome,email,senha,data_nasc FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    $usuario = null;
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($result);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $usuario;
}


function adicionarUsuario($nome, $sobrenome, $email, $senha, $data_nasc, $tipo)
{
    $conn = connect();
    // Supondo que $data_nasc já está no formato correto 'Y-m-d'
    $dateObj = DateTime::createFromFormat('Y-m-d', $data_nasc);

    // Verifique se $dateObj é um objeto DateTime válido
    if (!$dateObj) {
        error_log('Erro: Formato de data inválido');
        return ['success' => false, 'message' => 'Formato de data inválido'];
    }

    $data_nasc_formatada = $dateObj->format('Y-m-d');
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    if (!$conn) {
        error_log('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
        return ['success' => false, 'message' => 'Erro na conexão com o banco de dados'];
    }

    // Adiciona o campo tipo na query
    $sql = "INSERT INTO usuario (nome, sobrenome, email, senha, data_nasc, tipo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        error_log('Erro na preparação da declaração SQL: ' . mysqli_error($conn));
        return ['success' => false, 'message' => 'Erro na preparação da declaração SQL'];
    }

    // Corrige o número de parâmetros para 6
    mysqli_stmt_bind_param($stmt, "ssssss", $nome, $sobrenome, $email, $senha_criptografada, $data_nasc_formatada, $tipo);

    $ret = false;

    if (mysqli_stmt_execute($stmt)) {
        $ret = true;
        error_log('Usuário adicionado com sucesso');
    } else {
        error_log('Erro na execução da declaração SQL: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return ['success' => $ret, 'message' => $ret ? 'Usuário adicionado com sucesso' : 'Erro ao inserir o usuário'];
}


function verificarLogin($email, $senha)
{
    $conn = connect();
    $sql = "SELECT id, nome, sobrenome, email, senha, data_nasc, nivel, foto, token, token_tempoVida, tipo FROM usuario WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Erro ao preparar a consulta.'];
    }

    mysqli_stmt_bind_param($stmt, 's', $email);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Erro ao executar a consulta.'];
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        if (isset($usuario["senha"]) && password_verify($senha, $usuario["senha"])) {
            // Gerar um novo token e definir o tempo de vida
            $usuario["token"] = bin2hex(random_bytes(32));
            $now = new DateTime();
            $usuario["token_tempoVida"] = $now->format('Y-m-d H:i:s');

            // Verificar se os valores estão corretos
            error_log("Novo token: " . $usuario["token"]);
            error_log("Tempo de vida do token: " . $usuario["token_tempoVida"]);

            // Atualizar o token e o tempo de validade no banco de dados
            if (atualizarToken($usuario["id"], $usuario["token"], $usuario["token_tempoVida"])) {
                unset($usuario["senha"]); // Remove a senha do array antes de retornar
                mysqli_close($conn);
                return ['success' => true, 'data' => $usuario]; // Retorna o usuário com o novo token
            } else {
                mysqli_close($conn);
                return ['success' => false, 'message' => 'Erro ao atualizar o token.'];
            }
        } else {
            mysqli_close($conn);
            return ['success' => false, 'message' => 'Senha incorreta.'];
        }
    } else {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Usuário não encontrado.'];
    }
}

function buscarTodoUsuario()
{
    $conn = connect();
    $sql = "SELECT id, nome, sobrenome, email, senha, data_nasc, tipo FROM usuario";
    $stmt = mysqli_prepare($conn, $sql);

    $ret = false;
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $usuarioS = array();
        mysqli_close($conn);
        while ($e = mysqli_fetch_assoc($result)) {
            array_push($usuarioS, $e);
        }
        mysqli_stmt_close($stmt);
        return $usuarioS;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $ret;
}
function atualizarToken($userId, $token, $tokenTempoVida)
{
    $conn = connect();
    $sql = "UPDATE usuario SET token = ?, token_tempoVida = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        error_log('Erro ao preparar a consulta de atualização do token: ' . mysqli_error($conn));
        mysqli_close($conn);
        return false;
    }

    // Verifica se a ligação dos parâmetros está correta
    mysqli_stmt_bind_param($stmt, 'ssi', $token, $tokenTempoVida, $userId);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return true;
    } else {
        error_log('Erro ao executar a atualização do token: ' . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}

function validateToken($id, $token)
{
    $ret = false;
    $conn = connect();

    $sql = "SELECT token,token_tempoVida  FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $date1 = date_create_from_format('Y-m-d H:i:s', $row['token_tempoVida']);
            $now = new DateTime();
            $diff = date_diff($date1, $now);

            if ($token == $row["token"] && $diff->days > 0) {
                $token = null;
                $tokenVida = null;
                atualizarToken($row["id"], $token, $tokenVida);
            } else {
                $ret = true;
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $ret;
}

function adicionarAtividade($tipo, $dificuldade, $pontos)
{
    $conn = connect();

    $sql = "INSERT INTO atividade (tipo, dificuldade, pontos) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $tipo, $dificuldade, $pontos);

    if (!$stmt->execute()) {
        return ['success' => false, 'message' => 'Erro ao adicionar atividade: ' . $stmt->error];
    }

    $atividade_id = $conn->insert_id;
    $stmt->close();
    $conn->close();

    return ['success' => true, 'atividade_id' => $atividade_id];
}

function inserirAtividadesNosBancosSeparados($nome, $atividade_id)
{
    $conn = connect();

    $sql_arrastar = "SELECT id FROM atividade WHERE tipo = 'arrastar'";
    $result_arrastar = $conn->query($sql_arrastar);

    if ($result_arrastar->num_rows > 0) {
        while ($row = $result_arrastar->fetch_assoc()) {
            $atividade_id = $row['id'];

            $sql_insert_arrastar = "INSERT INTO arrastar (atividade_id, nome) VALUES (?, ?)";
            $stmt_arrastar = $conn->prepare($sql_insert_arrastar);
            $stmt_arrastar->bind_param("i", $atividade_id, $nome);

            if (!$stmt_arrastar->execute()) {
                echo "Erro ao inserir na tabela arrastar: " . $stmt_arrastar->error;
            }
        }
    }

    $stmt_arrastar->close();
    $conn->close();
}


function adicionarVideo($titulo, $video, $descricao)
{
    $conn = connect();

    $sql = "INSERT INTO videos (titulo, video,descricao) VALUES (?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        error_log("Failed to prepare statement: " . mysqli_error($conn));
        mysqli_close($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sss", $titulo, $video, $descricao);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return true;
    } else {
        error_log("Failed to execute statement: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}

function buscarTodaPalavra(){
    $conn = connect();
    $sql = "SELECT atividade_id, word, foto FROM arrastar";
    $stmt = mysqli_prepare($conn, $sql);

    $ret = false;
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $words = array();
        mysqli_close($conn);
        while ($e = mysqli_fetch_assoc($result)) {
            array_push($words, $e);
        }
        mysqli_stmt_close($stmt);
        return $words;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $ret;
}


function buscarPalavraPorId($atividade_id)
{
    $conn = connect(); // Supondo que você tenha uma função para conectar ao banco de dados

    $sql = "SELECT word, foto FROM arrastar WHERE atividade_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $atividade_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Retorna os dados da palavra
    } else {
        return false; // Palavra não encontrada
    }
}
function editarPalavra($id, $word, $foto) {
    $conn = connect();

    if ($foto === null) {
       
        $sql_select = "SELECT foto FROM arrastar WHERE atividade_id = ?";
        $stmt_select = mysqli_prepare($conn, $sql_select);
        mysqli_stmt_bind_param($stmt_select, "i", $id);
        mysqli_stmt_execute($stmt_select);
        mysqli_stmt_bind_result($stmt_select, $foto);
        mysqli_stmt_fetch($stmt_select);
        mysqli_stmt_close($stmt_select);
    }
   
    $sql = "UPDATE arrastar SET word = ?, foto = ? WHERE atividade_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $word, $foto, $id);
    $ret = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    return $ret; 
}


function excluirPalavra($id){
    $conn = connect();
    $sql = "DELETE FROM arrastar WHERE atividade_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    $ret = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
    return $ret;
}

function buscarFotoPorId($atividade_id)
{
    $conn = connect();

    $sql = "SELECT foto FROM arrastar WHERE atividade_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $atividade_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $word = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $word;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return null;
    }
}


function registerAttempt($user_id, $atividade_id, $tentativa, $pontuacao)
{
    $conn = connect();

    if (!$conn) {
        return ["success" => false, "message" => "Erro ao conectar ao banco de dados."];
    }

    $sql = "INSERT INTO realiza (user_id, atividade_id, tentativa, pontuacao) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iidi", $user_id, $atividade_id, $tentativa, $pontuacao);

    if (mysqli_stmt_execute($stmt)) {
        $result = ["success" => true, "message" => "Tentativa registrada com sucesso."];
    } else {
        $result = ["success" => false, "message" => "Erro ao registrar tentativa: " . mysqli_stmt_error($stmt)];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $result;
}


function buscarPontuacao($atividade_id)
{
    $conn = connect();

    $sql = "SELECT pontos FROM atividade WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $atividade_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $pontuacao = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $pontuacao ? $pontuacao : array("pontos" => 0); // Garante que retornamos um array
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return array("pontos" => 0); // Valor padrão
    }
}

function verificarTentativa($user_id, $atividade_id)
{
    $conn = connect(); // Conecta ao banco de dados

    $sql = "SELECT COUNT(*) as count FROM tentativas WHERE usuario_id = ? AND atividade_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $atividade_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $data['count'] > 0; // Retorna true se a tentativa existir, false caso contrário
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false; // Erro na execução
    }
}

function atualizarTentativa($user_id, $atividade_id)
{
    $conn = connect(); // Conecta ao banco de dados

    $sql = "UPDATE realiza SET tentativa = tentativa + 1 WHERE usuario_id = ? AND atividade_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $atividade_id);

    if (mysqli_stmt_execute($stmt)) {
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $affected_rows > 0; // Retorna true se a atualização for bem-sucedida
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false; // Erro na execução
    }
}

function buscarPontuacaoTotal($userId)
{
    $conn = connect();


    $userId = $conn->real_escape_string($userId);


    $sql = "SELECT SUM(pontuacao) AS totalScore FROM realiza WHERE user_id = '$userId'";
    $result = $conn->query($sql);

    $totalScore = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalScore = $row['totalScore'] !== null ? (int)$row['totalScore'] : 0; // Garante que o valor é um número inteiro
    }

    $conn->close();
    return $totalScore;
}


function adicionarWord($word, $foto) {
    $conn = connect();

    $sql_quiz = "SELECT id FROM atividade WHERE tipo = 'arrastar'";
    $result_quiz = $conn->query($sql_quiz);

    $atividade_id = null;
    while ($row = $result_quiz->fetch_assoc()) {
        $atividade_id = $row['id'];
    }
    // Se não existir, insere o novo registro
    $sql = "INSERT INTO arrastar (atividade_id, word, foto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $atividade_id, $word, $foto);  // "i" para inteiro, "ss" para strings
    $result = $stmt->execute();

    if ($result) {
        return ['success' => true, 'message' => 'Palavra e foto adicionadas com sucesso'];
    } else {
        return ['success' => false, 'message' => 'Erro ao adicionar no banco de dados'];
    }
}



function updateUserPhoto($userId, $fileName)
{
    $conn = connect(); // Função para conectar ao banco de dados
    if (!$conn) {
        error_log('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
        return false;
    }

    $sql = "UPDATE usuario SET foto = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        error_log('Erro na preparação da declaração SQL: ' . mysqli_error($conn));
        mysqli_close($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "si", $fileName, $userId);

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $result;
}

function buscarFotodoUsuarioPorId($id)
{
    $conn = connect();

    $sql = "SELECT id, foto FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $foto = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $foto;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return null;
    }
}
function getQuestoes($dificuldade = null) {
    $conn = connect();

    // Iniciar a consulta SQL
    $sql_pergunta = "
        SELECT 
            q.atividade_id as quiz_id, 
            q.nome as quiz_nome,
            p.id as pergunta_id, 
            p.pergunta, 
            p.imagem, 
            r.id as resposta_id,
            r.resposta, 
            r.resposta_correta
        FROM quiz q
        LEFT JOIN pergunta p ON q.atividade_id = p.quiz_id
        LEFT JOIN resposta r ON p.id = r.pergunta_id
        LEFT JOIN atividade a ON q.atividade_id = a.id"; // Junção com a tabela atividade

    // Se a dificuldade foi passada, adicionar à consulta
    if ($dificuldade) {
        $sql_pergunta .= " WHERE a.dificuldade = ?";
    }

    $stmt = $conn->prepare($sql_pergunta);

    // Se a dificuldade foi passada, vincular o parâmetro
    if ($dificuldade) {
        $stmt->bind_param("s", $dificuldade);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();

    $questoes = array();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $questoes[] = $row;
        }
    } else {
        echo "0 results";
    }

    $stmt->close();
    $conn->close();

    return ['success' => true, 'data' => array_values($questoes)];
}


function getQuestoesArrastar($dificuldade = null)
{
    $conn = connect(); 

    
    $sql = "SELECT 
                a.id AS atividade_id, 
                a.dificuldade,
                r.word, 
                r.foto 
            FROM arrastar r
            JOIN atividade a ON r.atividade_id = a.id";

    
    if ($dificuldade) {
        $sql .= " WHERE a.dificuldade = ?";
    }

    $stmt = $conn->prepare($sql);
    
  
    if ($dificuldade) {
        $stmt->bind_param("s", $dificuldade);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();
    $atividades = []; 

    if ($resultado->num_rows > 0) {
       
        while ($row = $resultado->fetch_assoc()) {
            $atividades[] = $row; 
        }
    } else {
        
        $atividades = ["message" => "Nenhuma atividade encontrada."];
    }

    $stmt->close();
    $conn->close();
    
    return $atividades;
}




function adicionarQuiz($nome, $tipo, $pergunta, $imagem, $respostas, $resposta_correta)
{
    $conn = connect();

    $sql_quiz = "SELECT id FROM atividade WHERE tipo = 'quiz'";
    $result_quiz = $conn->query($sql_quiz);

    $atividade_id = null;
    while ($row = $result_quiz->fetch_assoc()) {
        $atividade_id = $row['id'];
    }

    $sql_insert_quiz = "INSERT INTO quiz (atividade_id, nome) VALUES (?, ?)";
    $stmt_quiz = $conn->prepare($sql_insert_quiz);
    $stmt_quiz->bind_param("is", $atividade_id, $nome);

    if (!$stmt_quiz->execute()) {
        $conn->close();
        return ['success' => false, 'message' => 'Erro ao inserir na tabela quiz: ' . $stmt_quiz->error];
    }

    $sql_pergunta = "INSERT INTO pergunta (quiz_id, pergunta, imagem, tipo) VALUES (?, ?, ?, ?)";
    $stmt_pergunta = $conn->prepare($sql_pergunta);
    $stmt_pergunta->bind_param("isss", $atividade_id, $pergunta, $imagem, $tipo);

    if (!$stmt_pergunta->execute()) {
        $conn->close();
        return ['success' => false, 'message' => 'Erro ao adicionar pergunta: ' . $stmt_pergunta->error];
    }
    $pergunta_id = $conn->insert_id;

    $sql_resposta = "INSERT INTO resposta (pergunta_id, resposta, resposta_correta) VALUES (?, ?, ?)";
    $stmt_resposta = $conn->prepare($sql_resposta);

    foreach ($respostas as $id_resposta => $resposta_texto) {

        $correta = ($id_resposta + 1 == $resposta_correta) ? 1 : 0;

        $stmt_resposta->bind_param("isi", $pergunta_id, $resposta_texto, $correta);
        if (!$stmt_resposta->execute()) {

            $conn->close();
            return ['success' => false, 'message' => 'Erro ao adicionar resposta: ' . $stmt_resposta->error];
        }
    }
    $stmt_resposta->close();
    $stmt_quiz->close();
    $stmt_pergunta->close();
    $conn->close();

    return ['success' => true, 'message' => 'Quiz adicionado com sucesso'];
}

function editarQuiz($id, $nome_novo, $pergunta_novo, $tipo, $dificuldade, $imagem, $respostas_novo, $correta_novo) {
    // Conecta ao banco de dados
    $conn = connect();

    // Atualiza a dificuldade da atividade
    $sql_atividade = "UPDATE atividade SET dificuldade = ? WHERE id = ?";
    $stmt_atividade = mysqli_prepare($conn, $sql_atividade);
    mysqli_stmt_bind_param($stmt_atividade, "si", $dificuldade, $id);
    if (!mysqli_stmt_execute($stmt_atividade)) {
        echo "Erro na atualização da atividade: " . mysqli_error($conn);
        return false;
    }

    // Atualiza o nome do quiz
    $sql_quiz = "UPDATE quiz SET nome = ? WHERE atividade_id = ?";
    $stmt_quiz = mysqli_prepare($conn, $sql_quiz);
    mysqli_stmt_bind_param($stmt_quiz, "si", $nome_novo, $id);
    if (!mysqli_stmt_execute($stmt_quiz)) {
        echo "Erro na atualização do quiz: " . mysqli_error($conn);
        return false;
    }

    // Busca o ID da pergunta vinculada ao quiz
    $sql_pergunta_id = "SELECT id FROM pergunta WHERE quiz_id = ?";
    $stmt_pergunta_id = mysqli_prepare($conn, $sql_pergunta_id);
    mysqli_stmt_bind_param($stmt_pergunta_id, "i", $id);
    if (!mysqli_stmt_execute($stmt_pergunta_id)) {
        echo "Erro ao buscar o ID da pergunta: " . mysqli_error($conn);
        return false;
    }
    mysqli_stmt_bind_result($stmt_pergunta_id, $id_da_pergunta);
    mysqli_stmt_fetch($stmt_pergunta_id);
    if (empty($id_da_pergunta)) {
        echo "Nenhuma pergunta vinculada ao quiz foi encontrada.<br>";
        return false;
    }
    mysqli_stmt_free_result($stmt_pergunta_id);

    // Atualiza a pergunta
    $sql_pergunta = "UPDATE pergunta SET pergunta = ?, tipo = ?, imagem = ? WHERE id = ?";
    $stmt_pergunta = mysqli_prepare($conn, $sql_pergunta);
    mysqli_stmt_bind_param($stmt_pergunta, "sssi", $pergunta_novo, $tipo, $imagem, $id_da_pergunta);
    if (!mysqli_stmt_execute($stmt_pergunta)) {
        echo "Erro na atualização da pergunta: " . mysqli_error($conn);
        return false;
    }

    // Verifica e decodifica as respostas enviadas
    if (is_string($respostas_novo)) {
        $respostas_novo = json_decode($respostas_novo, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro: O formato das respostas é inválido.";
            return false;
        }
    }

    // Verifica se as respostas são um array
    if (!is_array($respostas_novo)) {
        echo "Erro: O formato das respostas é inválido.";
        return false;
    }

    $query_resposta = "INSERT INTO resposta (pergunta_id, resposta, resposta_correta) VALUES (?, ?, ?)";
    $stmt_resposta = $conn->prepare($query_resposta);

    foreach ($respostas_novo as $index => $resposta) {
        $correta = ($correta_novo == ($index + 1)) ? 1 : 0;

        $query_id_pergunta = "SELECT id FROM pergunta WHERE quiz_id = ? AND pergunta = ?";
        $stmt_id_pergunta = $conn->prepare($query_id_pergunta);
        $stmt_id_pergunta->bind_param("is", $id, $pergunta);
        $stmt_id_pergunta->execute();
        $stmt_id_pergunta->bind_result($pergunta_id);
        $stmt_id_pergunta->fetch();
        $stmt_id_pergunta->close();

        
        if ($pergunta_id) {
            $stmt_resposta->bind_param("isi", $pergunta_id, $resposta, $correta);
            $stmt_resposta->execute();
        }
    }

    if ($stmt_resposta->error) {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar as respostas.']);
        exit;
    }

    // Fecha os prepared statements e a conexão
    mysqli_stmt_close($stmt_pergunta);
    mysqli_stmt_close($stmt_quiz);
    mysqli_stmt_close($stmt_resposta);
    mysqli_stmt_close($stmt_atividade);
    mysqli_close($conn);
    return true; // Retorna true se tudo ocorrer bem
}

function buscarQuizPorId($id)
{
    $conn = connect();

    // Consulta SQL ajustada
    $sql = "
        SELECT q.atividade_id, q.nome, a.dificuldade,
               p.id AS pergunta_id, p.pergunta, p.imagem, p.tipo,
               r.id AS resposta_id, r.resposta, r.resposta_correta
        FROM quiz q
        LEFT JOIN atividade a ON q.atividade_id = a.id
        LEFT JOIN pergunta p ON q.atividade_id = p.quiz_id
        LEFT JOIN resposta r ON p.id = r.pergunta_id
        WHERE q.atividade_id = ?
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ['success' => false, 'message' => 'Erro na preparação da consulta.'];
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        $stmt->close();
        return ['success' => false, 'message' => 'Erro na execução da consulta.'];
    }

    $result = $stmt->get_result();

    // Inicializa a estrutura de dados
    $quizData = [
        'nome' => '',
        'dificuldade' => '',
        'pergunta' => '',
        'imagem' => '',
        'tipo' => '',
        'respostas' => []
    ];

    if ($result->num_rows > 0) {
        // Preenche os dados do quiz
        while ($row = $result->fetch_assoc()) {
            // Preenche os dados do quiz apenas uma vez
            if (empty($quizData['nome'])) {
                $quizData['nome'] = $row['nome'];
                $quizData['dificuldade'] = $row['dificuldade'];
                $quizData['pergunta'] = $row['pergunta'];
                $quizData['imagem'] = $row['imagem'];
                $quizData['tipo'] = $row['tipo'];
            }

            // Adiciona a resposta ao array de respostas
            $quizData['respostas'][] = [
                'id' => $row['resposta_id'],
                'resposta' => $row['resposta'],
                'correta' => $row['resposta_correta']
            ];
        }

        return ['success' => true, 'data' => $quizData];
    } else {
        return ['success' => false, 'message' => 'Nenhum quiz encontrado.'];
    }
}


function buscarTodosOsQuizzes()
{
    // Conectar ao banco de dados
    $conn = connect();

    if ($conn->connect_error) {
        die("Erro de conexão: {$conn->connect_error}");
    }

    // Consulta SQL ajustada
    $sql = "
        SELECT 
            q.atividade_id as id, 
            q.nome,
            a.dificuldade,
            a.pontos,
            p.id as pergunta_id, 
            p.pergunta, 
            p.imagem, 
            p.tipo, 
            r.id as resposta_id, 
            r.resposta, 
            r.resposta_correta
        FROM quiz q
        INNER JOIN atividade a ON q.atividade_id = a.id
        LEFT JOIN pergunta p ON q.atividade_id = p.quiz_id
        LEFT JOIN resposta r ON p.id = r.pergunta_id
    ";

    // Preparar e executar a consulta
    $stmt = $conn->prepare($sql);

    if (!$stmt->execute()) {
        die("Erro na execução da consulta: {$stmt->error}");
    }


    $result = $stmt->get_result();

    $quizzes = [];

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];

        // Inicializa o quiz se ainda não estiver no array
        if (!isset($quizzes[$id])) {
            $quizzes[$id] = [
                'id' => $row['id'],
                'nome' => $row['nome'],
                'dificuldade' => $row['dificuldade'],
                'pontos' => $row['pontos'],
                'perguntas' => []

            ];
        }

        // Adiciona perguntas e respostas
        if ($row['pergunta_id']) {
            if (!isset($quizzes[$id]['perguntas'][$row['pergunta_id']])) {
                $quizzes[$id]['perguntas'][$row['pergunta_id']] = [
                    'id' => $row['pergunta_id'],
                    'pergunta' => $row['pergunta'],
                    'imagem' => $row['imagem'],
                    'tipo' => $row['tipo'],
                    'respostas' => []
                ];
            }

            if ($row['resposta_id']) {
                $quizzes[$id]['perguntas'][$row['pergunta_id']]['respostas'][] = [
                    'id' => $row['resposta_id'],
                    'resposta' => $row['resposta'],
                    'correta' => $row['resposta_correta']
                ];
            }
        }
    }

    $stmt->close();
    $conn->close();

    return array_values($quizzes);
}




function excluirQuiz($id)
{
    $conn = connect();

    $sql_respostas = "DELETE FROM resposta WHERE pergunta_id IN (SELECT id FROM pergunta WHERE quiz_id = ?)";
    $stmt_respostas = mysqli_prepare($conn, $sql_respostas);
    mysqli_stmt_bind_param($stmt_respostas, "i", $id);
    $result_respostas = mysqli_stmt_execute($stmt_respostas);
    mysqli_stmt_close($stmt_respostas);

    $sql_perguntas = "DELETE FROM pergunta WHERE quiz_id = ?";
    $stmt_perguntas = mysqli_prepare($conn, $sql_perguntas);
    mysqli_stmt_bind_param($stmt_perguntas, "i", $id);
    $result_perguntas = mysqli_stmt_execute($stmt_perguntas);
    mysqli_stmt_close($stmt_perguntas);

    $sql_quiz = "DELETE FROM quiz WHERE atividade_id = ?";
    $stmt_quiz = mysqli_prepare($conn, $sql_quiz);
    mysqli_stmt_bind_param($stmt_quiz, "i", $id);
    $result_quiz = mysqli_stmt_execute($stmt_quiz);
    mysqli_stmt_close($stmt_quiz);

    $sql_atividade = "DELETE FROM atividade WHERE id = ?";

    mysqli_close($conn);

    return $result_respostas && $result_perguntas && $result_quiz;
}



function buscarVideos()
{
    $conn = connect();

    $sql = "SELECT  id,titulo, video FROM videos";

    $stmt = mysqli_prepare($conn, $sql);

    $videos = array();

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($videos, $row);
        }

        mysqli_free_result($result);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $videos;
}


function buscarAulaPorId($id)
{
    $conn = connect();

    $sql = "SELECT id, titulo, video,descricao FROM videos WHERE id= ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $aula = mysqli_fetch_assoc($result);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $aula;
}

function editarAula($id, $titulo, $video, $descricao)
{
    $conn = connect();
    
        $sql = "UPDATE videos SET titulo = ?, video = ?, descricao = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $titulo, $video, $descricao, $id);
        
        $ret = false;
        if (mysqli_stmt_execute($stmt)) {
            $ret = true;
        }
        mysqli_stmt_close($stmt);
   
    mysqli_close($conn);
    return $ret;
}


function excluirAula($id)
{
    $conn = connect();
    $sql = "DELETE FROM videos where id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    $ret = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
    return $ret;
}

function buscarTodaAula()
{
    $conn = connect();
    $sql = "SELECT id, titulo, video,descricao FROM videos";
    $stmt = mysqli_prepare($conn, $sql);

    $ret = false;
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $aulaS = array();
        mysqli_close($conn);
        while ($e = mysqli_fetch_assoc($result)) {
            array_push($aulaS, $e);
        }
        mysqli_stmt_close($stmt);
        return $aulaS;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $ret;
}

function editarDadosUser($id, $nome, $sobrenome, $email, $data_nasc){
    $conn = connect();
    // Supondo que $data_nasc já está no formato correto 'Y-m-d'
    $dateObj = DateTime::createFromFormat('Y-m-d', $data_nasc);

    // Verifique se $dateObj é um objeto DateTime válido
    if (!$dateObj) {
        error_log('Erro: Formato de data inválido');
        return ['success' => false, 'message' => 'Formato de data inválido'];
    }

    $data_nasc_formatada = $dateObj->format('Y-m-d');

    if (!$conn) {
        error_log('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
        return ['success' => false, 'message' => 'Erro na conexão com o banco de dados'];
    }

    // Modifica a query para um UPDATE
    $sql = "UPDATE usuario SET nome = ?, sobrenome = ?, email = ?, data_nasc = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        error_log('Erro na preparação da declaração SQL: ' . mysqli_error($conn));
        return ['success' => false, 'message' => 'Erro na preparação da declaração SQL'];
    }

    // Corrige o número de parâmetros para 7, incluindo o ID do usuário
    mysqli_stmt_bind_param($stmt, "ssssi", $nome, $sobrenome, $email, $data_nasc_formatada, $id);

    $ret = false;

    if (mysqli_stmt_execute($stmt)) {
        $ret = true;
        error_log('Usuário editado com sucesso');
    } else {
        error_log('Erro na execução da declaração SQL: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return ['success' => $ret, 'message' => $ret ? 'Usuário editado com sucesso' : 'Erro ao editar o usuário'];
}

function excluirDadosUser($id) {
    $conn = connect();

    $sql = "DELETE FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $ret = false;

    if (mysqli_stmt_execute($stmt)) {
        $ret = true;
        error_log('Usuário excluído com sucesso');
    } else {
        error_log('Erro na execução da declaração SQL: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return ['success' => $ret, 'message' => $ret ? 'Usuário excluído com sucesso' : 'Erro ao excluir o usuário'];
}

