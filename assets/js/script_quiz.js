let indexPerguntas = 0;
let questoes = [];
let score = 0;

const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

let dificuldade = '';

function loadQuestions(dificuldade) {
    fetch(baseUrl + 'get_questions.php?dificuldade=' + dificuldade)
        .then(response => response.json())
        .then(responseData => {
            // Acessar o array de dados dentro do objeto de resposta
            if (responseData.success) {
                questoes = processarQuestoes(responseData.data);
                mostrarQuestao();
            } else {
                console.error('Falha ao carregar as questões:', responseData);
            }
        })
        .catch(error => {
            console.error('Erro ao carregar as questões:', error);
        });
}



// Processar as questões para organizar perguntas e respostas
function processarQuestoes(data) {
    if (!Array.isArray(data)) {
        console.error('Erro: Esperado um array, mas recebi:', data);
        return [];  // Retorna um array vazio em caso de erro
    }
    const perguntasMap = {};

    data.forEach(row => {
        if (!perguntasMap[row.pergunta_id]) {
            perguntasMap[row.pergunta_id] = {
                quiz_id: row.quiz_id,
                quiz_nome: row.quiz_nome,
                pergunta_id: row.pergunta_id,
                pergunta: row.pergunta,
                imagem: row.imagem,
                respostas: []
            };
        }

        perguntasMap[row.pergunta_id].respostas.push({
            resposta: row.resposta,
            correta: row.resposta_correta
        });
    });

    return Object.values(perguntasMap);
}

function mostrarQuestao() {
    if (indexPerguntas < questoes.length) {
        const pergunta = questoes[indexPerguntas];

        let questionHtml = `
            <h2>
            <div class="question" style="font-size:20px bold;">${pergunta.pergunta}</div>
            </h2>
        `;
        console.log('Imagem da pergunta:', pergunta.imagem);

        // Verificando e exibindo a imagem, se houver
        if (pergunta.imagem && pergunta.imagem.trim() !== '') {
            questionHtml += `
                <div class="imagem-pergunta">
                    <img src="${pergunta.imagem}" alt="Imagem da pergunta">
                </div>
            `;
        }

        // Adicionando as opções de resposta
        questionHtml += `
            <ul class="options">
                ${pergunta.respostas.map((resposta, index) => `
                    <li>
                        <button id="btn${index + 1}" class="quiz_b" onclick="checkResposta(${index + 1}, ${resposta.correta})">
                            ${resposta.resposta}
                        </button>
                    </li>
                `).join('')}
            </ul>
        `;

        // Inserindo o HTML gerado no elemento de quiz
        document.getElementById('quiz').innerHTML = questionHtml;
    } else {
        // Exibindo a pontuação final ao término do quiz
        document.getElementById('quiz').innerHTML = `
            <div class="question">Quiz completo! Sua pontuação é ${score}/${questoes.length}</div>
            <button class="quiz_b" onclick="location.reload()">Voltar para o início</button>
        `;
    }
}


function checkResposta(resposta_selecionada, correta) {
    const botaoSelecionado = document.getElementById(`btn${resposta_selecionada}`);

    if (correta) {
        // A resposta está correta
        score++;
        botaoSelecionado.classList.add('correct');
    } else {
        // A resposta está errada
        botaoSelecionado.classList.add('wrong');
    }

    // Desabilitar todos os botões após uma resposta ser selecionada
    const botoes = document.querySelectorAll('.quiz_b');
    botoes.forEach(botao => {
        botao.disabled = true;

        // Se o botão atual for o correto e ainda não estiver marcado, marcá-lo como correto
        const isCorrect = botao.getAttribute('onclick').includes('true');
        if (isCorrect && !botao.classList.contains('correct')) {
            botao.classList.add('correct');
        }
    });

    // Avançar para a próxima pergunta após 1 segundo
    setTimeout(() => {
        indexPerguntas++;
        mostrarQuestao();
    }, 1000);
}
