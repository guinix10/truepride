// suporte.js - Envio real via PHP (com fetch)

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('support-form');
  const textarea = document.getElementById('support-message');
  const feedback = document.getElementById('support-feedback');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const mensagem = textarea.value.trim();

    if (mensagem.length === 0) {
      feedback.textContent = 'Por favor, escreva sua mensagem.';
      feedback.className = 'error-message';
      return;
    }

    fetch('../php/suporte.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ message: mensagem })
    })
    .then(response => response.text())
    .then(html => {
      // Substitui o conteúdo do formulário pela resposta do PHP
      document.querySelector('main').innerHTML = html;
    })
    .catch(error => {
      feedback.textContent = 'Erro ao enviar mensagem. Tente novamente.';
      feedback.className = 'error-message';
    });
  });
});
