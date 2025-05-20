<?php

include '../includes/functions.php';

?>
<link rel="stylesheet" href="../css/cadastroAula.css">
<br><br><br><br><br><br>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="headerr"></div>
<style>
    .hidden {
        display: none;
    }
</style>

<section>
    <div class="form-container container mt-5">
        <h1 class="text-center mb-4">Cadastro de Quiz</h1>
        <form method="post" id="quizForm">
            <input type="hidden" name="idQuiz">

            <div id="col">
                <div class="mb-3">
                    <label for="titulo" class="file-label">Título:</label>
                    <input type="text" id="nome" name="titulo" class="campo form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pergunta" class="file-label">Pergunta:</label>
                    <input type="text" id="pergunta" name="pergunta" class="campo form-control" required>
                </div>
                <div class="mb-3">
                    <table class="table">
                        <tr>
                            <td><label for="option_a" class="file-label">Opção 1:</label></td>
                            <td><input type="text" id="option_a" name="respostas[]" class="campo form-control"></td>
                            <td><input type="radio" name="resposta_correta" value="1" class="form-check-input"></td>
                            <td><label class="form-check-label">Correta</label></td>
                        </tr>
                        <tr>
                            <td><label for="option_b" class="file-label">Opção 2:</label></td>
                            <td><input type="text" id="option_b" name="respostas[]" class="campo form-control" required></td>
                            <td><input type="radio" name="resposta_correta" value="2" class="form-check-input"></td>
                            <td><label class="form-check-label">Correta</label></td>
                        </tr>
                        <tr>
                            <td><label for="option_c" class="file-label">Opção 3:</label></td>
                            <td><input type="text" id="option_c" name="respostas[]" class="campo form-control" required></td>
                            <td><input type="radio" name="resposta_correta" value="3" class="form-check-input"></td>
                            <td><label class="form-check-label">Correta</label></td>
                        </tr>
                        <tr>
                            <td><label for="option_d" class="file-label">Opção 4:</label></td>
                            <td><input type="text" id="option_d" name="respostas[]" class="campo form-control" required></td>
                            <td><input type="radio" name="resposta_correta" value="4" class="form-check-input"></td>
                            <td><label class="form-check-label">Correta</label></td>
                        </tr>
                    </table>
                </div>
                <br>
                <fieldset>
                    Tipo:
                    <select id="opcao" name="opcao" required>
                        <option value="normal">Sem imagem</option>
                        <option value="imagem">Com imagem</option>
                    </select>
                </fieldset>
                <br>
                <div class="mb-3 foto hidden">
                    <label for="foto"></label>
                    <input type="file" name="foto" id="foto" placeholder="Escolha uma imagem">
                </div>
                <br>
                <div class="mb-3">
                    <button id="btnEnviar" type="submit" class="btn btn-primary w-100">Adicionar quiz</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include "../includes/footerADM.php";
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/script_menu.js"></script>
<script src="../assets/js/auth.js"></script>
<script src="../assets/js/add_quiz.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>