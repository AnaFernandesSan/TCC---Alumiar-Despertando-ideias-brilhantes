<?php
        include("../includes/functions.php"); 
    ?>
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/listarUser.css">

    <br><br><br><br><br><br>
    <div id="headerr"></div>
    
    <div class="container mt-4"> 
        <br><br><br>
            <h2 class="mt-4">Lista de Usuários</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>E-mail</th>
                        <th>Senha</th>
                        <th>D. Nascimento</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody id="usuarios-list">
                </tbody>
            </table>
        </div>


        <?php
include "../includes/footerADM.php";
?>
        <script src="../assets/js/listar_usuario.js"></script>
        <script src="../assets/js/script_menu.js"></script>
        <script src="../assets/js/auth.js"></script>

</body>
</html>