const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

document.addEventListener("DOMContentLoaded", function () {
    carregaQuiz(); // Carregar quizzes ao iniciar a página
});

function FecharTodosModais() {
    const modals = document.querySelectorAll('.modals');
    modals.forEach(modal => {
        modal.classList.remove('show');
    });
}

function carregaQuiz() {
    fetch(baseUrl + "getAll_quiz.php")
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data);  // Para depuração

            const Quizlist = document.getElementById('quiz-list');
            Quizlist.innerHTML = "";

            // Agrupa os quizzes por ID para evitar múltiplas linhas
            const quizzes = data.reduce((acc, item) => {
                if (!acc[item.id]) {
                    acc[item.id] = {
                        id: item.id,
                        nome: item.nome,
                        dificuldade: item.dificuldade,
                        perguntas: {}
                    };
                }
                // Adiciona perguntas e respostas
                for (const pergunta_id in item.perguntas) {
                    const pergunta = item.perguntas[pergunta_id];
                    if (!acc[item.id].perguntas[pergunta_id]) {
                        acc[item.id].perguntas[pergunta_id] = {
                            id: pergunta.id,
                            pergunta: pergunta.pergunta,
                            imagem: pergunta.imagem,
                            tipo: pergunta.tipo,
                            respostas: []
                        };
                    }
                    pergunta.respostas.forEach(resposta => {
                        acc[item.id].perguntas[pergunta_id].respostas.push({
                            id: resposta.id,
                            resposta: resposta.resposta,
                            correta: resposta.correta
                        });
                    });
                }
                return acc;
            }, {});

            console.log("Quizzes agrupados:", quizzes);  // Para depuração

            Object.values(quizzes).forEach(quiz => {
                const container = document.createElement('div');
                container.classList.add('quiz-container');

                const header = document.createElement('div');
                header.classList.add('quiz-header');
                header.innerHTML = `
                    <div><strong>ID:</strong> ${quiz.id}</div>
                    <div><strong>Nome:</strong> ${quiz.nome}</div>
                    <div><strong>Dificuldade:</strong> ${quiz.dificuldade}</div>
                `;

                const perguntasContainer = document.createElement('div');
                perguntasContainer.classList.add('quiz-perguntas');

                Object.values(quiz.perguntas).forEach(pergunta => {
                    const perguntaContainer = document.createElement('div');
                    perguntaContainer.classList.add('pergunta-container');
                    perguntaContainer.innerHTML = `
                        <div><strong>Imagem:</strong> ${pergunta.imagem}</div>
                        <div><strong>Pergunta:</strong> ${pergunta.pergunta}</div>
                        <div><strong>Tipo:</strong> ${pergunta.tipo}</div>
                        
                    `;

                    // Criação do container de respostas
                    const respostasContainer = document.createElement('div');
                    respostasContainer.classList.add('pergunta-respostas');
                    respostasContainer.innerHTML = `
                        <strong>Respostas:</strong>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            ${pergunta.respostas.map(resposta => `
                                <li style="padding: 10px; border-bottom: 1px solid #ddd; display: flex; align-items: center;">
                                    <div style="flex: 0 0 50px; text-align: center; font-weight: bold;">ID: ${resposta.id}</div>
                                    <div style="flex: 1; padding-left: 10px;">${resposta.resposta}</div>
                                    ${resposta.correta ?
                            '<span style="margin-left: 10px; padding: 3px 8px; background-color: #dff0d8; color: #3c763d; border-radius: 5px; font-weight: bold;">Correta</span>'
                            : ''
                        }
                                </li>
                            `).join('')}
                        </ul>
                    `;

                    perguntaContainer.appendChild(respostasContainer);
                    perguntasContainer.appendChild(perguntaContainer);
                });
                const actionsContainer = document.createElement('div');
                actionsContainer.classList.add('quiz-actions');
                const btnExcluirQuiz = document.createElement('button');
                btnExcluirQuiz.textContent = "Excluir";
                btnExcluirQuiz.id = quiz.id;
                btnExcluirQuiz.classList.add("btn", "btn-danger");
                btnExcluirQuiz.addEventListener("click", excluirQuiz);

                const btnEditarQuiz = document.createElement('button');
                btnEditarQuiz.textContent = "Editar";
                btnEditarQuiz.id = quiz.id;
                btnEditarQuiz.classList.add("btn", "btn-warning");
                btnEditarQuiz.addEventListener("click", atualizarQuiz);

                actionsContainer.appendChild(btnEditarQuiz);
                actionsContainer.appendChild(btnExcluirQuiz);

                container.appendChild(header);
                container.appendChild(perguntasContainer);
                container.appendChild(actionsContainer);

                Quizlist.appendChild(container);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar quizzes:", error);
        });
}


function atualizarQuiz(e) {
    e.preventDefault();
    const id = e.target.id;
    document.getElementById("idQuizEditar").value = id;
    exibirModalEditarQuiz();

    fetch(baseUrl + "get_quiz.php?id=" + id)
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data); // Para depuração

            if (data.success && data.data.success) {
                const quiz = data.data.data;

                // Preencher os campos do quiz
                document.getElementById("nome_novo").value = quiz.nome;
                document.getElementById("pergunta_novo").value = quiz.pergunta;
                document.getElementById("imagem-caminho").value = quiz.imagem;
                document.getElementById("opcao_novo").value = quiz.tipo;
                document.getElementById("novo_dificuldade").value = quiz.dificuldade;

                // Preencher as respostas
                quiz.respostas.forEach((resposta, respostaIndex) => {
                    document.getElementById('resposta_novo_' + (respostaIndex + 1)).value = resposta.resposta;
                    document.getElementById('idResposta_' + (respostaIndex + 1)).value = resposta.id;

                    // Marcar a resposta correta
                    const corretaInput = document.getElementById('correta_novo_' + (respostaIndex + 1));
                    if (corretaInput) {
                        corretaInput.checked = resposta.correta === 1;
                    }
                })

            } else {
                console.error('Erro ao carregar os dados do quiz:', data);
            }
        })
        .catch(error => console.error("Erro ao carregar os dados:", error));
}

document.getElementById("btnSalvarEditarQuiz").addEventListener("click", (e) => {
    e.preventDefault();

    const form = document.querySelector("#formEditar");
    const data = new FormData(form);

    const idQuizEditar = document.getElementById("idQuizEditar").value;
    data.append("idQuizEditar", idQuizEditar);

    fetch(baseUrl + "editQuiz.php", {
        method: 'POST',
        body: data
    })
        .then(response => response.text())
        .then(text => {
            console.log("Resposta recebida:", text); // Aqui você pode ver o que o servidor está enviando
            try {
                const dataResponse = JSON.parse(text);
                if (dataResponse.success) {
                    carregaQuiz();

                    fecharModalEditarQuiz();
                } else {
                    alert(dataResponse.message);
                }
            } catch (error) {
                console.error('Erro ao analisar JSON:', error);
            }
        })
});

function excluirQuiz(e) {
    e.preventDefault();

    const id = e.target.id;
    console.log("ID obtido do botão:", id);

    const data = { id: id };

    document.getElementById('idQuizExcluir').value = id;
    exibirModalExcluirQuiz();

    document.getElementById("btnModalExcluirSim").addEventListener("click", () => {
        fetch(baseUrl + "deleteQuiz.php", {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(response => response.text())
            .then(text => {
                console.log("Resposta bruta da API:", text);

                try {
                    const responseData = JSON.parse(text);
                    if (responseData.success) {
                        carregaQuiz();
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

        fecharModalExcluirQuiz();
    });
}




function fecharModalEditarQuiz() {
    FecharTodosModais();
    document.getElementById("modal-editar-quiz").classList.remove("show");
}

function exibirModalEditarQuiz() {
    FecharTodosModais();
    document.getElementById("modal-editar-quiz").classList.add("show");
}

function fecharModalExcluirQuiz() {
    FecharTodosModais();
    document.getElementById("modal-excluir-quiz").classList.remove("show");
}


function exibirModalExcluirQuiz() {
    FecharTodosModais();
    document.getElementById("modal-excluir-quiz").classList.add("show");
}


document.getElementById("btnCancelarEditarQuiz").addEventListener("click", fecharModalEditarQuiz);
document.getElementById("btnModalExcluirNao").addEventListener("click", fecharModalExcluirQuiz);
