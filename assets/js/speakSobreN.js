function missao() {
    const formContent = [
        "Nossa Missão:",
        
    ];

    const utterance = new SpeechSynthesisUtterance(formContent.join(', '));
    window.speechSynthesis.speak(utterance);
}
function historia() {
    const formContent = [
        "Nossa História:",
        "Fundado por alunas do IFSP campus araraquara, nosso site foi criado com a visão de quebrar as barreiras digitais para a terceira idade. Desde o início, nosso foco tem sido em desenvolver conteúdos que sejam claros, objetivos e, acima de tudo, adaptados às necessidades dos idosos."
    ];

    const utterance = new SpeechSynthesisUtterance(formContent.join(', '));
    window.speechSynthesis.speak(utterance);
}
function equipe() {
    const formContent = [
        "Nossa Equipe:",
        "Alunas Ana Luiza Fernandes dos Santos, Lara Saquete Carvalho, Ludmyla Oliveira."
       
    ];

    const utterance = new SpeechSynthesisUtterance(formContent.join(', '));
    window.speechSynthesis.speak(utterance);
}