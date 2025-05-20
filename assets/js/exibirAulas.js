const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

document.addEventListener('DOMContentLoaded', function() {
    exibeAulas();
});

function exibeAulas() {
    fetch(baseUrl + "getAll_Video.php")
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data);  // Para depuração

            const aula = document.querySelector('#aula');
            
            // Limpar qualquer conteúdo anterior
            aula.innerHTML = '';

            data.forEach(video => {
                let videoSrc = video.video;

                // Se o link for um link curto do YouTube, converte para formato embed
                if (videoSrc.includes('youtu.be')) {
                    videoSrc = videoSrc.replace('youtu.be/', 'www.youtube.com/embed/');
                }

                // Criar o card para cada vídeo
                const card = document.createElement('div');
                card.classList.add('card');

                // Adiciona o iframe para o YouTube
                const videoEmbed = `
                    <iframe width="560" height="315"  src="${videoSrc}" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen></iframe>
                `;

                // Preencher o card com título, descrição e o vídeo
                card.innerHTML = `
                    <h2 class="card-title">${video.titulo}</h2>
                    <p class="card-text">${video.descricao}</p>
                    <div class="video">
                        ${videoEmbed}
                    </div>
                    
                `;

                // Adiciona o card no contêiner de aulas
                aula.appendChild(card);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar vídeos:", error);
        });
}
