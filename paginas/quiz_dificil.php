<div id="headerr"></div>
<br>
<link rel="stylesheet" href="../css/quiz_botao.css">

<div class="quiz-container">
    <div id="quiz">
        
        <!-- Quiz será carregado aqui -->
    </div>
    <div id="voltar">
        <!-- Botão para voltar -->
    </div>
</div> 
<button class="button"><a href="atividades.php">Voltar</a></button>
<br><br>
<?php
include "../includes/footer.php";
?>

<script src="../assets/js/script_quiz.js"></script>
<script src="../assets/js/script_menu.js"></script>
<script src="../assets/js/auth.js"></script>
<script src="../assets/js/speakUser.js"></script>
<script>
    loadQuestions('dificil');
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


