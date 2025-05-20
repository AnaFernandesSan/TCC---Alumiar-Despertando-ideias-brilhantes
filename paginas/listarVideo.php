    <?php
    
    include("../includes/functions.php");
    ?>
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/footer.css">
    <br><br><br><br><br><br>
<div id="headerr"></div>

    <div class="container mt-4">
        <br><br><br>
        <h2 class="mt-4">Lista de Aulas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Vídeo</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody id="aulas-list">
                <!-- Aqui serão listadas as aulas dinamicamente -->
            </tbody>
        </table>
    </div>

    <!-- Modal de Exclusão -->
    <div id="modal-excluir-aula" class="modals">
        <input type="hidden" id="idVideoExcluir">
        <div class="modals-content">
            <p>Quer excluir mesmo?</p>
            <button id="btnModalExcluirSim" type="submit" class="btn btn-success">Sim</button>
            <button id="btnModalExcluirNao" type="button" class="btn btn-danger">Não</button>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div id="modal-editar-aula" class="modals">
    <div class="modals-content">
        <form id="formEditar" enctype="multipart/form-data">
            <input type="hidden" id="idVideoEditar" name="idVideoEditar">

            <div>
                <label for="titulo_novo">Título da Aula</label>
                <input type="text" id="titulo_novo" name="titulo_novo" placeholder="Digite o título da aula" required>
            </div>

            <div>
                <label for="descricao_novo" class="file-label">Descrição da Aula</label>
                <textarea id="descricao_novo" name="descricao_novo" class="campo form-control" required></textarea>
            </div>

            <div>
                <label for="video-caminho">Caminho do Vídeo Atual</label>
                <input type="text" id="video-caminho" name="video-caminho" class="form-control" >
            </div>

            <button id="btnSalvarEditarVideo" type="submit" class="btn btn-success">Salvar</button>
            <button id="btnCancelarEditarVideo" type="button" class="btn btn-danger">Cancelar</button>
        </form>
    </div>
</div>


<?php
include "../includes/footerADM.php";
?>
    <script src="../assets/js/listar_video.js"></script>
    <script src="../assets/js/script_menu.js"></script>
    <script src="../assets/js/auth.js"></script>

    </body>

    </html>