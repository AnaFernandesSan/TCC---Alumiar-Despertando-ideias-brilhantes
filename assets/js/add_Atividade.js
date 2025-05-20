const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";


document.addEventListener('DOMContentLoaded', function() { 
    const form = document.querySelector("#AtividadeForm");
    form.addEventListener('submit', function(event) {
        event.preventDefault(); 
        adicionarAtividade();
    });
});

function adicionarAtividade() {


    let form = document.querySelector("#AtividadeForm");
    let data = new FormData(form);

    fetch(baseUrl + "addAtividade.php", {
            method: 'POST',
            body: data
        })
        .then(response => response.json()) 
        .then(data => {
           if(data.sucess){
            document.getElementById("tipo").value="";
            document.getElementById("dificuldade").value="";
            exibirMensagem('sucesso', 'Cadastro efetuado com sucesso');
            Swal.fire({
                title: 'Cadastro feito!',
                text: 'Atividade cadastrada com sucesso.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
           }else{
            exibirMensagem('erro', data.message || 'Não foi possível efetuar o cadastro. Tente novamente mais tarde.');
            Swal.fire({
                title: 'Erro!',
                text: 'Por favor, preencha todos os campos.',
                icon: 'error',
                confirmButtonText: 'Tente novamente'
            });
            
           }
        })
        .catch(() => {
            Swal.fire({
                title: 'Cadastro feito!',
                text: 'Atividade cadastrada com sucesso.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
}

