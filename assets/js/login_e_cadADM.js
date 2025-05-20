const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

const container = document.getElementById('container');
const cadastroBtn = document.getElementById('cadastro');

function exibirMensagem(tipo, mensagem) {
    Swal.fire({
        icon: tipo === 'sucesso' ? 'success' : 'error',
        title: tipo === 'sucesso' ? 'Boa!' : 'Ops!',
        text: mensagem,
        confirmButtonColor: tipo === 'sucesso' ? '#4CAF50' : '#F44336'
    });
}


let btn = document.querySelector('.lnr-eye');
btn.addEventListener('click', function() {
    let input = document.querySelector('#senhaCadastro'); // Corrigido o seletor para o campo de senha
    if (input.getAttribute('type') === 'password') {
        input.setAttribute('type', 'text');
    } else {
        input.setAttribute('type', 'password');
    }
});



// Função para adicionar usuário
function adicionarUsuario(e) {
    e.preventDefault();

    let dados = document.getElementById("formCadastro");
    let formulario = new FormData(dados);

    fetch(baseUrl + "addUserADM.php", {
        method: 'POST',
        body: formulario
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("nome").value = "";
            document.getElementById("sobrenome").value = "";
            document.getElementById("data_nasc").value = "";
            document.getElementById("emailCadastro").value = "";
            document.getElementById("senhaCadastro").value = "";
            document.getElementById("tipo").value = "adm";
            
            Swal.fire({
                title: 'Cadastro feito!',
                text: 'Administrado cadastrado com sucesso.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                title: 'Erro!',
                text: 'Não foi possivel efetuar o cadastro.',
                icon: 'error',
                confirmButtonText: 'Tente novamente'
            });
        }
    })
    .catch(() => {
        exibirMensagem('erro', 'Não foi possível efetuar o cadastro. Tente novamente mais tarde.');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("btnAdd").addEventListener("click", adicionarUsuario);
});
