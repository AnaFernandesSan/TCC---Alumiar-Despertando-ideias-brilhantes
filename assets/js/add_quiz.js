const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

document.addEventListener('DOMContentLoaded', function() { 
    const form = document.querySelector("#quizForm");
    const selectElement = document.getElementById('opcao');
    const fotoDiv = document.querySelector('.mb-3.foto');

    function mostrar() {
        if (selectElement.value === 'imagem') {
            fotoDiv.classList.remove('hidden'); 
        } else {
            fotoDiv.classList.add('hidden'); 
        }
    }

    selectElement.addEventListener('change', mostrar);
    mostrar();
  

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 
        adicionarQuiz();
    });
});


function adicionarQuiz() {
    const form = document.querySelector("#quizForm");
    const data = new FormData(form);

    fetch(baseUrl + "addQuiz.php", {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Limpar campos após adicionar
                form.reset();
                console.log("Cadastro de quiz feito com sucesso!");
                Swal.fire({
                    title: 'Cadastro feito!',
                    text: 'Quiz cadastrado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                
            } else {
                console.log(error);
                Swal.fire({
                    title: 'Erro!',
                    text: 'Por favor, Adicione uma Atividade.',
                    icon: 'error',
                    confirmButtonText: 'Tente novamente'
                });
                setTimeout(() => {
                    window.location.replace("https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/paginas/cadastroAtividade.php");
                }, 2000);
                
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            Swal.fire({
                title: 'Erro!',
                text: 'Por favor, Adicione uma Atividade.',
                icon: 'error',
                confirmButtonText: 'Tente novamente'
            });
            setTimeout(() => {
                window.location.replace("https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/paginas/cadastroAtividade.php");
            }, 2000);
        });
} 

