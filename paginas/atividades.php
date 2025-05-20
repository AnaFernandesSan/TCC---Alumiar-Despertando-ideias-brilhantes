<?php

include "../includes/functions.php";
?>
<link rel="stylesheet" href="../css/dificuldadeAtividades.css">

<div id="headerr"></div>
<br><br>
<div class="container">
    <h1>Atividades</h1>
    <h4>Escolha uma das opções abaixo para testar seu conhecimento:</h4>
    
    <div class="card-container">
        <div class="card">
            <button class="speakButton" aria-label="Ler Quiz Fácil" onclick="speakText('Teste seus conhecimentos com perguntas fáceis.')" style="position: absolute; top: 10px; right: 10px;">
                 <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-star"></i></div>
            <h2 class="card-title">Quiz - Fácil</h2>
            <p class="card-text">Teste seus conhecimentos com perguntas fáceis.</p>
            <a href="quiz_facil.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            <button class="speakButton" aria-label="Ler Quiz Médio" onclick="speakText('Desafie-se com perguntas de dificuldade média.')" style="position: absolute; top: 10px; right: 10px;">
            <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-star-half-alt"></i></div>
            <h2 class="card-title">Quiz - Médio</h2>
            <p class="card-text">Desafie-se com perguntas de dificuldade média.</p>
            <a href="quiz_medio.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            <button class="speakButton" aria-label="Ler Quiz Difícil" onclick="speakText('Mostre seu conhecimento com perguntas difíceis.')" style="position: absolute; top: 10px; right: 10px;">
            <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-star fa-flip-horizontal"></i></div>
            <h2 class="card-title">Quiz - Difícil</h2>
            <p class="card-text">Mostre seu conhecimento com perguntas difíceis.</p>
            <a href="quiz_dificil.php" class="start-button">Começar</a>
        </div>
        
        <div class="card">
            <button class="speakButton" aria-label="Ler Arrastar Fácil" onclick="speakText('Divirta-se arrastando as respostas fáceis.')" style="position: absolute; top: 10px; right: 10px;">
            <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-hand-rock"></i></div>
            <h2 class="card-title">Arrastar</h2>
            <p class="card-text">Divirta-se formando palavras.</p>
            <a href="arrastar.php" class="start-button">Começar</a>
        </div>
        
    </div>
</div>

<?php
include "../includes/footer.php";
?>
<script src="../assets/js/speakAtividades.js"></script>

<script src="../assets/js/auth.js"></script>
</body>
</php>
