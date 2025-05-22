document.addEventListener("DOMContentLoaded", () => {
  const isAdmin = localStorage.getItem("isAdmin") === "true";
  const uploadInput = document.getElementById("upload-recursos");
  const fileDisplay = document.getElementById("file-display");

  if (!isAdmin) {
    document.getElementById("file-upload-section").style.display = "none";
  }

  let arquivos = JSON.parse(localStorage.getItem("arquivos")) || [];

  function renderArquivos() {
    fileDisplay.innerHTML = "<h2>Arquivos Disponíveis:</h2>";
    if (arquivos.length === 0) {
      fileDisplay.innerHTML += "<p>Nenhum arquivo enviado ainda.</p>";
      return;
    }

    arquivos.forEach(arquivo => {
      const btn = document.createElement("button");
      btn.textContent = arquivo.nome;

      btn.addEventListener("click", () => {
        const tipo = arquivo.url.split(";")[0];

        if (tipo.startsWith("data:application/pdf") || tipo.startsWith("data:image/") || tipo.startsWith("data:text/")) {
          const novaJanela = window.open("", "_blank", "width=800,height=600");
          if (novaJanela) {
            novaJanela.document.write(`
              <html>
                <head><title>${arquivo.nome}</title></head>
                <body style="margin:0">
                  <iframe src="${arquivo.url}" frameborder="0" style="width:100%;height:100vh;"></iframe>
                </body>
              </html>
            `);
          } else {
            alert("O navegador bloqueou o popup. Permita pop-ups para visualizar o arquivo.");
          }
        } else {
          const a = document.createElement("a");
          a.href = arquivo.url;
          a.download = arquivo.nome;
          a.click();
        }
      });

      fileDisplay.appendChild(btn);
    });
  }

  uploadInput.addEventListener("change", function () {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (event) {
      const novoArquivo = {
        nome: file.name,
        url: event.target.result
      };
      arquivos.push(novoArquivo);
      localStorage.setItem("arquivos", JSON.stringify(arquivos));
      renderArquivos();
      uploadInput.value = ""; // limpa o input
    };
    reader.readAsDataURL(file);
  });

  renderArquivos();
});