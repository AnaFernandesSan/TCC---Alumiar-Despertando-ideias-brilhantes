<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>


    <section class="header">
        <nav id="navbarf">
            <a href="../paginas/index.php"><img src="../imagens/lamapda_5.png" alt="Ícone do site" width="150"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li class="lista"><a href="../paginas/index.php" class="bla"><ion-icon name="home-outline"></ion-icon>Início</a></li>
                    <li class="lista"><a href="../paginas/login_e_cad.php" class="bla"><ion-icon name="school-outline"></ion-icon> Login e cadastro</a></li>
                </ul>
            </div>
            <button id="speakButton" class="speakButton" aria-label="Ler Cabeçalho">
                <i class="fas fa-volume-up"></i>
            </button>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h1>Seja bem-vindo!</h1>
            <a href="login_e_cad.php" class="hero-btn" id="registerButton">Cadastre-se para usar a plataforma</a>
            <button id="speakRegisterButton" class="speakButton" aria-label="Ler botão de cadastro">
                <i class="fas fa-volume-up"></i>
            </button>
        </div>
    </section>


    <section class="cta">
        <h1>A Vida Me Ensinou A Nunca Desistir. <br> Nem Ganhar, Nem Perder Mas Procurar Evoluir.</h1>
        <p>- Chorão</p>
        <button id="speakBodyButton" class="speakButton" aria-label="Ler Corpo">
            <i class="fas fa-volume-up"></i> <!-- Ícone de som maior -->
        </button>
    </section>


    <?php include "../includes/footer.php"; ?>

    <script src="../assets/js/speak.js"></script>
    <script src="../assets/js/script_menu.js"></script>
    <script>
        // Função para falar o texto do botão de cadastro
        function speakRegister() {
            const registerButton = document.getElementById('registerButton');
            speakText(registerButton.textContent);
        }

        // Função para sintetizar o texto
        function speakText(text) {
            if (!('speechSynthesis' in window)) {
                alert('Síntese de fala não é suportada.');
                return;
            }

            const utterance = new SpeechSynthesisUtterance(text.trim());
            const voices = speechSynthesis.getVoices();
            utterance.voice = voices.find(voice => voice.lang.startsWith('pt')) || null;
            utterance.rate = 1; // Velocidade da fala
            utterance.pitch = 1; // Tom da fala

            speechSynthesis.speak(utterance);
        }

        // Adiciona ouvintes de evento aos botões
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('speakRegisterButton').addEventListener('click', speakRegister); // Ouvinte para o botão de cadastro
            document.getElementById('speakButton').addEventListener('click', speakHeader);
            document.getElementById('speakBodyButton').addEventListener('click', speakBody);
            document.getElementById('speakFooterButton').addEventListener('click', speakFooter);
        });
    </script>


    <script src="../assets/js/auth.js"></script>
</body>

</html>