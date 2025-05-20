function speakHeader() {
    let headerContent = '';
    const headerElements = document.querySelectorAll('.header .text-box h1, .header .text-box p, .header .nav-links a');
    headerElements.forEach(element => {
        headerContent += element.textContent + ' ';
    });
    speakText(headerContent);
}

// Função para falar o texto do corpo
function speakBody() {
    let bodyContent = '';
    const bodyElements = document.querySelectorAll('.cta h1, .cta p');
    bodyElements.forEach(element => {
        bodyContent += element.textContent + ' ';
    });
    speakText(bodyContent);
}

// Função para falar o texto do rodapé
function speakFooter() {
    let footerContent = '';
    const footerElements = document.querySelectorAll('footer .footer-list h3, footer .footer-list a');
    footerElements.forEach(element => {
        footerContent += element.textContent + ' ';
    });
    speakText(footerContent);
}

// Função para sintetizar o texto
function speakText(text) {
    if (!('speechSynthesis' in window)) {
        alert('Síntese de fala não é suportada.');
        return;
    }

    const utterance = new SpeechSynthesisUtterance(text.trim());
    const voices = speechSynthesis.getVoices();
    utterance.voice = voices.find(voice => voice.lang.startsWith('pt')) || null;
    utterance.rate = 1; // Velocidade da fala
    utterance.pitch = 1; // Tom da fala

    speechSynthesis.speak(utterance);
}

// Adiciona ouvintes de evento aos botões
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('speakHeaderButton').addEventListener('click', speakHeader);
    document.getElementById('speakBodyButton').addEventListener('click', speakBody);
    document.getElementById('speakFooterButton').addEventListener('click', speakFooter);
});