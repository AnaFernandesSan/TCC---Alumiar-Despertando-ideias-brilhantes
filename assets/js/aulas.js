const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

document.addEventListener("DOMContentLoaded", function() {
    let aulas = [];
    let currentAulaIndex = 0;

    // Seletores e configuração dos eventos
    const modal = document.getElementById('aulaModal');
    const closeBtn = document.querySelector('.close');
    const prevBtn = document.getElementById('prevAula');
    const nextBtn = document.getElementById('nextAula');
    const buttonsAcessar = document.querySelectorAll('.btn-acessar-modal');

    // Função para abrir o modal
    function openModal(aulaId) {
        modal.style.display = 'block';
        loadAulas(aulaId);
    }

    // Função para fechar o modal
    function closeModal() {
        modal.style.display = 'none';
    }

    function loadAulas(aulaId) {
        fetch(baseUrl + 'getAll_aula.php')
            .then(response => response.json())
            .then(data => {
                aulas = data;
                console.log('Dados carregados:', aulas); // Adiciona log para depuração
                
                // Se não foi passado um ID específico, inicializa com o índice 0 (primeira aula)
                if (aulaId === undefined || aulaId === null) {
                    currentAulaIndex = 0; // Começa com a primeira aula
                } else {
                    currentAulaIndex = aulas.findIndex(aula => aula.id == aulaId);
                    // Verifica se o índice encontrado é válido
                    if (currentAulaIndex === -1) {
                        console.error('ID da aula não encontrado.');
                        modalBody.innerHTML = '<p>ID da aula não encontrado.</p>';
                        return;
                    }
                }
                displayAula(currentAulaIndex);
            })
            .catch(error => {
                console.error('Erro ao carregar as aulas:', error);
                const modalBody = document.querySelector('.modal-body');
                modalBody.innerHTML = '<p>Erro ao carregar as aulas.</p>';
            });
    }

    // Função para exibir a aula atual
    function displayAula(index) {
        if (aulas.length > 0 && index >= 0 && index < aulas.length) {
            const aula = aulas[index];
            
            // Atualiza o título do modal
            const modalTitle = document.getElementById('modalTitle');
            if (modalTitle) {
                modalTitle.textContent = aula.titulo; // Define o título do modal
            }

            // Atualiza o corpo do modal
            const imageContainer = document.querySelector('.image-container');
            const dialogueContainer = document.querySelector('.dialogue-container');
            const videoAula = document.querySelector('.video-aula');

            if (imageContainer && dialogueContainer && videoAula) {
                imageContainer.innerHTML = `
                    <img src="${aula.imagem || '../imagens/lamp.png'}" alt="${aula.titulo}">
                `;
                dialogueContainer.innerHTML = `
                    <p class="dialogue-text">${aula.descricao || ''}</p>
                `;
                videoAula.innerHTML = `
                    ${aula.video ? `<video src="${aula.video}" controls></video>` : ''}
                `;
            } else {
                console.error('Elemento(s) não encontrado(s).');
            }
        } else {
            console.error('Índice fora do intervalo ou array de aulas vazio.');
        }
    }

    // Eventos para os botões de acesso
    buttonsAcessar.forEach(button => {
        button.addEventListener('click', function () {
            const aulaId = this.getAttribute('data-aula-id');
            openModal(aulaId); // Abre o modal com a aula selecionada
        });
    });

    // Eventos para fechar o modal e navegação
    closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            closeModal();
        }
    });

    prevBtn.addEventListener('click', function () {
        if (currentAulaIndex > 0) {
            currentAulaIndex--;
            displayAula(currentAulaIndex);
        }
    });

    nextBtn.addEventListener('click', function () {
        if (currentAulaIndex < aulas.length - 1) {
            currentAulaIndex++;
            displayAula(currentAulaIndex);
        }
    });
});


function FecharTodosModais() {
    const modals = document.querySelectorAll('.modals');
    modals.forEach(modal => {
        modal.classList.remove('show');
    });
}

function editarAula(e) {
    e.preventDefault();
    const id = e.target.id;
    document.getElementById("idAulaEditar").value = id;
    fetch(baseUrl + "get_aula.php?id=" + id)
        .then(response => response.json())
        .then(data => {
            if (data) {
                const titulo = document.getElementById("titulo_novo");
                const video = document.getElementById("video_novo");

                titulo.value = data["titulo"];
                video.textContent = data["video"];
            }
        });

    exibirModalEditarAula();
}

function carregaAulas() {
    fetch(baseUrl + "getAll_aula.php")
        .then(response => response.json())
        .then(data => {
            const aulalist = document.getElementById('aulas-list');
            aulalist.innerHTML = "";

            data.forEach(aula => {
                const row = document.createElement('tr');

                const tdId = document.createElement('td');
                const tdtitulo = document.createElement('td');
                const tdvideo = document.createElement('td');

                const tdBtnExcluir = document.createElement('td');
                const btnExcluirAula = document.createElement('button');

                const tdBtnEditar = document.createElement('td');
                const btnEditarAula = document.createElement('button');

                tdId.textContent = aula.id;
                tdtitulo.textContent = aula.titulo;
                tdvideo.textContent = aula.video;

                btnExcluirAula.textContent = "Excluir";
                btnExcluirAula.id = aula.id;

                btnEditarAula.textContent = "Editar";
                btnEditarAula.id = aula.id;

                btnEditarAula.classList.add("btn", "btn-warning");
                btnExcluirAula.classList.add("btn", "btn-danger");

                btnExcluirAula.addEventListener("click", excluirAula);
                btnEditarAula.addEventListener("click", editarAula);

                tdBtnExcluir.appendChild(btnExcluirAula);
                tdBtnEditar.appendChild(btnEditarAula);

                row.appendChild(tdId);
                row.appendChild(tdtitulo);
                row.appendChild(tdvideo);
                row.appendChild(tdBtnExcluir);
                row.appendChild(tdBtnEditar);

                aulalist.appendChild(row);
            });
        });
}

function excluirAula(e) {
    const id = e.target.id;
    const data = { 'id': id };

    exibirModalExcluirAula();

    document.getElementById("btnModalExcluirSim").addEventListener("click", () => {
        fetch(baseUrl + "deleteAula.php", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    carregaAulas();
                } else {
                    alert(data.message);
                }
            });

        fecharModalExcluirAula();
    });
}

function exibirModalExcluirAula() {
    FecharTodosModais();
    document.getElementById("modal-excluir-aula").classList.add("show");
}

function fecharModalExcluirAula() {
    FecharTodosModais();
    document.getElementById("modal-excluir-aula").classList.remove("show");
}

function exibirModalEditarAula() {
    FecharTodosModais();
    document.getElementById("modal-editar-aula").classList.add("show");
}

function fecharModalEditarAula() {
    FecharTodosModais();
    document.getElementById("modal-editar-aula").classList.remove("show");
}

document.getElementById("btnCancelarEditarAula").addEventListener("click", fecharModalEditarAula);
document.getElementById("btnModalExcluirNao").addEventListener("click", fecharModalExcluirAula);

document.getElementById("btnSalvarEditarAula").addEventListener("click", (e) => {
    e.preventDefault(); // Prevenir o comportamento padrão do formulário
    
    const titulo = document.getElementById("titulo_novo").value;
    const video = document.getElementById("video_novo").value;
    const id = document.getElementById("idAulaEditar").value;
    const data = {"id": id, "titulo" : titulo, "video" : video};

    fetch(baseUrl + "editAula.php", {
        method: 'POST',
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            carregaAulas(); // Recarregar aulas
        } else {
            alert(data.message); // Exibir mensagem de erro
        }
    });

    fecharModalEditarAula(); // Fechar modal após edição
});
