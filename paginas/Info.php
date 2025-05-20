<?php
include "../includes/functions.php";
?>
<div id="headerr"></div>
<br><br><br><br><br><br>
<link rel="stylesheet" href="../css/header3.css">
<link rel="stylesheet" href="../css/faq.css">

<div class="container">
    <h1>Bem-vindo(a) ao Portal de Informações</h1>
    <p>Caso alguma funcionalidade tenha causado dúvidas, confira abaixo:</p>

    <div class="info-section">
        <button class="speakButton" aria-label="Botão de som" onclick="speakText('Botão de som: Este botão lê o texto em voz alta para facilitar a navegação.')">
            <i class="fas fa-volume-up"></i>
        </button>
        <h2>Botão de Som</h2>
        <p>
            O botão de som serve para ajudá-lo a ouvir melhor o conteúdo da página. Quando você clicar nele, uma voz irá ler em voz alta o texto ou as instruções que aparecem na tela. É ótimo para facilitar a navegação e garantir que você não perca nenhuma informação importante!
        </p>
        <div class="image-container">
            <img src="../uploads/botao_audio.png" alt="Botão de áudio">
            <img src="../uploads/botao_audio2.png" alt="Botão de áudio">
        </div>
    </div>

    <div class="info-section">
        <button class="speakButton" aria-label="Como se cadastrar" onclick="speakText('Como se cadastrar no site:  Clique no botão Cadastre-se na tela principal. Preencha os campos com seus dados: Nome, Sobrenome, Email, Senha e Data de Nascimento. Após preencher tudo, clique no botão Cadastre-se para criar sua conta.')">
            <i class="fas fa-volume-up"></i>
        </button>
        <h2>Como se Cadastrar</h2>
        <p>
            Clique no botão "Cadastre-se" na tela principal. Preencha os campos com seus dados: Nome, Sobrenome, Email, Senha e Data de Nascimento. Após preencher tudo, clique no botão "Cadastre-se" para criar sua conta.
        </p>
        <div class="image-container">
            <img src="../uploads/cadastro1.png" alt="Cadastro">
            <img src="../uploads/cadastro2.png" alt="Cadastro">
        </div>
    </div>

    <div class="info-section">
        <button class="speakButton" aria-label="Como entrar" onclick="speakText('Como entrar no site:  Clique no botão Entre para ir à área de login. Digite o e-mail e a senha que você usou no cadastro. Clique no botão Entre para acessar sua conta..')">
            <i class="fas fa-volume-up"></i>
        </button>
        <h2>Como Entrar</h2>
        <p>
            Clique no botão "Entre" para ir à área de login. Digite o e-mail e a senha que você usou no cadastro. Clique no botão "Entre" para acessar sua conta.
        </p>
        <div class="image-container">
            <img src="../uploads/login1.png" alt="Login">
            <img src="../uploads/login2.png" alt="Login">
        </div>
    </div>

    <div class="info-section">
            <button class="speakButton" aria-label="Como entrar" onclick="speakText('Como Jogar: Atividade de Arrastar.Cada item deve ser arrastado para o lugar correto, que pode ser uma categoria ou um ponto de destino específico. Para arrastar: Clique e segure no item que deseja mover. Em seguida, arraste até a área correta e solte-o.Se você errar, pode tentar novamente. Não se preocupe, o importante é aprender enquanto joga!Quando todos os itens forem colocados no lugar correto, você receberá uma mensagem de sucesso.')">
                <i class="fas fa-volume-up"></i>
            </button>
            <h2>Como Jogar: Atividade de Arrastar</h2>
            <p>
                Cada item deve ser arrastado para o lugar correto, que pode ser uma categoria ou um ponto de destino específico.
                Para arrastar: Clique e segure no item que deseja mover. Em seguida, arraste até a área correta e solte-o.
            </p>
            <div class="image-container">
                <img src="../uploads/arrastar1.png" alt="arrastar">
                <img src="../uploads/arrastar2.png" alt="arrastar">
            </div>
            <p>Se você errar, pode tentar novamente. Não se preocupe, o importante é aprender enquanto joga!
            </p>
            <div class="image-container">
                <img src="../uploads/erro.png" alt="mensagem de erro">

            </div>
            <p>Quando todos os itens forem colocados no lugar correto, você receberá uma mensagem de sucesso.</p>
            <div class="image-container">
                <img src="../uploads/sucesso.png" alt="mensagem de acerto">

            </div>
        </div>
</div>

<?php
include "../includes/footerADM.php";
?>
<script src="../assets/js/speakAtividades.js"></script>
<script src="../assets/js/auth.js"></script>
</body>
</php>