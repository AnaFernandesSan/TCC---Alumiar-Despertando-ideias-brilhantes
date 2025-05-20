const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

const token = localStorage.getItem("token");
const tipo = localStorage.getItem("tipo");
const userId = sessionStorage.getItem('id') || localStorage.getItem('id');

document.addEventListener('DOMContentLoaded', function carregar() {
    const userId = sessionStorage.getItem('id') || localStorage.getItem('id');

    if (userId) {
        carregarDados(userId);
        carregarFoto(userId);
    } else {
        console.error('ID do usuário não encontrado no sessionStorage.');
    }
});

document.addEventListener("DOMContentLoaded", function (e) {
    e.preventDefault();
    const inputSenhaV = document.querySelector("#senha");
    const buttonSenhaV = document.querySelector("#olhinhoVelha");

    buttonSenhaV.addEventListener('click', (e) => {
        e.preventDefault();
        if (inputSenhaV.type === "password") {
            inputSenhaV.type = "text";
            buttonSenhaV.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            inputSenhaV.type = "password";
            buttonSenhaV.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    const inputSenhaN = document.querySelector("#senhanova");
    const buttonSenhaN = document.querySelector("#olhinhoNova");
    buttonSenhaN.addEventListener('click', (event) => {
        event.preventDefault();
        if (inputSenhaN.type === "password") {
            inputSenhaN.type = "text";
            buttonSenhaN.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            inputSenhaN.type = "password";
            buttonSenhaN.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
});


function carregarDados(id) {

    fetch(baseUrl + "getUser.php?id=" + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na resposta da rede: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data) {
                console.log('Dados recebidos:', data); // Debug
                const nome = document.getElementById("nome-info");
                const sobrenome = document.getElementById("sobrenome-info");
                const idade = document.getElementById("idade-info");
                const email = document.getElementById("email-info");
                const senha = document.getElementById("senha-info");
                const idnovo = document.getElementById("idUser");
                if (nome || sobrenome || idade || email || senha || idnovo) {
                    nome.value = data.nome || '';
                    sobrenome.value = data.sobrenome || '';
                    idade.value = data.data_nasc || '';
                    email.value = data.email || '';

                    idnovo.value = data.id;
                } else {
                    console.error('Um ou mais elementos do formulário não foram encontrados.');
                }
            } else {
                console.error('Nenhum dado foi retornado.');
            }
        })
        .catch(error => {
            console.error('Erro ao carregar dados do usuário:', error);
        });
}

function editaDados(event) {
    event.preventDefault();  // Impede o envio padrão do formulário

    const editBtn = document.getElementById('alterarDados');

    if (editBtn) {
        const form = document.querySelector("#profileForm");
        const data = new FormData(form);

        const idEditar = document.getElementById("idUser").value;
        const idadeField = document.getElementById("idade-info").value;
        data.append("idUser", idEditar);
        data.append("data_nasc", idadeField);  // Certifique-se que "data_nasc" seja o nome correto esperado pelo servidor

        fetch(baseUrl + "editDadosUser.php", {
            method: 'POST',
            body: data
        }).then(response => response.text())
            .then(text => {
                console.log("Resposta recebida:", text);
                try {
                    const dataResponse = JSON.parse(text);
                    if (dataResponse.success) {
                        Swal.fire({
                            title: 'Dados alterados!',
                            text: 'Seus dados foram alterados com sucesso.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                    } else {
                        alert(dataResponse.message);
                    }
                } catch (error) {
                    console.error('Erro ao analisar JSON:', error);
                    //Swal.fire({
                    // title: 'Erro!',
                    // text: 'Não foi possível alterar seus dados. Tente novamente.',
                    // icon: 'error',
                    //  confirmButtonText: 'Tente novamente'
                    //});
                }
            })
            .catch(error => {
                console.log(error);
            });
    }

}

function carregarFoto(id) {


    fetch(baseUrl + "getImage.php?id=" + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na resposta da rede: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data && data.foto) {
                console.log('Dados recebidos:', data); // Debug

                const foto = document.getElementById("selectedImage");

                // Verificar se o elemento da imagem foi encontrado
                if (foto) {
                    // Atualizar o src da imagem com a URL retornada
                    foto.src = data.foto;
                } else {
                    console.error('Elemento da imagem não encontrado.');
                }
            } else {
                console.error('Nenhuma foto foi retornada.');
            }
        })
        .catch(error => {
            console.error('Erro ao carregar foto do usuário:', error);
        });
}


document.addEventListener('DOMContentLoaded', () => {
    const logoutBtn = document.getElementById('logoutBtn');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            Swal.fire({
                title: 'Tem certeza que deseja sair?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, sair',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar o logout
                    sessionStorage.clear();
                    localStorage.clear();

                    Swal.fire(
                        'Desconectado!',
                        'Você foi desconectado com sucesso.',
                        'success'
                    ).then(() => {
                        // Redirecionar após o aviso de sucesso
                        window.location.href = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/paginas/index.php";
                    });
                }
            });
        });
    } else {
        console.error('Botão logoutBtn não encontrado.');
    }
});






document.addEventListener('DOMContentLoaded', () => {
    const userId = sessionStorage.getItem('id') || localStorage.getItem('id');
    const alterarSenhaBtn = document.getElementById('alterarSenha');
    const idUserField = document.getElementById('idUser');

    console.log('ID do usuário:', userId);

    if (!userId) {
        Swal.fire({
            title: 'Erro!',
            text: 'Entre novamente.',
            icon: 'error',
            confirmButtonText: 'Tente novamente'
        });
        return;
    }

    if (idUserField) {
        idUserField.value = userId;
    }

    if (alterarSenhaBtn) {
        alterarSenhaBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const senha = document.getElementById('senha').value;
            const senhanova = document.getElementById('senhanova').value;
            const id = idUserField.value;

            if (!senha || !senhanova) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Por favor, preencha todos os campos.',
                    icon: 'error',
                    confirmButtonText: 'Tente novamente'
                });
                return;
            }

            if (senhanova.length < 6) {

                Swal.fire({
                    title: 'Erro!',
                    text: 'A nova senha deve ter pelo menos 6 caracteres.',
                    icon: 'error',
                    confirmButtonText: 'Tente novamente'
                });
                return;
            }

            const requestData = {
                id: id,
                senha: senha,
                senhanova: senhanova
            };
            console.log('Enviando dados:', JSON.stringify(requestData));

            fetch(baseUrl + "alterarSenha.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            })
                .then(response => {
                    console.log('Resposta do servidor:', response);
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('Resposta do servidor:', text);
                            throw new Error('Erro na resposta da rede: ' + response.statusText + '. Detalhes: ' + text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Senha alterada!',
                            text: 'Sua senha foi alterada com sucesso.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Não foi possível alterar sua senha. Tente novamente.',
                            icon: 'error',
                            confirmButtonText: 'Tente novamente'
                        });
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar dados:', error);
                    mostrarMensagem('Erro ao alterar a senha. Detalhes: ' + error.message, 'alert-danger');
                });
        });
    } else {
        console.warn('Botão de alterar senha não encontrado.');
    }
});


function mostrarMensagem(mensagem, tipo) {
    const resultado = document.getElementById('resultado');
    if (resultado) {
        resultado.textContent = mensagem;
        resultado.className = 'alert ' + tipo; // Adiciona a classe apropriada para a mensagem
        // Remove a mensagem após 5 segundos
        setTimeout(() => {
            resultado.textContent = '';
            resultado.className = 'alert'; // Remove as classes específicas de alerta
        }, 5000);
    } else {
        console.error("Elemento 'resultado' não encontrado.");
    }
} document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById("fileInput");
    const selectedImage = document.getElementById("selectedImage");
    const form = document.getElementById("profileFoto");
    const userIdField = document.getElementById("userId");

    // Obtém o ID do usuário do localStorage ou sessionStorage
    const userId = sessionStorage.getItem('id') || localStorage.getItem('id');
    console.log(userId);
    // Define o valor do campo oculto com o ID do usuário
    if (userIdField) {
        userIdField.value = userId;
    } else {
        console.error('Campo oculto userId não encontrado.');
    }

    // Função para atualizar a visualização da imagem selecionada
    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            selectedImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // Atualiza a visualização da imagem quando o arquivo é selecionado
    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            previewImage(file);
        }
    });

    // Enviar a foto para o servidor
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);


        fetch(baseUrl + "uploadImage.php", {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na resposta da rede: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log('Imagem atualizada com sucesso');
                    // Atualize a visualização da imagem após o upload
                    console.log(data)
                    document.getElementById("profileFoto").addEventListener("submit", function (event) {
                        event.preventDefault(); // Impede o envio do formulário


                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Sua foto de perfil foi atualizada.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                    });
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Houve um problema ao atualizar a foto de perfil.',
                        icon: 'error',
                        confirmButtonText: 'Tente novamente'
                    });
                }
            })
            .catch(error => {
                console.error('Erro ao enviar imagem:', error);
                alert('Erro ao enviar imagem: ' + error.message);
            });
    });
}); 

    document.addEventListener('DOMContentLoaded', () => {
        const excluirBtn = document.getElementById('excluirBtn');
    
        if (excluirBtn) {
            excluirBtn.addEventListener('click', () => {
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter essa ação!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.querySelector("#profileForm");
                        const data = new FormData(form);
    
                        const idExcluir = document.getElementById("idUser").value;
                        data.append("idUser", idExcluir);
    
                        fetch(baseUrl + "excluirUser.php", {
                            method: 'POST',
                            body: data
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Erro na resposta da rede: ' + response.statusText);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    console.log('Usuário excluído com sucesso');
                                    Swal.fire(
                                        'Excluído!',
                                        'Sua conta foi excluída com sucesso.',
                                        'success'
                                    ).then(() => {
                                        // Opcional: redirecionar ou atualizar a página
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Erro!',
                                        text: 'Houve um problema ao excluir o seu perfil.',
                                        icon: 'error',
                                        confirmButtonText: 'Tente novamente'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Erro na requisição:', error);
                                Swal.fire({
                                    title: 'Erro!',
                                    text: 'Erro na requisição. Tente novamente.',
                                    icon: 'error',
                                    confirmButtonText: 'Tente novamente'
                                });
                            });
                    }
                });
            });
        }
    });
   
    
const fileInput = document.getElementById("fileInput");
const selectedImage = document.getElementById("selectedImage");
const userPointsElement = document.getElementById("userPoints");

const progressBar = document.getElementById("progressBar");
const progressText = document.getElementById("progressText");

fileInput.addEventListener("change", function () {
    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            selectedImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        selectedImage.src = ""; // Limpar a imagem se nenhum arquivo for selecionado
    }
});

async function getUserTotalScore(userId) {
    try {
        const response = await fetch(baseUrl + 'getUserTotalScore.php?user_id=' + userId);
        if (!response.ok) {
            throw new Error('Erro ao carregar pontuação total: ' + response.status);
        }
        const data = await response.json();
        return data.totalScore || 0;
    } catch (error) {
        console.error('Erro ao carregar pontuação total:', error);
        alert('Erro ao carregar pontuação total: ' + error.message);
        return 0;
    }
}


document.getElementById("alterarDados").addEventListener("click", editaDados);
