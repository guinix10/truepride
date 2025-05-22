document.addEventListener("DOMContentLoaded", function () {
    const usuarioLogado = localStorage.getItem("usuarioLogado");

    // Verifica se o usuário é admin
    if (usuarioLogado !== "admin") {
        // Se não for admin, redireciona para a página inicial
        window.location.href = "index.html";
    } else {
        document.getElementById("content").style.display = "block";

        // Função para o upload de arquivos
        const uploadForm = document.getElementById("uploadForm");

        uploadForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const fileInput = document.getElementById("fileUpload");
            const file = fileInput.files[0];

            if (file) {
                alert("Arquivo enviado com sucesso: " + file.name);
                // Aqui você pode adicionar o código para salvar o arquivo no servidor ou banco de dados
            } else {
                alert("Por favor, selecione um arquivo.");
            }
        });
    }
});
