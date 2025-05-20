
<div id="headerr"></div>
<br><br>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/profile.css">
<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/footer.css">

<body>
    <div class="container">
        <div class="sidebar">
            <div class="profile">
                <div class="foto">
                    <form id="profileFoto" enctype="multipart/form-data">
                        <input type="hidden" id="userId" name="userId">
                        <label for="fileInput" id="image-upload-button">
                            <input type="file" id="fileInput" name="fileInput" accept="image/*">
                            <div id="imageWrapper">
                                <img id="selectedImage" src="" alt="Pré-visualização da imagem">
                                <i class="fas fa-camera"></i> <!-- Ícone de câmera -->
                            </div>
                        </label>
                        <button type="submit" id="fotoBtn" class="btn-foto">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <!-- Conteúdo Principal -->
        <main class="main-content">
            <section class="informacoes">
                <h2>Seus dados:</h2>
                <button type="button" class="speakButton" aria-label="Ler Dados" onclick="readUserData()">
                    <i class="fas fa-volume-up"></i>
                </button>

                <form id="profileForm">
                    <input type="hidden" id="idUser" name="idUser">
                    <div class="row">
                        <div class="col">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome-info">
                        </div>
                        <div class="col">
                            <label for="sobrenome">Sobrenome:</label>
                            <input type="text" name="sobrenome" class="form-control" id="sobrenome-info">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="idade">Data de nascimento:</label>
                            <input type="date" name="idade" class="form-control" id="idade-info">
                        </div>
                        <div class="col">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" class="form-control" id="email-info">
                        </div>
                    </div>
                    <button type="submit" class="btn-salvarDados" id="alterarDados">Salvar Alterações</button>



                    <form id="formEditar">
                        <input type="hidden" id="idEditar" name="idEditar">
                        <br><br>
                        <h2 class="modal-title">Alterar Senha</h2>



                        <div class="row">
                            <div class="col">
                                <label for="senha" class="antigaContainer">Senha antiga:
                                    <input type="password" name="senha" class="form-control" id="senha">
                                    <button type="button" id="olhinhoVelha" aria-label="Mostrar senha" tabindex="-1">
                                        <i class="fas fa-eye"></i> <!-- Ícone de olho -->
                                    </button>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="senhanova" class="novaContainer">Senha nova:
                                    <input type="password" name="senhanova" class="form-control" id="senhanova">
                                    <button type="button" id="olhinhoNova" aria-label="Mostrar senha" tabindex="-1">
                                        <i class="fas fa-eye"></i> <!-- Ícone de olho -->
                                    </button>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn-salvar" id="alterarSenha">Salvar</button>


                        <div id="resultado"></div>
                    </form>

                    <div class="acoes">
                        <button type="submit" id="logoutBtn" class="desconectar logout-btn ">Desconectar</button>
                        <button type="submit" id="excluirBtn" class="excluir excluirBtn ">Excluir conta</button>
                    </div>
    </div>
    </div>
    </form>
    </section>
    </main>
    </div>
    <?php
    include "../includes/footer.php";
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/dados.js"></script>
    <script src="../assets/js/auth.js"></script>
</body>

</html>