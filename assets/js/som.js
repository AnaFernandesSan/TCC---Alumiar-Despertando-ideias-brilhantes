function speak() {
    if (!('speechSynthesis' in window)) {
        alert('Speech synthesis not supported.');
        return;
    }

    // Cria uma nova instância de SpeechSynthesisUtterance
    const utterance = new SpeechSynthesisUtterance();

    // Captura o texto dos elementos
    const welcomeText = document.getElementById('Welcome').textContent.trim();
    const mensagemText = document.getElementById('mensagem').textContent.trim();
    const ctaText = document.querySelector('.cta').textContent.trim();

    // Concatena o texto
    utterance.text = `${welcomeText}. ${mensagemText}. ${ctaText}`;

    // Define a voz e as propriedades
    const voices = speechSynthesis.getVoices();
    utterance.voice = voices.find(voice => voice.name.includes('português')) || voices[0]; // Seleciona uma voz em português se disponível
    utterance.rate = 1.2; 
    utterance.volume = 1; 

    // Fala o texto concatenado
    speechSynthesis.speak(utterance);
}