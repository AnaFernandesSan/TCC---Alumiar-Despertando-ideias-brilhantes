const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

function autenticar(e){
    e.preventDefault();
    document.body.style.display = "none";

    const data = new FormData();

    data.append("id",localStorage.getItem("id"));
    data.append("token",localStorage.getItem("token"));
    tipo = localStorage.getItem("tipo")

    fetch(baseUrl1 + "validateToken.php",{ 
        method:'POST',
        body:data
    })
    .then(response => response.json())
    .then(data => {      
        if(data.success && tipo == 'admin'){
            alert(data.message);
            document.body.style.display = "";
        }else{
            localStorage.clear();
            window.location.href = "/tcc/paginas/login_e_cad.php";
        }
    }).catch(error => {
        console.log(error)
    });
}

document.addEventListener("DOMContentLoaded", autenticar);