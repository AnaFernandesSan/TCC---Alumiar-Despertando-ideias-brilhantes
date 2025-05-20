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