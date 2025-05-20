<?php

include("../includes/functions.php");
?>
<link rel="stylesheet" href="../css/modal.css">
<link rel="stylesheet" href="../css/footer.css">
<br><br><br><br><br><br>
<div id="headerr"></div>
<div class="container mt-4">
    <br><br><br>
    <h2 class="mt-4">Lista de words</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagem</th>
                <th>Excluir</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody id="word-list">

        </tbody>
    </table>
</div>


<div id="modal-excluir-word" class="modals">
    <input type="hidden" id="idWordExcluir">
    <div class="modals-content">
        <p>Quer excluir mesmo?</p>
        <button id="btnModalExcluirSim" type="submit" class="btn btn-success">Sim</button>
        <button id="btnModalExcluirNao" type="button" class="btn btn-danger">Não</button>
    </div>
</div>

<!-- Modal de Edição -->
<div id="modal-editar-word" class="modals">
    <div class="modals-content">
        <form id="formEditar" enctype="multipart/form-data">
            <input type="hidden" id="idWordEditar" name="idWordEditar">

            <div>
                <label for="word_novo">Nova palavra:</label>
                <input type="text" id="word_novo" name="word_novo" placeholder="Digite a palavra" required>
            </div>

            <div>
                <label for="foto-caminho">Caminho da imagem atual:</label>
                <input type="text" id="foto-caminho" name="foto-caminho" class="form-control" readonly>
            </div>

            <div>
                <label for="foto_novo">Selecione a nova foto:</label>
                <input type="file" id="foto_novo" name="foto_novo" accept="image/*">
            </div>

            <button id="btnSalvarEditarWord" type="submit" class="btn btn-success">Salvar</button>
            <button id="btnCancelarEditarWord" type="button" class="btn btn-danger">Cancelar</button>
        </form>
    </div>
</div>


<?php
include "../includes/footerADM.php";
?>
<script src="../assets/js/listar_word.js"></script>
<script src="../assets/js/script_menu.js"></script>
<script src="../assets/js/auth.js"></script>

</body>

</html>