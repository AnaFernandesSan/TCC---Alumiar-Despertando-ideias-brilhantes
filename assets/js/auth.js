(function () {
  async function autenticar() {
    const id = localStorage.getItem("id");
    const token = localStorage.getItem("token");
    const tipo = localStorage.getItem("tipo");

    console.log(`Autenticando usuário. ID: ${id}, Token: ${token}, Tipo: ${tipo}`);

    // Caso não exista um ID ou token, o usuário está deslogado
    if (!id || !token) {
      console.log("Usuário deslogado. Carregando header e conteúdo públicos.");
      await carregarHeaderDeslogado();
      controlarAcesso('deslogado');
      return;
    }

    const data = new FormData();
    data.append("id", id);
    data.append("token", token);
    data.append("tipo", tipo);

    const baseUrl = "https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/ws/";
//const baseUrl = "http://localhost/tcc/ws/";

    fetch(baseUrl + "validateToken.php", {
      method: 'POST',
      body: data
    })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        console.log("Autenticação bem-sucedida!");

        // Verifica se o redirecionamento já ocorreu para evitar loops
        if (tipo === "adm" && !localStorage.getItem("admAlreadyRedirected")) {
          localStorage.setItem("admAlreadyRedirected", "true");
          window.location.replace("https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/paginas/index3.php");
          return;
        }

        if (tipo === "user" && !localStorage.getItem("userAlreadyRedirected")) {
          localStorage.setItem("userAlreadyRedirected", "true");
          window.location.replace("https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/paginas/index2.php");
          return;
        }

        // Verifica a página atual e controla o acesso
        checkpage(tipo);
        controlarAcesso(tipo);
        mostrarConteudo();
      } else {
        console.log("Token inválido. Limpando dados e redirecionando.");
        limparDadosAutenticacao();
        carregarHeaderDeslogado().then(() => {
          controlarAcesso('deslogado');
          redirecionarParaIndex();
        });
      }
    })
    .catch(error => {
      console.log("Erro durante a validação do token:", error);
      limparDadosAutenticacao();
      carregarHeaderDeslogado().then(() => {
        controlarAcesso('deslogado');
        redirecionarParaIndex();
      });
    });
  }

  function limparDadosAutenticacao() {
    // Função para limpar apenas os dados de autenticação
    localStorage.removeItem("id");
    localStorage.removeItem("token");
    localStorage.removeItem("tipo");
    localStorage.removeItem("admAlreadyRedirected");
    localStorage.removeItem("userAlreadyRedirected");
  }

  async function carregarHeader(url) {
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Erro ao carregar o header, status: ${response.status}`);
      }
      const data = await response.text();
      const header = document.getElementById('headerr');

      if (header) {
        header.innerHTML = data;
        console.log("Header carregado com sucesso!");

        const toggle = document.getElementById('menu-icon'); // Botão de alternância
        const nav = document.getElementById('navLinks'); // Menu de navegação móvel

        if (toggle && nav) {
          toggle.addEventListener('click', () => {
            nav.classList.toggle('show-menu');
            toggle.classList.toggle('show-icon');
          });
        } else {
          console.error("Elementos 'toggle' ou 'nav' não encontrados.");
        }

      } else {
        console.error("Elemento 'header' não encontrado no DOM.");
      }
    } catch (error) {
      console.error("Erro ao carregar o header:", error);
    }
  }

  async function carregarHeaderAdmin() {
    await carregarHeader('../includes/headerADM.php');
  }

  async function carregarHeaderUser() {
    await carregarHeader('../includes/header.php');
  }

  async function carregarHeaderDeslogado() {
    await carregarHeader('../includes/headerSemLog.php');
  }

  function controlarAcesso(tipo) {
    const paginaAtual = obterPaginaAtual();
    console.log(`Página atual: ${paginaAtual}`);

    const acessos = {
      deslogado: ['index', 'login_e_cad', 'sobre_nos'],
      usuario: ['index', 'index2','info', 'atividades', 'aulas', 'niveisAtividades', 'perfil', 'sobre_nos', 'quiz_dificil', 'quiz_facil', 'quiz_medio', 'arrastar'],
      admin: ['index','index3','info','cadAdmin' ,'allCads','allList', 'atividades', 'aulas', 'cadastroAtividade', 'cadastroAulas', 'cadastroQuiz', 'cadastroWords', 'listarArrastar', 'listarQuiz', 'listarUsuario', 'listarVideo', 'login_e_cad', 'login_e_cadAdmin', 'niveisAtividade', 'perfil', 'quiz_dificil', 'quiz_facil', 'quiz_medio', 'sobre_nos','arrastar']
    };

    let tipoAcesso = tipo === 'adm' ? 'admin' : tipo === 'user' ? 'usuario' : 'deslogado';
    const paginasPermitidas = acessos[tipoAcesso] || [];

    if (paginasPermitidas.includes(paginaAtual)) {
      mostrarConteudo();  // Exibe o conteúdo para qualquer página permitida
    } else if (tipoAcesso === 'deslogado') {
      redirecionarParaIndex(); // Redireciona deslogados para a página inicial
    } else {
      console.log("Acesso negado. Redirecionando para a página anterior.");
      window.history.back();  // Redireciona para a página anterior
    }
  }    

  function redirecionarParaIndex() {
    const paginaAtual = obterPaginaAtual();

    if (paginaAtual !== 'index') {
      console.log("Redirecionando para index.php...");
      window.location.replace("https://alumiar-gna6hgangvhndke0.brazilsouth-01.azurewebsites.net/tcc/paginas/index.php");
    } else {
      mostrarConteudo(); // Exibe o conteúdo para a página inicial ou pública
    }
  }

 

  function obterPaginaAtual() {
    const path = window.location.pathname;
    return path.substring(path.lastIndexOf('/') + 1).replace('.php', '');
  }

  function checkpage(tipo) {
    console.log("Verificando tipo de usuário:", tipo);

    if (!localStorage.getItem("token")) {
      carregarHeaderDeslogado();
      controlarAcesso('deslogado');
      return;
    }

    if (tipo === "adm") {
      carregarHeaderAdmin();
    } else if (tipo === "user") {
      carregarHeaderUser();
    } else {
      carregarHeaderDeslogado();
    }
  }

  function mostrarConteudo() {
    document.body.style.display = ""; // Exibe o conteúdo da página
  }

  function verificarHeader() {
    const header = document.getElementById('headerr');
    if (!header) {
      console.error("Elemento 'header' NÃO encontrado.");
      return;
    }
  }

  function logout() {
    limparDadosAutenticacao();
    redirecionarParaIndex();
    
  }

  document.addEventListener("DOMContentLoaded", autenticar);
  document.addEventListener("DOMContentLoaded", verificarHeader);
})();
