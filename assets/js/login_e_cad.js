const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

const container = document.getElementById('container');
const cadastroBtn = document.getElementById('cadastro');
const loginBtn = document.getElementById('login');
const inputCad = document.querySelector("#senhaCadastro");
const buttonCad = document.querySelector("#olhinhoCadastro");

buttonCad.addEventListener('click', (event) => {
    event.preventDefault();
    if (inputCad.type === "password") {
        inputCad.type = "text";
        buttonCad.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Ícone de olho fechado
    } else {
        inputCad.type = "password";
        buttonCad.innerHTML = '<i class="fas fa-eye"></i>'; // Ícone de olho aberto
    }
});

const input = document.querySelector("#senhaLogin");
const button = document.querySelector("#olhinhoLogin");

button.addEventListener('click', (e) => {
    e.preventDefault();
    if (input.type === "password") {
        input.type = "text";
        button.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Ícone de olho fechado
    } else {
        input.type = "password";
        button.innerHTML = '<i class="fas fa-eye"></i>'; // Ícone de olho aberto
    }
});





cadastroBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

function adicionarUsuario(e) {
    e.preventDefault();
    if (!checkForm(e)) {
        console.error('Validação do formulário falhou.');
        return;
    }

    let dados = document.getElementById("formCadastro");
    let formulario = new FormData(dados);

    fetch(baseUrl + "addUser.php", {
        method: 'POST',
        body: formulario
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log(data.message);
            Swal.fire({
                title: 'Cadastro efetuado com sucesso!',
                text: 'Agora adicione seus dados para entrar.',
                icon: 'success',
                confirmButtonText: 'OK'
            });

            document.getElementById("nome").value = "";
            document.getElementById("sobrenome").value = "";
            document.getElementById("data_nasc").value = "";
            document.getElementById("emailCadastro").value = "";
            document.getElementById("senhaCadastro").value = "";
            document.getElementById("tipo").value = "user";
        } else {
            console.error(data.message); 
            Swal.fire({
                title: 'Erro!',
                text: data.message || 'Não foi possível efetuar o cadastro. Tente novamente mais tarde.',
                icon: 'error',
                confirmButtonText: 'Tente novamente'
            });
        }
    })
    .catch(error => {
        console.error('Erro no fetch:', error);
        Swal.fire({
            title: 'Erro!',
            text: 'Este e-mail já está cadastrado!',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
}




// Função de login
function login(e) {
    e.preventDefault();
    const email = document.getElementById("emailLogin").value;
    const senha = document.getElementById("senhaLogin").value;

    if (!email || !senha) {
        exibirMensagem('erro', 'Email ou senha não podem estar vazios.');
        return;
    }

    const data = { email, senha };

    fetch(baseUrl + "login.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log("Response status:", response.status); // Exibe o status da resposta
        if (!response.ok) {
            throw new Error('Erro na resposta da rede: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log("Resposta do servidor:", data); 
        if (data.success && data.id) {
            localStorage.setItem('id', data.id); 
            localStorage.setItem('token', data.token); 
            localStorage.setItem('tipo', data.tipo);   
            exibirMensagem('sucesso', 'Login efetuado com sucesso');
            document.getElementById("emailLogin").value = "";
            document.getElementById("senhaLogin").value = "";
            window.location.replace("https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/paginas/index2.php");
           
        } else {
            exibirMensagem('erro', 'Email ou senha inválidos.');
        }
    })
    .catch((error) => {
        console.log("Erro no catch:", error);
        exibirMensagem('erro', 'Erro ao efetuar login.');
    });    
}


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("btnAdd").addEventListener("click", adicionarUsuario);
    document.getElementById("btnLogin").addEventListener("click", login);
    
});
