const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";


function getActivityScore(atividadeId) {
    return fetch(baseUrl + 'getActivityScore.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            atividade_id: atividadeId,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            return data.pontuacao; // Retorna a pontuação obtida
        } else {
            console.error('Erro ao obter pontuação da atividade:', data.message);
            return null;
        }
    })
    .catch(error => {
        console.error('Erro ao fazer fetch para obter a pontuação:', error);
        return null;
    });
}

// Função para registrar a tentativa
function registerAttempt(userId, atividadeId, tentativa, pontuacao) {
    return fetch(baseUrl + 'registerAttempt.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            user_id: userId,
            atividade_id: atividadeId,
            tentativa: tentativa,
            pontuacao: pontuacao,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Tentativa registrada com sucesso:', data.message);
        } else {
            console.error('Erro ao registrar tentativa:', data.message);
        }
    })
    .catch(error => {
        console.error('Erro ao fazer fetch para registrar tentativa:', error);
    });
}

// Função para verificar a resposta do usuário

function checkAnswer() {
    const filledButtons = answerField.querySelectorAll('.filled');
    let answer = '';
    filledButtons.forEach(button => {
        answer += button.textContent;
    });

    const correctWord = currentWord.toLowerCase();

    if (answer === correctWord) {
        motivationMessage.textContent = 'Great Job!';
        motivationMessage.className = 'motivation-message correct show';
        correctAnswers++;
        updateProgress();

        if (currentIndex + 1 >= totalWords) {
            // Obtém a pontuação da atividade
            getActivityScore(atividadeId).then(pontuacao => {
                if (pontuacao !== null) {
                    const tentativa = getTentativa(); // Implemente conforme necessário
                    // Registra a tentativa no servidor
                    registerAttempt(userId, atividadeId, tentativa, pontuacao);
                    showEndMessage();
                }
            });
        } else {
            loadNextWord();
        }
    } else {
        motivationMessage.textContent = 'Try Again!';
        motivationMessage.className = 'motivation-message incorrect show';

        filledButtons.forEach(button => {
            button.classList.remove('filled');
            button.textContent = ''; // Clear text if needed
        });
    }

    setTimeout(() => {
        motivationMessage.className = 'motivation-message';
    }, 2000);
}

function getTentativa() {
    // Implemente a lógica para obter o número da tentativa
    return 1; // Exemplo
}

// Adicione um listener para quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    // Obtendo o ID do usuário e a ID da atividade
    const userId = sessionStorage.getItem('id') || localStorage.getItem('id');
    const atividadeIdElement = document.getElementById('atividade_id');
    const atividadeId = atividadeIdElement ? atividadeIdElement.value : window.atividade_id;

    if (userId) {
        // Adicione um listener para quando a função checkAnswer for chamada
        const submitButton = document.getElementById('checkButton');
        if (submitButton) {
            submitButton.addEventListener('click', checkAnswer);
        } else {
            console.error('Elemento com ID "submitAnswer" não encontrado.');
        }
    } else {
        console.error('ID do usuário ou ID da atividade não encontrados.');
    }
});
////////////////