<?php

include("../includes/functions.php");
?>
<link rel="stylesheet" href="../css/modal.css">
<link rel="stylesheet" href="../css/listar_quiz.css">
<link rel="stylesheet" href="../css/footer.css">
<br><br><br><br><br><br>
<div id="headerr"></div>
<div class="container mt-4">
    <br><br>
    <h2 class="mt-4">Lista de Quiz</h2>
    <table class="table">
        <thead>
        </thead>
        <tbody id="quiz-list">
            
        </tbody>
    </table>
</div>

<!-- Modal de Exclusão -->
<div id="modal-excluir-quiz" class="modals">
    <input type="hidden" id="idQuizExcluir">
    <div class="modals-content">
        <p>Quer excluir mesmo?</p>
        <button id="btnModalExcluirSim" type="submit" class="btn btn-success">Sim</button>
        <button id="btnModalExcluirNao" type="button" class="btn btn-danger">Não</button>
    </div>
</div>

<!-- Modal de Edição -->
<div id="modal-editar-quiz" class="modals">
    <div class="modal-content">
        <form id="formEditar">
            <input type="hidden" id="idQuizEditar">
            <div class="form-group">
                <label for="nome_novo">Nome do quiz</label>
                <input type="text" id="nome_novo" name="nome_novo" placeholder="Digite o título do quiz" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="pergunta_novo">Pergunta</label>
                <input type="text" id="pergunta_novo" name="pergunta_novo" placeholder="Digite a pergunta" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="opcao_novo">Tipo</label>
                <select id="opcao_novo" name="opcao_novo" class="form-control">
                    <option value="texto">Texto</option>
                    <option value="imagem">Imagem</option>
                </select>
            </div>
            
            <fieldset>
                <label for="novo_dificuldade">Nível:</label>
                <select id="novo_dificuldade" name="novo_dificuldade" required>
                    <option value="facil">Fácil</option>
                    <option value="medio">Médio</option>
                    <option value="dificil">Difícil</option>
                </select>
            </fieldset>
            <br>
            
            <div class="form-group foto">
                <label for="imagem-caminho">Caminho da imagem</label>
                <input type="text" id="imagem-caminho" name="imagem" class="form-control" readonly>
            </div>
            
            <div class="form-group">
                <label for="nova_foto_novo">Nova foto</label>
                <input type="file" id="nova_foto_novo" name="nova_foto" class="form-control">
            </div>
            
            <!-- Respostas -->
            <div class="form-group">
                <label for="resposta_novo_1">Resposta 1</label>
                <input type="text" id="resposta_novo_1" name="resposta_novo[]" value="1"class="form-control">
                <input type="radio" id="correta_novo_1" name="correta_novo[]" value="1"> Correta
                <input type="hidden" id="idResposta_1" name="idResposta_1">
            </div>
            
            <div class="form-group">
                <label for="resposta_novo_2">Resposta 2</label>
                <input type="text" id="resposta_novo_2" name="resposta_novo[]" value="2" class="form-control">
                <input type="radio" id="correta_novo_2" name="correta_novo[]" value="2"> Correta
                <input type="hidden" id="idResposta_2" name="idResposta_2">
            </div>
            
            <div class="form-group">
                <label for="resposta_novo_3">Resposta 3</label>
                <input type="text" id="resposta_novo_3" name="resposta_novo[]" value="3" class="form-control">
                <input type="radio" id="correta_novo_3" name="correta_novo[]" value="3"> Correta
                <input type="hidden" id="idResposta_3" name="idResposta_3">
            </div>
            
            <div class="form-group">
                <label for="resposta_novo_4">Resposta 4</label>
                <input type="text" id="resposta_novo_4" name="resposta_novo[]" value="4" class="form-control">
                <input type="radio" id="correta_novo_4" name="correta_novo[]" value="4"> Correta
                <input type="hidden" id="idResposta_4" name="idResposta_4">
            </div>
            
            <div class="form-actions">
                <button id="btnSalvarEditarQuiz" type="submit" class="btn btn-success">Salvar</button>
                <button id="btnCancelarEditarQuiz" type="button" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    </div>
</div>






<?php
include "../includes/footerADM.php";
?>
<script src="../assets/js/auth.js"></script>
<script src="../assets/js/listar_quiz.js"></script>
<script src="../assets/js/script_menu.js"></script>

</body>

</html>