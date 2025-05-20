<?php

include "../includes/functions.php";
?>
<link rel="stylesheet" href="../css/dificuldadeAtividades.css">

<br><br><br><br><br><br>
<div id="headerr"></div>
<div class="container">
    <h1>Ações</h1>
    
    <div class="card-container">
        <div class="card">
            <div class="card-icon"><i class="fas fa-video"></i></div> <!-- Alterado para video -->
            <h2 class="card-title">Listar Vídeos</h2>
            <p class="card-text">Liste, edite ou exclua todos os vídeos cadastrados.</p>
            <a href="listarVideo.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            <div class="card-icon"><i class="fas fa-question-circle"></i></div> <!-- Alterado para question-circle -->
            <h2 class="card-title">Listar Quiz</h2>
            <p class="card-text">Liste, edite ou exclua todos os quizzes cadastrados.</p>
            <a href="listarQuiz.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            <div class="card-icon"><i class="fas fa-list-ul"></i></div> <!-- Alterado para list-ul -->
            <h2 class="card-title">Listar Palavras</h2>
            <p class="card-text">Liste, edite ou exclua todos as palavras cadastradas.</p>
            <a href="listarArrastar.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            <div class="card-icon"><i class="fas fa-users"></i></div> <!-- Alterado para users -->
            <h2 class="card-title">Listar Usuários</h2>
            <p class="card-text">Liste todos os usuários cadastrados.</p>
            <a href="listarUsuario.php" class="start-button">Começar</a>
        </div>
        
    </div>
</div>

<script src="../assets/js/speakAtividades.js"></script>
<?php
include "../includes/footerADM.php";
?>
<script src="../assets/js/auth.js"></script>
</body>
</php>
