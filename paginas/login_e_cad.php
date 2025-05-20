<?php

include '../includes/functions.php';
?>

<link rel="stylesheet" href="../css/login_e_cad.css">
<div id="headerr"></div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<br><br><br><br>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" class="form-inline" id="formCadastro">
                <h1>Crie uma conta</h1>
                <label for="nome">
                    <input type="text" name="nome" id="nome" required placeholder="Nome">
                </label>
                <small id="errNome" class="text-danger erro"></small>

                <label for="sobrenome">
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" required>
                </label>
                <small id="errSobrenome" class="text-danger erro"></small>

                <label for="emailCadastro">
                    <input type="email" name="email" id="emailCadastro" class="campo" required placeholder="email@gmail.com">
                </label>
                <small id="errEmail" class="text-danger erro"></small>

                <label for="senhaCadastro" class="senhaContainer">
                    <input type="password" name="senha" id="senhaCadastro" class="campo" required placeholder="Sua senha">
                    <button id="olhinhoCadastro" type="button" aria-label="Mostrar senha" tabindex="-1">
                        <i class="fas fa-eye"></i>
                    </button>
                </label>


                <small id="errSenha" class="text-danger erro"></small>

                <label for="data_nasc">
                    <input type="date" name="data_nasc" id="data_nasc" placeholder="00/00/0000" required>
                </label>
                <small id="errDataNasc" class="text-danger erro"></small>
                <input type="hidden" name="tipo" id="tipo" value="user">

                <button type="button" id="speakFormButton" class="speakButton" aria-label="Ler Formulário" onclick="readForm()">
                    <i class="fas fa-volume-up"></i>
                </button>
                <button type="button" id="btnAdd" class="cad">Cadastre-se</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form class="form-inline" id="formLogin" method="POST">
                <h1>Entrar</h1>
                <label for="emailLogin">
                    <input type="email" name="emailLogin" id="emailLogin" class="campo" required placeholder="email@gmail.com">
                </label>
                <label for="senhaLogin" class="LoginContainer">
                    <input type="password" name="senhaLogin" id="senhaLogin" class="campo" required placeholder="Sua senha">
                    <button id="olhinhoLogin" type="button" aria-label="Mostrar senha" tabindex="-1">
                        <i class="fas fa-eye"></i>
                    </button>
                </label>
                <button type="button" id="speakFormButton" class="speakButton" aria-label="Ler Formulário" onclick="readFormLogin()">
                    <i class="fas fa-volume-up"></i>
                </button>
                <button type="button" id="btnLogin" class="log">Entre</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1 class="marcatexto">Olá!</h1>
                    <p class="marcatexto">Insira seus dados pessoais para usar todos os recursos do site</p>
                    <button type="button" id="speakFormButton" class="speakButton" aria-label="Ler Formulário" onclick="readForm1()">
                        <i class="fas fa-volume-up"></i>
                    </button>
                    <button class="hidden" id="login">Entre</button>


                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Bem vindo!</h1>
                    <p class="marcatexto">Registre seus dados pessoais para usar todos os recursos do site</p>
                    <button type="button" id="speakFormButton" class="speakButton" aria-label="Ler Formulário" onclick="readForm2()">
                        <i class="fas fa-volume-up"></i>
                    </button>

                    <button class="hidden" id="cadastro">Cadastre-se</button>

                </div>
            </div>
        </div>
    </div>

    <?php
    include '../includes/footer.php';
    ?>
    <script src="../assets/js/speakLoginCad.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/auth.js"></script>
    <script src="../assets/js/login_e_cad.js"></script>
    <script src="../assets/js/login_e_cad_auth.js"></script>

</body>

</html>