<?php
include '../includes/functions.php';

?>
<div id="headerr"></div>
<br><br><br><br><br><br>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<section style="background-color: #f5f5f5; padding: 50px 0;">
        <div class="form-container container mt-5">
            <h1 class="text-center mb-4">Cadastro de Aulas</h1>
            <form method="post" id="aulaForm">
                <div id="row">
                    <div class="mb-3">
                        <label for="titulo" class="file-label">Título da Aula</label>
                        <input type="text" id="titulo" name="titulo" class="campo form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="file-label">Descrição da Aula</label>
                        <textarea id="descricao" name="descricao" class="campo form-control" required></textarea>
                    </div>

                    <div class="col mb">
                        <label for="video" class="file-label">Escolha um vídeo</label>
                        <input type="text" id="video" name="video"  class="form-control" required>
                    </div>
                    

                    <div id="col mb">
                        <br>
                        <button id="adicionarAula" type="submit" class="btn btn-primary w-100">Adicionar Aula</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php
include "../includes/footerADM.php";
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/cad_aulas.js"></script>
    <script src="../assets/js/auth.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
