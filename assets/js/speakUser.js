function readUserData() {
    const nome = document.getElementById('nome-info').value;
    const sobrenome = document.getElementById('sobrenome-info').value;
    const dataNascimento = document.getElementById('idade-info').value;
    const email = document.getElementById('email-info').value;

    const mensagem = `Seu nome é ${nome} ${sobrenome}. Sua data de nascimento é ${dataNascimento} e seu e-mail é ${email}.`;

    const utterance = new SpeechSynthesisUtterance(mensagem);
    speechSynthesis.speak(utterance);
}
function readPasswordData() {
    const senhaAntiga = document.getElementById('senha').value;
    const senhaNova = document.getElementById('senhanova').value;

    const mensagem = `A senha antiga é ${senhaAntiga} e a nova senha é ${senhaNova}.`;

    // Função para usar a API de fala
    const utterance = new SpeechSynthesisUtterance(mensagem);
    speechSynthesis.speak(utterance);
}
