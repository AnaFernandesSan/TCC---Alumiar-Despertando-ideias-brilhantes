const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";
function carregaUsuario() {
    fetch(baseUrl + "getAll_usu.php")
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data);  

            const Usuariolist = document.getElementById('usuarios-list');
            
            if (!Usuariolist) {
                console.error("Elemento 'usuarios-list' não encontrado.");
                return;
            }

            Usuariolist.innerHTML = "";
            
            data.forEach(usuario => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${usuario.id}</td>
                    <td>${usuario.nome}</td>
                    <td>${usuario.sobrenome}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.senha}</td>
                    <td>${usuario.data_nasc}</td>
                    <td>${usuario.tipo}</td>
                `;

                Usuariolist.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar usuários:", error);
        });
}

document.addEventListener("DOMContentLoaded", function () {
    carregaUsuario(); 
});