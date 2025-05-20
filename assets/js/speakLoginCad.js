function readForm() {
    const formContent = [
        "Crie uma conta.",
        "Nome: " + document.getElementById("nome").placeholder,
        "Sobrenome: " + document.getElementById("sobrenome").placeholder,
        "Email: " + document.getElementById("emailCadastro").placeholder,
        "Senha: " + document.getElementById("senhaCadastro").placeholder,
        "Data de Nascimento: " + document.getElementById("data_nasc").placeholder
    ];

    const utterance = new SpeechSynthesisUtterance(formContent.join(', '));
    window.speechSynthesis.speak(utterance);
}
function readFormLogin() {
    const formContent = [
        "Entrar.",
        "Email: " + document.getElementById("emailLogin").placeholder,
       
        "Senha: " + document.getElementById("senhaLogin").placeholder,
        
    ];

    const utterance = new SpeechSynthesisUtterance(formContent.join(', '));
    window.speechSynthesis.speak(utterance);
}
function readForm1() {
    const content1 = [
        "Olá!",
        "Insira seus dados pessoais para usar todos os recursos do site."
    ];

    const utterance = new SpeechSynthesisUtterance(content1.join('. '));
    window.speechSynthesis.speak(utterance);
}

function readForm2() {
    const content2 = [
        "Bem vindo!",
        "Registre seus dados pessoais para usar todos os recursos do site."
    ];

    const utterance = new SpeechSynthesisUtterance(content2.join('. '));
    window.speechSynthesis.speak(utterance);
}


