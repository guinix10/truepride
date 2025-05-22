const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", function (event) {
  event.preventDefault();

  const identificador = document.getElementById("identificador").value;
  const senha = document.getElementById("senha").value;

  // Verifica se é admin
  if (
    identificador === "acessoprivadoadmin@truepride.projeto.com" &&
    senha === "CqAqF10101@"
  ) {
    localStorage.setItem("usuarioLogado", "admin");
    localStorage.setItem("isAdmin", "true");
    window.location.href = "index.html";
    return;
  }

  // Verifica usuários comuns
  const usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];

  const usuario = usuarios.find(
    (user) =>
      (user.email === identificador ||
        user.cpf === identificador ||
        user.numero === identificador) &&
      user.senha === senha
  );

  if (usuario) {
    localStorage.setItem("usuarioLogado", "usuario");
    localStorage.setItem("isAdmin", "false");
    window.location.href = "index.html";
  } else {
    alert("Credenciais incorretas. Verifique seus dados.");
  }
});
