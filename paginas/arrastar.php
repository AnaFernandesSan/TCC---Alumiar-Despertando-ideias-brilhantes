<?php
include '../includes/functions.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/style1.css" />
<link rel="stylesheet" href="../css/style.css" />

<div id="headerr"></div>

<body><br>
    
    <br>
    <div class="container">
        <div class="header">
            <div class="progress-bar-container">
                <div class="progress-bar" id="progress"></div>
            </div>
        </div>

        <div>
            <div class="board">
                <h1 class="board-header">Preencha as lacunas</h1>
                <div class="target-lang-container" style="display: flex; flex-direction: column; align-items: center;">

                <div id="imageContainer" style="margin-right: 10px; height: 150px; width: 180px;">
                        <div id="imageContainer" style="margin-right: 10px;">
                            <img id="currentImage"  alt="Imagem">
                            
                        </div>
                    </div>
                </div>

                <!-- Campo onde as letras serão jogadas -->
                <div class="answer-field" id="answerField"></div>

                <div class="alphabet-buttons-container">
                    <div class="alphabet-buttons" id="alphabetButtons"></div>
                </div>
            </div>

            <div class="footer">
                <div class="footer-items-container">

                    <div class="item"></div>
                    <div class="item center">

                    </div>
                    <div class="item"></div>
                </div>
            </div>

            <div class="motivation-container">
                <div id="motivation-message" class="motivation-message"></div>
            </div>

            <!-- Modal de mensagem final -->
            <div id="endModal" class="modal">
                <div class="modal-content">
                    <span id="closeModal" class="close">&times;</span>
                    <h2>Parabéns!</h2>
                    <p id="endMessageContent"></p>
                    <p id="finalScoreContent"></p>
                    
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/auth.js"></script>
    <script src="../assets/js/arrastar.js"></script>

    <script>
        loadWordsFromServer('facil');
    </script>

    <?php 
        include "../includes/footer.php"
    ?>
