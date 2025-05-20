const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";
function carregaWord() {
    fetch(baseUrl + "getAll_word.php")
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data);  // Para depuração

            const wordlist = document.getElementById('word-list');
            wordlist.innerHTML = "";

            data.forEach(word => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${word.atividade_id}</td>
                    <td>${word.word}</td>
                    <td>${word.foto}</td> 
                    <td><button class="btn btn-danger" id="${word.atividade_id}" onclick="excluirWord(event)">Excluir</button></td>
                    <td><button class="btn btn-warning" id="${word.atividade_id}" onclick="atualizarWord(event)">Editar</button></td>
                `;
                wordlist.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar palavras:", error);
        });
}

document.addEventListener("DOMContentLoaded", function () {
    carregaWord(); 
});


function FecharTodosModais() {
    const modals = document.querySelectorAll('.modals');
    modals.forEach(modal => {
        modal.classList.remove('show');
    });
}



function atualizarWord(e) {
    e.preventDefault();
    const id = e.target.id;
    document.getElementById("idWordEditar").value = id;
    console.log("ID do Word:", id);
    exibirModalEditarWord();

    fetch(baseUrl + "get_word.php?id=" + id)
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data);
            document.getElementById("word_novo").value = data.data.word;
            document.getElementById("foto-caminho").value = data.data.foto;
            carregaWord();
        })
        .catch(error => {
            console.error('Fetch error: ', error);
            alert("Erro ao buscar os dados do vídeo.");
        });
}


function excluirWord(e) {
    e.preventDefault();

    const id = e.target.id;
    console.log("ID obtido do botão:", id);

    const data = { id: id };

    document.getElementById('idWordExcluir').value = id;
    exibirModalExcluirWord();

    document.getElementById("btnModalExcluirSim").addEventListener("click", () => {
        fetch(baseUrl + "deleteWord.php", {
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
                        fecharModalExcluirWord();
                        carregaWord();
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

        fecharModalExcluirWord();
    });
}

document.getElementById("btnSalvarEditarWord").addEventListener("click", (e) => {
    e.preventDefault();

    const form = document.querySelector("#formEditar");
    const data = new FormData(form);

    const idWordEditar = document.getElementById("idWordEditar").value;
    data.append("idWordEditar", idWordEditar);

    fetch(baseUrl + "editWord.php", {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(text => {
        console.log("Resposta recebida:", text); // Adicionado para verificar a resposta
        return text;
    })
    .then(text => {
        try {
            const dataResponse = JSON.parse(text);
            if (dataResponse.success) {
                carregaWord();
                fecharModalEditarWord();
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

function fecharModalEditarWord() {
    console.log("Fechando modal de edição"); // Debug: Confirma se a função é chamada
    const modalEditar = document.getElementById("modal-editar-word");
    modalEditar.classList.remove("show");
    modalEditar.style.display = "none"; // Para garantir que o display seja none
}

// Assegure que a função de exibição do modal esteja correta
function exibirModalEditarWord() {
    FecharTodosModais(); // Fechar outros modais
    const modalEditar = document.getElementById("modal-editar-word");
    modalEditar.classList.add("show");
    modalEditar.style.display = "block"; // Garantir que o modal seja exibido
}


function fecharModalEditarWord() {
    FecharTodosModais();
    document.getElementById("modal-editar-word").classList.remove("show");
}


function fecharModalExcluirWord() {
    FecharTodosModais();
    document.getElementById("modal-excluir-word").classList.remove("show");
}

function exibirModalExcluirWord() {
    FecharTodosModais();
    document.getElementById("modal-excluir-word").classList.add("show");
}


document.getElementById("btnCancelarEditarWord").addEventListener("click", fecharModalEditarWord);
document.getElementById("btnModalExcluirNao").addEventListener("click", fecharModalExcluirWord);
