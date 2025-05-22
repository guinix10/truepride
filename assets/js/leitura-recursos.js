document.addEventListener('DOMContentLoaded', () => {
  const fileDisplay = document.getElementById('file-display');
  const uploadForm = document.getElementById('upload-form');

  if (typeof isAdmin !== 'undefined' && isAdmin) {
    uploadForm.style.display = 'block';

    uploadForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(uploadForm);

      const response = await fetch('../php/upload.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.text();
      alert(result);
      uploadForm.reset();
      carregarArquivos();
    });
  }

  function carregarArquivos() {
    fetch('../php/listar_arquivos.php')
      .then(res => res.json())
      .then(arquivos => {
        fileDisplay.innerHTML = '';

        if (arquivos.length === 0) {
          fileDisplay.innerHTML = '<p>Nenhum arquivo disponível no momento.</p>';
          return;
        }

        arquivos.forEach(arquivo => {
          const link = document.createElement('a');
          link.href = `../uploads/${arquivo}`;
          link.textContent = arquivo;
          link.target = '_blank';
          fileDisplay.appendChild(link);
          fileDisplay.appendChild(document.createElement('br'));
        });
      });
  }

  carregarArquivos();
});
