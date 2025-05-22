document.addEventListener("DOMContentLoaded", () => {
    const cadastroForm = document.getElementById("cadastroForm");
    const modal = document.getElementById("termsModal");
    const aceitar = document.getElementById("aceitarTermos");
  
    cadastroForm.addEventListener("submit", (event) => {
      event.preventDefault();
  
      const nome = document.getElementById("nome").value;
      const email = document.getElementById("email").value;
      const senha = document.getElementById("senha").value;
      const cpf = document.getElementById("cpf").value;
      const numero = document.getElementById("numero").value;
  
      const usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];
      const jaExiste = usuarios.find((user) => user.email === email);
  
      if (jaExiste || email === "acessoprivadoadmin@truepride.projeto.com") {
        alert("Esse e-mail já está cadastrado.");
        return;
      }
  
      usuarios.push({ nome, email, senha, cpf, numero });
      localStorage.setItem("usuarios", JSON.stringify(usuarios));
  
      modal.classList.remove("hidden");
    });
  
    aceitar.addEventListener("click", () => {
      modal.classList.add("hidden");
      alert("Cadastro realizado com sucesso! Agora você pode fazer login.");
      window.location.href = "login.html";
    });
  });
  