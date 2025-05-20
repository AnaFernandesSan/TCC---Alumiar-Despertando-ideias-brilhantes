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
            
            <div class="card-icon"><i class="fas fa-clipboard-list"></i></div> <!-- Alterado para clipboard-list -->
            <h2 class="card-title">Cadastro Atividade</h2>
            <p class="card-text">Realize o cadastro de atividades do tipo quiz e arrastar.</p>
            <a href="cadastroAtividade.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
           
            <div class="card-icon"><i class="fas fa-file-alt"></i></div> <!-- Alterado para file-alt -->
            <h2 class="card-title">Cadastro Palavras</h2>
            <p class="card-text">Cadastro das palavras para a atividade arrastar.</p>
            <a href="cadastroWords.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            
            <div class="card-icon"><i class="fas fa-question-circle"></i></div> <!-- Alterado para question-circle -->
            <h2 class="card-title">Cadastro Quiz</h2>
            <p class="card-text">Cadastro de um quiz.</p>
            <a href="cadastroQuiz.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            
            <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div> <!-- Alterado para chalkboard-teacher -->
            <h2 class="card-title">Cadastro Aulas</h2>
            <p class="card-text">Cadastro das aulas que serão exibidas.</p>
            <a href="cadastroAulas.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
           
            <div class="card-icon"><i class="fas fa-user-shield"></i></div> <!-- Alterado para user-shield -->
            <h2 class="card-title">Cadastro ADM</h2>
            <p class="card-text">Cadastre outro ADM.</p>
            <a href="cadAdmin.php" class="start-button">Começar</a>
        </div>
        
    </div>
</div>

<script src="../assets/js/speakAtividades.js"></script>
<?php
include("../includes/footer.php");
?>
<script src="../assets/js/auth.js"></script>
</body>
</php>
