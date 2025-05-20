<?php
include "../includes/functions.php";
?>

<div id="headerr"></div>
<br><br>
<link rel="stylesheet" href="../css/dificuldadeAtividades.css">
<div class="container">
    <h1>Bem-vindo(a) ao Portal de Acesso</h1>
    <h2>Escolha uma das opções abaixo para acessar os conteúdos disponíveis:</h2>
    
    <div class="card-container">
        <div class="card">
            <button class="speakButton" aria-label="Ler Atividades" onclick="speakText('Explore as atividades e pratique seus conhecimentos.')" style="position: absolute; top: 10px; right: 10px;">
                <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-book-open"></i></div>
            <h2 class="card-title">Atividades</h2>
            <h4 class="card-text">Explore as atividades e pratique seus conhecimentos.</h4>
            <a href="atividades.php" class="start-button">Acessar</a>
        </div>
        
        <div class="card">
            <button class="speakButton" aria-label="Ler Aulas" onclick="speakText('Acesse aulas e conteúdos exclusivos para aprender mais.')" style="position: absolute; top: 10px; right: 10px;">
                <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <h2 class="card-title">Aulas</h2>
            <h4 class="card-text">Acesse aulas e conteúdos exclusivos para aprender mais.</h4>
            <a href="aulas.php" class="start-button">Acessar</a>
        </div>
        
        <div class="card">
            <button class="speakButton" aria-label="Ler Perfil" onclick="speakText('Gerencie suas informações e preferências.')" style="position: absolute; top: 10px; right: 10px;">
                <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-user"></i></div>
            <h2 class="card-title">Perfil</h2>
            <h4 class="card-text">Gerencie suas informações e preferências.</h4>
            <a href="perfil.php" class="start-button">Acessar</a>
        </div>

        <div class="card">
            <button class="speakButton" aria-label="Ler Sobre Nós" onclick="speakText('Saiba mais sobre nossa equipe e missão.')" style="position: absolute; top: 10px; right: 10px;">
                <i class="fas fa-volume-up"></i>
            </button>
            <div class="card-icon"><i class="fas fa-info-circle"></i></div>
            <h2 class="card-title">Sobre Nós</h2>
            <h4 class="card-text">Saiba mais sobre nossa equipe e missão.</h4>
            <a href="sobre_nos.php" class="start-button">Acessar</a>
        </div>
    </div>
</div>

<script src="../assets/js/speakAtividades.js"></script>
<script src="../assets/js/auth.js"></script>
<?php
include("../includes/footer.php");
?>
</body>
</php>
