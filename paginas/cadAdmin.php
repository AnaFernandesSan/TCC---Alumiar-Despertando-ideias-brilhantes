<?php

include '../includes/functions.php';

?>
<link rel="stylesheet" href="../css/cadAdmin.css">
<br><br><br><br><br><br>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<div id="headerr"></div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


<div class="container" id="container">
    <div class="form-container sign-up">
        <h1 class="text-center mb-4">Cadastro de administrador</h1>
        <form method="post" class="form-inline" id="formCadastro">
            
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

            <label for="senhaCadastro">
                <input type="password" name="senha" id="senhaCadastro" class="campo" required placeholder="Sua senha">
                <span class="lnr lnr-eye"></span>
            </label>

            <small id="errSenha" class="text-danger erro"></small>

            <label for="data_nasc">
                <input type="date" name="data_nasc" id="data_nasc" placeholder="00/00/0000" required>
            </label>
            <small id="errDataNasc" class="text-danger erro"></small>
            <input type="hidden" name="tipo" id="tipo" value="user">

            <button type="button" id="btnAdd" class="cad">Cadastre-se</button>
        </form>
    </div>
</div>
<br><br><br>


<?php
include "../includes/footerADM.php";
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../assets/js/auth.js"></script>
<script src="../assets/js/script_menu.js"></script>
<script src="../assets/js/login_e_cadADM.js"></script>
<script src="../assets/js/login_e_cad_auth.js"></script>
</body>

</html>