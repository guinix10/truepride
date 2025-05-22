// assets/js/contato.js

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
      const message = form.querySelector('textarea').value;
      if (!message.trim()) {
        alert('Por favor, digite uma mensagem antes de enviar.');
        e.preventDefault(); // Impede o envio do formulário se a mensagem estiver vazia
      }
    });
  });
  