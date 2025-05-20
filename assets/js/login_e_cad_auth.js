
function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Erro',
        text: message,
        confirmButtonText: 'OK'
    });
}

function exibirMensagem(tipo, mensagem) {
    if (tipo === 'sucesso') {
        Swal.fire({
            title: 'Sucesso!',
            text: mensagem,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } else if (tipo === 'erro') {
        Swal.fire({
            title: 'Erro!',
            text: mensagem,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
}


// Função para obter mensagens de erro
function getMessage(x) {
    switch (x) {
        case "erroNome":
            return "O nome deve ter pelo menos dois caracteres";
        case "erroSobrenome":
            return "O sobrenome deve ter pelo menos dois caracteres";
        case "errTamEmail":
            return "O email deve ter pelo menos 3 caracteres";
        case "erroDia":
            return "Dia inválido";
        case "erroMes":
            return "O mês deve estar entre 1 e 12";
        case "errTamSenha":
            return "A senha deve ter mais de 8 caracteres";
        case "errMaiuscula":
            return "A senha deve ter pelo menos uma letra maiúscula";
        case "errMinuscula":
            return "A senha deve ter pelo menos uma letra minúscula";
        case "errDigito":
            return "A senha deve ter pelo menos um dígito";
        case "errEspecial":
            return "A senha deve ter pelo menos um caractere especial (Por exemplo: /, +, -, #, $, @)";
        case "erroFevereiro":
            return "Fevereiro não pode ter mais de 29 dias em ano bissexto";
        case "erroFevereiro2":
            return "Fevereiro não pode ter mais de 28 dias em ano não bissexto";
        case "erroEmail":
            return "Email inválido";
        case "erroAno":
            return "Ano inválido, deve estar entre 1900 e 2024";
        default:
            return "";
    }
}

// Função de validação do nome
function checkNome() {
    let txtNome = document.getElementById("nome").value;
    if (txtNome.length < 2) {
        showError(getMessage("erroNome"));
        return false; // Retorna false se houver erro
    }
    return true; // Retorna true se a validação passar
}

// Função de validação do sobrenome
function checkSobrenome() {
    let txtSobrenome = document.getElementById("sobrenome").value;
    if (txtSobrenome.length < 2) {
        showError(getMessage("erroSobrenome"));
        return false; 
    }
    return true; 
}

// Função de validação do email
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function checkEmail() {
    let email = document.getElementById("emailCadastro").value;
    if (!validateEmail(email)) {
        showError(getMessage("erroEmail"));
        return false; 
    }
    return true; 
}

// Função de validação da senha
function checkSenha() {
    let txtSenha = document.getElementById("senhaCadastro").value;
    if (txtSenha.length < 8) {
        showError(getMessage("errTamSenha"));
        return false; 
    }

    let temMaiuscula = /[A-Z]/.test(txtSenha);
    let temMinuscula = /[a-z]/.test(txtSenha);
    let temDigito = /\d/.test(txtSenha);
    let temEspecial = /[!@#$%^&*(),.?":{}|<>]/.test(txtSenha);

    if (!temMaiuscula) {
        showError(getMessage("errMaiuscula"));
        return false; 
    } 
    if (!temMinuscula) {
        showError(getMessage("errMinuscula"));
        return false; 
    } 
    if (!temDigito) {
        showError(getMessage("errDigito"));
        return false; 
    } 
    if (!temEspecial) {
        showError(getMessage("errEspecial"));
        return false; 
    }
    return true; 
}

// Função de validação da data
function checkData() {
    let data_nasc = document.getElementById("data_nasc").value;
    let ano = parseInt(data_nasc.substring(0, 4));
    let mes = parseInt(data_nasc.substring(5, 7));
    let dia = parseInt(data_nasc.substring(8, 10));

    if (!(dia >= 1 && dia <= 31)) {
        showError(getMessage("erroDia"));
        return false; 
    }
    if (!(mes >= 1 && mes <= 12)) {
        showError(getMessage("erroMes"));
        return false; 
    }
    if (!(ano >= 1900 && ano <= 2024)) {
        showError(getMessage("erroAno"));
        return false; 
    }

    if (mes === 2) {
        if ((ano % 4 === 0 && ano % 100 !== 0) || (ano % 400 === 0)) {
            if (dia > 29) {
                showError(getMessage("erroFevereiro"));
                return false; 
            }
        } else {
            if (dia > 28) {
                showError(getMessage("erroFevereiro2"));
                return false; 
            }
        }
    }
    return true; 
}

// Função de validação do formulário
function checkForm(event) {
    const nomeValido = checkNome();
    const sobrenomeValido = checkSobrenome();
    const emailValido = checkEmail();
    const senhaValida = checkSenha();
    const dataValida = checkData();

    if (!nomeValido || !sobrenomeValido || !emailValido || !senhaValida || !dataValida) {
        event.preventDefault();
        console.error("Validação do formulário falhou.");
        return false;
    }

    console.log("Validação do formulário bem-sucedida.");
    return true;
}


// Adiciona os listeners dos eventos de validação
document.getElementById("btnAdd").addEventListener("submit", checkForm);
document.getElementById("nome").addEventListener("blur", checkNome);
document.getElementById("sobrenome").addEventListener("blur", checkSobrenome);
document.getElementById("emailCadastro").addEventListener("blur", checkEmail);
document.getElementById("senhaCadastro").addEventListener("blur", checkSenha);
document.getElementById("data_nasc").addEventListener("blur", checkData);

