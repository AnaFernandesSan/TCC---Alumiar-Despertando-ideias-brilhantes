
<div id="headerr"></div>
<link rel="stylesheet" href="../css/sobre_nos.css">

<body>
    <br><br><br><br><br>
    <div class="container">
        <h1>Sobre Nós</h1>
        <div class="section missao">
            <div>
                <h2>Nossa Missão</h2>
                <p>
                    Nosso objetivo é capacitar idosos a se conectarem com o mundo digital, oferecendo ferramentas e
                    recursos que tornam o aprendizado acessível e divertido. Valorizamos a experiência de vida e o
                    conhecimento que cada indivíduo traz, criando um ambiente de aprendizado acolhedor e inclusivo.
                </p>
                <button class="speakButton" aria-label="Ler Perfil" onclick="speakText('Nossa missão: Nosso objetivo é capacitar idosos a se conectarem com o mundo digital, oferecendo ferramentas e recursos que tornam o aprendizado acessível e divertido. Valorizamos a experiência de vida e oconhecimento que cada indivíduo traz, criando um ambiente de aprendizado acolhedor e inclusivo.')" style="position: absolute; top: 10px; right: 10px;">
                <i class="fas fa-volume-up"></i>
            </button>
            </div>
        </div>

        <div class="section historia">
            
            <div>
                <h2>Nossa História</h2>
                <p>
                    Fundado por alunas do IFSP campus Araraquara, nosso site foi criado com a visão de quebrar as
                    barreiras digitais para a terceira idade. Desde o início, nosso foco tem sido em desenvolver
                    conteúdos que sejam claros, objetivos e, acima de tudo, adaptados às necessidades dos idosos.
                </p>
                <button class="speakButton" aria-label="Ler Perfil" onclick="speakText('Nossa história: Fundado por alunas do IFSP campus araraquara, nosso site foi criado com a visão de quebrar as barreiras digitais para a terceira idade. Desde o início, nosso foco tem sido em desenvolver  conteúdos que sejam claros, objetivos e, acima de tudo, adaptados às necessidades dos idosos.')"
                    style="position: absolute; top: 10px; right: 10px;">
                    <i class="fas fa-volume-up"></i>
            </button>
            </div>
        </div>

        <div class="section equipe">

            <div>
                <h2>Nossa Equipe</h2>
                <p>
                    Alunas Ana Luiza Fernandes dos Santos, Lara Saquete Carvalho, Ludmyla Oliveira.
                </p>
                <button class="speakButton" aria-label="Ler Perfil" onclick="speakText('Nossa equipe: Alunas Ana Luiza Fernandes dos Santos, Lara Saquete Carvalho, Ludmyla Oliveira..')" style="position: absolute; top: 10px; right: 10px;">
                <i class="fas fa-volume-up"></i>
            </button>
            </div>
        </div>
    </div>

    <br><br><br><br>
    <?php
    include '../includes/footer.php';
    ?>
    <script src="../assets/js/speak.js"></script>
    <script src="../assets/js/speakSobreN.js"></script>
    <script src="../assets/js/auth.js"></script>
</body>

</html>
