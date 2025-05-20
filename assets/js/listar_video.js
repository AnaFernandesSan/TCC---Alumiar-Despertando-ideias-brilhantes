const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

document.addEventListener("DOMContentLoaded", function () {
    carregaVideo();
});
function carregaVideo() {
    fetch(baseUrl + "getAll_Video.php")
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data);  // Para depuração

            const Videolist = document.getElementById('aulas-list');

            if (!Videolist) {
                console.error("Elemento 'aulas-list' não encontrado.");
                return;
            }

            Videolist.innerHTML = "";

            data.forEach(video => {
                const row = document.createElement('tr');

                // Colunas da tabela com o caminho do vídeo
                row.innerHTML = `
                        <td>${video.id}</td>
                        <td>${video.titulo}</td>
                        <td>${video.descricao}</td>
                        <td>${video.video}</td> <!-- Mostra o caminho do vídeo -->
                        <td><button class="btn btn-danger" id="${video.id}" onclick="excluirVideo(event)">Excluir</button></td>
                        <td><button class="btn btn-warning" id="${video.id}" onclick="atualizarVideo(event)">Editar</button></td>
                    `;

                Videolist.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar vídeos:", error);
        });
}




function FecharTodosModais() {
    const modals = document.querySelectorAll('.modals');
    modals.forEach(modal => {
        modal.classList.remove('show');
    });
}



function atualizarVideo(e) {
    e.preventDefault();
    const id = e.target.id;
    document.getElementById("idVideoEditar").value = id;
    console.log("ID do Video:", id);

    exibirModalEditarVideo();

    fetch(baseUrl + "get_video.php?id=" + id)
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data); // Para depuração

            document.getElementById("titulo_novo").value = data.data.titulo;
            document.getElementById("descricao_novo").value = data.data.descricao;
            document.getElementById("video-caminho").value = data.data.video;
        })
        .catch(error => {
            console.error('Fetch error: ', error);
            alert("Erro ao buscar os dados do vídeo.");
        });
}


function excluirVideo(e) {
    e.preventDefault();

    const id = e.target.id;
    console.log("ID obtido do botão:", id);

    const data = { id: id };

    // Exiba o modal de confirmação
    document.getElementById('idVideoExcluir').value = id;
    exibirModalExcluirVideo();

    document.getElementById("btnModalExcluirSim").addEventListener("click", () => {
        fetch(baseUrl + "deleteAula.php", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
            .then(response => response.text())
            .then(text => {
                console.log("Resposta bruta da API:", text);

                try {
                    const responseData = JSON.parse(text);
                    if (responseData.success) {
                        fecharModalExcluirVideo();
                        carregaVideo();
                    } else {
                        alert(responseData.message);
                    }
                } catch (error) {
                    console.error("Erro ao parsear JSON:", error);
                }
            })
            .catch(error => {
                console.error("Erro ao excluir o quiz:", error);
            });

        fecharModalExcluirVideo();
    });
}

function fecharModalEditarVideo() {
    console.log("Fechando modal de edição"); // Debug: Confirma se a função é chamada
    const modalEditar = document.getElementById("modal-editar-aula");
    modalEditar.classList.remove("show");
    modalEditar.style.display = "none"; // Para garantir que o display seja none
}

// Assegure que a função de exibição do modal esteja correta
function exibirModalEditarVideo() {
    FecharTodosModais(); // Fechar outros modais
    const modalEditar = document.getElementById("modal-editar-aula");
    modalEditar.classList.add("show");
    modalEditar.style.display = "block"; // Garantir que o modal seja exibido
}


function fecharModalEditarVideo() {
    FecharTodosModais();
    document.getElementById("modal-editar-aula").classList.remove("show");
}



function fecharModalExcluirVideo() {
    FecharTodosModais();
    document.getElementById("modal-excluir-aula").classList.remove("show");
}

function exibirModalExcluirVideo() {
    FecharTodosModais();
    document.getElementById("modal-excluir-aula").classList.add("show");
}

document.getElementById("btnSalvarEditarVideo").addEventListener("click", (e) => {
    e.preventDefault();

    const form = document.querySelector("#formEditar");
    const data = new FormData(form);

    // Adiciona o ID do vídeo que está sendo editado
    const idVideoEditar = document.getElementById("idVideoEditar").value;
    data.append("idVideoEditar", idVideoEditar);

    fetch(baseUrl + "editVideo.php", {
        method: 'POST',
        body: data
    })
        .then(response => response.text())
        .then(text => {
            console.log("Resposta recebida:", text);
            return text;
        })
        .then(text => {
            try {
                const dataResponse = JSON.parse(text);
                if (dataResponse.success) {
                    carregaVideo();
                    fecharModalEditarVideo();
                } else {
                    alert(dataResponse.message);
                }
            } catch (error) {
                console.error('Erro ao analisar JSON:', error);
            }
        })
        .catch(error => {
            console.error('Erro ao editar o vídeo:', error);
        });
});

document.getElementById("btnCancelarEditarVideo").addEventListener("click", fecharModalEditarVideo);
document.getElementById("btnCancelarExcluir").addEventListener("click", fecharModalExcluirVideo);
