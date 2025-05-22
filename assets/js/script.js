document.addEventListener("DOMContentLoaded", function () {
  const usuarioLogado = localStorage.getItem("usuarioLogado");

  if (!usuarioLogado) {
      // Redireciona para a página de login se o usuário não estiver logado
      window.location.href = "login.html";
  } else {
      if (usuarioLogado === "admin") {
          // Se for admin, redireciona para a página admin
          window.location.href = "admin.html";
      } else {
          // Se for usuário comum, mostra o conteúdo normal
          document.getElementById("content").style.display = "block";
      }
  }
});

  