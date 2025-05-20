const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

const answerField = document.getElementById('answerField');
const imageContainer = document.getElementById('imageContainer');
const motivationMessage = document.getElementById('motivation-message');

const endMessage = document.getElementById('end-message');
const finalScore = document.getElementById('final-score');
const restartButton = document.getElementById('restart-button');
const skipButton = document.getElementById('skipButton');
const alphabetButtons = document.getElementById('alphabetButtons');

let currentIndex = 0;
let correctAnswers = 0;
let wordData = [];
let currentWord = '';
let totalWords = 0;
let answeredWords = new Set();

document.addEventListener('DOMContentLoaded', function () {
    loadWordsFromServer();
});

function loadWordsFromServer() {
    fetch(baseUrl + "getArrastar.php")
        .then(response => response.json())
        .then(data => {
            wordData = data;
            totalWords = wordData.length;
            if (totalWords > 0) {
                loadNextWord();
            } else {
                console.log('Nenhuma palavra encontrada.');
            }
        })
        .catch(error => {
            console.error('Erro ao carregar palavras:', error);
            alert('Erro ao carregar palavras: ' + error.message);
        });
}

function displayWord(container, word) {
    container.innerHTML = '';
    alphabetButtons.innerHTML = '';

    const shuffledWord = shuffleArray(word.split(''));
    shuffledWord.forEach(letter => {
        const button = document.createElement('div');
        button.textContent = letter.toUpperCase();
        button.className = 'alphabet-button';
        button.draggable = true;
        button.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text/plain', letter);
        });
        alphabetButtons.appendChild(button);
    });

    // Cria placeholders e define eventos de arrastar e soltar
    word.split('').forEach((correctLetter, index) => {
        const placeholder = document.createElement('div');
        placeholder.className = 'answer-slot';
        placeholder.dataset.index = index; // Armazena o índice correto

        placeholder.addEventListener('dragover', (e) => {
            e.preventDefault(); // Permite o drop
        });

        placeholder.addEventListener('drop', (e) => {
            e.preventDefault();
            const letter = e.dataTransfer.getData('text/plain').toUpperCase();

            // Verifica se a letra está na posição correta
            if (letter === word[index].toUpperCase()) {
                placeholder.textContent = letter;
                placeholder.style.backgroundColor = 'green'; // Cor verde para correto
                placeholder.classList.add('filled');
            } else {
                placeholder.textContent = letter;
                placeholder.style.backgroundColor = 'red'; // Cor vermelha para incorreto
                placeholder.classList.add('filled');
            }

            // Verifica se todas as letras foram colocadas
            checkIfWordComplete(container, word);
        });

        container.appendChild(placeholder);
    });
}

function checkIfWordComplete(container, word) {
    const filledSlots = container.querySelectorAll('.answer-slot.filled');
    const correctSlots = container.querySelectorAll('.answer-slot');

    if (filledSlots.length === correctSlots.length) {
        // Verifica se todas as letras estão corretas
        let correct = true;
        correctSlots.forEach((slot, index) => {
            if (slot.textContent.toUpperCase() !== word[index].toUpperCase()) {
                correct = false;
            }
        });

        // Se a palavra estiver errada, passa para a próxima palavra
        if (!correct) {
            Swal.fire({
                title: 'Opa!',
                text: 'Tente novamente.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            setTimeout(loadNextWord, 1000); // Avança para a próxima palavra após 1 segundo
        } else {
            // Caso a palavra esteja correta
            Swal.fire({
                title: 'Boa!',
                text: 'Próxima palavra.',
                icon: 'success',
                confirmButtonText: 'Próxima'
            });
            correctAnswers++;
            answeredWords.add(currentIndex); // Marcar como respondido
            updateProgress();

            currentIndex++;  // Avançar para a próxima palavra

            if (currentIndex < totalWords) {
                setTimeout(loadNextWord, 1000); // Avança para a próxima palavra após 1 segundo
            } else {
                showEndMessage();  // Exibir a mensagem final apenas quando todas as palavras forem respondidas
            }
        }
    }
}




function loadNextWord() {
    if (currentIndex < totalWords) {
        const currentWordObj = wordData[currentIndex];
        currentWord = currentWordObj.word.toLowerCase();

        answerField.innerHTML = '';
        alphabetButtons.innerHTML = '';

        displayWord(answerField, currentWord);
        loadImageFromServer(currentWordObj.foto);
    } else {
        showEndMessage();
    }
}

function loadImageFromServer(imageUrl) {
    const imageElement = document.getElementById('currentImage');
    if (imageUrl) {
        imageElement.src = imageUrl;
    } else {
        imageElement.src = 'caminho/para/imagem/padrao.jpg';
    }
}

function checkAnswer() {
    const filledButtons = answerField.querySelectorAll('.filled');
    let answer = '';
    filledButtons.forEach(button => {
        answer += button.textContent;
    });

    const correctWord = currentWord.toUpperCase();
    const normalizedAnswer = answer.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    const normalizedCorrectWord = correctWord.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    if (normalizedAnswer === normalizedCorrectWord) {
        Swal.fire({
            title: 'Boa!',
            text: 'Próxima palavra.',
            icon: 'success',
            confirmButtonText: 'Próxima'
        });
        correctAnswers++;
        answeredWords.add(currentIndex);

        currentIndex++;
        if (currentIndex < totalWords) {
            loadNextWord();
        } else {
            showEndMessage();
        }
    } else {
        Swal.fire({
            title: 'Opa!',
            text: 'Tente novamente.',
            icon: 'error',
            confirmButtonText: 'OK'
        });

        // Se a resposta estiver errada, marca os espaços em vermelho
        filledButtons.forEach(button => {
            button.style.backgroundColor = 'red';
        });
    }

    setTimeout(() => {
        motivationMessage.className = 'motivation-message';
    }, 2000);
}

function restartGame() {
    currentIndex = 0;
    correctAnswers = 0;
    answeredWords.clear();
    loadWordsFromServer();
}

function showEndMessage() {
    const successMessage = `Parabéns! Você acertou ${correctAnswers} de ${totalWords} palavras!`;
    const finalScoreMessage = `Pontuação final: ${correctAnswers} de ${totalWords}`;

    document.getElementById('endMessageContent').textContent = successMessage;
    document.getElementById('finalScoreContent').textContent = finalScoreMessage;

    const modal = document.getElementById('endModal');
    modal.style.display = 'block';

    const closeModal = document.getElementById('closeModal');
    closeModal.onclick = function () {
        modal.style.display = 'none';
        redirectToActivities();  // Redireciona para a página de atividades ao fechar o modal
    };

    const restartButtonModal = document.getElementById('restartButtonModal');
    restartButtonModal.onclick = function () {
        modal.style.display = 'none';
        redirectToActivities();  // Redireciona para a página de atividades ao reiniciar o quiz
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            redirectToActivities();  // Redireciona caso clique fora do modal
        }
    };
}

function redirectToActivities() {
    window.location.href = 'atividades.php';  // Substitua com o URL correto da página de atividades
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}


function updateProgress() {
    const answeredCount = answeredWords.size;
    const progressPercentage = (answeredCount / totalWords) * 100;
    const progressBar = document.getElementById('progress');
    progressBar.style.width = progressPercentage + '%';
    progressBar.style.backgroundColor = getProgressColor(progressPercentage);

    console.log(`Progresso: ${progressPercentage}%`);
}

function getProgressColor(percentage) {
    return percentage >= 100 ? 'green' : percentage >= 50 ? '#4CAF50' : '#76c7c0';
}
