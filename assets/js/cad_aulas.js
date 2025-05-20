const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("#aulaForm");
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const data = new FormData(form);

        fetch(baseUrl + "addAulas.php", {
            method: 'POST',
            body: data // Usa o FormData atualizado
        })
        .then(response => {
            return response.json(); // Parse response as JSON
        })
        .then(data => {
            if (data.success) {
                document.getElementById("video").value="";
                document.getElementById("titulo").value = "";
                document.getElementById("descricao").value = "";

                Swal.fire({
                    title: 'Aula adicionada!',
                    text: 'A aula foi adicionada com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                     title: 'Erro!',
                     text: 'Não foi possivel adicionar aula. Tente novamente.',
                     icon: 'error',
                     confirmButtonText: 'Tente novamente'
                 });
            }
        })
        .catch(error => {
            alert("Erro na requisição: " + error.message);
        });
    });
});