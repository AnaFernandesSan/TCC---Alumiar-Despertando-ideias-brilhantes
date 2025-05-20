<?php
include '../includes/functions.php';

?>
<br><br><br><br><br><br>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="headerr"></div>

<link rel="stylesheet" href="../css/cadastroAula.css">

<section>
    <div class="form-container container mt-5">
        <h1 class="text-center mb-4">Cadastro de Atividade</h1>
        <form method="POST" id="AtividadeForm">
            <input type="hidden" name="idAtividade">

            <div id="col">
                <fieldset>
                    Nivel:
                    <select id="dificuldade" name="dificuldade" required>
                        <option value="facil">Fácil</option>
                        <option value="medio">Médio</option>
                        <option value="dificil">Difícil</option>
                    </select>
                </fieldset>
                <br>
                <fieldset>
                    Tipo:
                    <select id="tipo" name="tipo" required>
                        <option value="quiz">Quiz</option>
                        <option value="arrastar">Arrastar</option>
                    </select>
                </fieldset>
                <br>
                <br>
                <div class="mb-3">
                    <button id="btnEnviar" type="submit" class="btn btn-primary w-100">Adicionar Atividade</button>
                </div>
            </div>
        </form>
    </div>
</section>


<?php
include "../includes/footerADM.php";
?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/auth.js"></script>
<script src="../assets/js/script_menu.js"></script>
<script src="../assets/js/add_atividade.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>