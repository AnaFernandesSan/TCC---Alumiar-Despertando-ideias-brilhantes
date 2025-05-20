function readMenu() {
    const menuItems = [
        "Início",
        "Materiais",
        "Quiz",
        "Perfil"
    ];
    
    const utterance = new SpeechSynthesisUtterance(menuItems.join(', '));
    window.speechSynthesis.speak(utterance);
}
function readFooter() {
    const footerContent = [
        "Contatos:",
        "Ana Fernandes",
        "Lara Saquete",
        "Ludmyla",
        "Links:",
        "Início",
        "Jogos",
        "Materiais",
        "Suporte",
        "FAQ",
        "Copyright: Todos os direitos reservados 2024."
    ];

    const utterance = new SpeechSynthesisUtterance(footerContent.join(', '));
    window.speechSynthesis.speak(utterance);
}
