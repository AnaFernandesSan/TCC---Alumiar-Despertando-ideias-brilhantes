const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

document.getElementById('wordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = document.querySelector("#wordForm");
    const formData = new FormData(form);

    fetch(baseUrl + "addWords.php", {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        return response.text();  // Recebe a resposta como texto
    })
    .then(text => {
        console.log("Resposta completa do servidor:", text);  // Mostra a resposta no console
        try {
            // Verifica se a resposta contém algo inesperado (como uma página HTML)
            if (text.includes('<html>') || text.includes('<br>')) {
                throw new Error('Resposta inesperada do servidor. Pode ser uma página de erro.');
            }

            const data = JSON.parse(text); // Tenta converter a resposta para JSON
            if (data.success) {
                form.reset();
                Swal.fire({
                    title: 'Cadastro feito!',
                    text: 'Palavra cadastrada com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

            } else {
               
                Swal.fire({
                    title: 'Erro!',
                    text: 'Por favor, Preencha todos os campos.',
                    icon: 'error',
                    confirmButtonText: 'Tente novamente'
                });
            }
        } catch (error) {
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
        console.error('Erro:', error);  // Mostra outros erros, como problemas de rede
        alert('Erro ao enviar a solicitação. Verifique o console para mais detalhes.');
    });
});
