<?php

include "../includes/functions.php";
?>

<div id="headerr"></div>
<br><br><br><br><br><br>
<link rel="stylesheet" href="../css/header3.css">
<link rel="stylesheet" href="../css/dificuldadeAtividades.css">
<div class="container">
    <h1>Bem-vindo(a) ao Portal de Acesso</h1>
    <p>Escolha uma das opções abaixo para acessar os conteúdos disponíveis:</p>
    
    <div class="card-container">
        <div class="card">
            <div class="card-icon"><i class="fas fa-book-open"></i></div>
            <h2 class="card-title">Cadastros</h2>
            <p class="card-text">Cadastre palavras, quizzes e videos</p>
            <a href="allCads.php" class="start-button">Acessar</a>
        </div>
        
        <div class="card">
            <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <h2 class="card-title">Listagem</h2>
            <p class="card-text">Liste videos, palavras e quizzes</p>
            <a href="allList.php" class="start-button">Acessar</a>
        </div>

        <div class="card">
            <div class="card-icon"><i class="fas fa-user"></i></div>
            <h2 class="card-title">Perfil</h2>
            <p class="card-text">Gerencie suas informações e preferências.</p>
            <a href="perfil.php" class="start-button">Acessar</a>
        </div>
        
        
    </div>
</div>
<?php
include "../includes/footerADM.php" ;
?>
<script src="../assets/js/speakAtividades.js"></script>
<script src="../assets/js/auth.js"></script>

</body>
</php>
