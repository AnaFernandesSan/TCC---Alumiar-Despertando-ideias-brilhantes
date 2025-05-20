<?php
include '../includes/functions.php';

?>
<br><br><br><br><br><br>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="headerr"></div>
<section style="background-color: #f5f5f5; padding: 50px 0;">
        <div class="form-container container mt-5">
            <h1 class="text-center mb-4">Cadastro de Palavras</h1>
            <form method="post" enctype="multipart/form-data" id="wordForm">
                <div id="row">
                    <div class="mb-3">
                        <label for="word" class="file-label">Digite a palavra</label>
                        <input type="text" id="word" name="word" class="campo form-control" required>
                    </div>
                   
                    <div class="col mb">
                        <label for="foto" class="file-label">Escolha uma imagem</label>
                        <input type="file" id="foto" name="foto" accept="image/*" class="form-control" required>
                    </div>

                    
                    <div id="col mb">
                        <br>
                        <button id="adicionarAula" type="submit" class="btn btn-primary w-100">Adicionar Palavra</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php
include "../includes/footerADM.php";
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="../assets/js/cad_words.js"></script>
     <script src="../assets/js/auth.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>
</html>
