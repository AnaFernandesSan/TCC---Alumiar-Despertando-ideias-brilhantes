<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagens/alumirSF.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Alumiar</title>
</head>

<body>
    <section class="headerr"  style="background-color: #007BFF;">
        <nav class="navbarf">
            <a href="../paginas/index.php"><img src="../imagens/alumiar.png" alt="Icone do site" class="logo"></a>
            <ul class="navbarf-links">

                <li class="lista"><a href="../paginas/index.php" class="normal"><ion-icon name="home-outline"></ion-icon>Início</a></li>
                <li class="lista"><a href="../paginas/login_e_cad.php" class="normal"><ion-icon name="log-in-outline"></ion-icon>Cadastro ou Entrar</a></li>
                <button id="speakHeaderButton" class="speakButton" aria-label="Ler Cabeçalho" onclick="readMenu('Início Cadastro ou Entrar')">
                    <i class="fas fa-volume-up"></i>
                </button>
            </ul>
            <div class="navbarf-links-mobile" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li class="lista"><a href="../paginas/index.php" class="normal"><ion-icon name="home-outline"></ion-icon>Início</a></li>
                    <li class="lista"><a href="../paginas/login_e_cad.php" class="normal"><ion-icon name="log-in-outline"></ion-icon>Cadastro ou Entrar</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" id="menu-icon" onclick="showMenu()"></i>


        </nav>
    </section>

    <script src="../assets/js/speakFooterHeader.js"></script>