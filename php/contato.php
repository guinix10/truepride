<?php
// Inicia a sessão para armazenar mensagens flash
session_start();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = trim($_POST['message'] ?? '');

    if (empty($mensagem)) {
        $error = "Por favor, digite uma mensagem.";
    } else {
        $to = "truepride123@gmail.com";
        $subject = "Mensagem do formulário de contato TruePride";
        $headers = "From: no-reply@truepride.com.br\r\n";
        $body = "Mensagem recebida pelo formulário de contato:\n\n" . $mensagem;

        if (mail($to, $subject, $body, $headers)) {
            $success = "Mensagem enviada com sucesso! Obrigado por entrar em contato.";
        } else {
            $error = "Erro ao enviar a mensagem. Por favor, tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Entre em contato</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/contato.css" />
</head>
<body class="page-body pastel-lilac">
  <header>
    <div class="container">
      <img src="../assets/img/logo.png" class="logo" alt="TruePride Logo" />
      <nav>
        <ul>
          <li><a href="../index.html#home">Início</a></li>
          <li><a href="recursos.html">Recursos Educacionais</a></li>
          <li><a href="eventos.html">Eventos e Campanhas</a></li>
          <li><a href="suporte.html">Ferramentas de Suporte</a></li>
          <li><a href="jogos.html">Jogos</a></li>
          <li><a href="sobre.html">Sobre nós</a></li>
          <li><a href="ongs.html">ONGs e Parcerias</a></li>
          <li><a href="contato.php">Entre em contato</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section class="content container">
      <h1>Entre em contato</h1>
      <p>Mande uma mensagem:</p>

      <?php if (!empty($error)) : ?>
          <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
      <?php elseif (!empty($success)) : ?>
          <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
      <?php endif; ?>

      <form action="contato.php" method="post">
        <textarea name="message" placeholder="Digite sua mensagem aqui..." required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
        <button type="submit">Enviar</button>
      </form>

      <p>Ou mande um e-mail diretamente para: truepride123@gmail.com</p>

      <p><br>Temos nossas redes sociais, confira abaixo para receber atualizações sobre as novidades:</br></p>

      <form action="https://www.instagram.com/truep.ride/" target="_blank" rel="noopener">
          <input type="submit" value="Acesso ao Instagram" />
      </form>
      <br><br>
      <form action="https://x.com/TRUEPRIDE10" target="_blank" rel="noopener">
          <input type="submit" value="Acesso ao X" />
      </form>
      <br>
      <form action="https://chat.whatsapp.com/EUQrBZLHNGi9rII90lVFQH" target="_blank" rel="noopener">
          <input type="submit" value="Acesso ao grupo de WhatsApp" />
      </form>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2024‑2025 TruePride.</p>
    </div>
  </footer>

  <script src="../assets/js/contato.js" defer></script>
  <script src="../assets/js/script.js" defer></script>
</body>
</html>
