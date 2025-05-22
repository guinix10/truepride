<?php
$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = trim($_POST['message'] ?? '');

    if (empty($mensagem)) {
        $error = "Por favor, digite uma mensagem.";
    } else {
        $to = "truepride123@gmail.com"; // Altere se necessário
        $subject = "Denúncia anônima - Ferramentas de Suporte";
        $headers = "From: denuncia@truepride.com.br\r\n";
        $body = "Mensagem anônima recebida pelo formulário de suporte:\n\n" . $mensagem;

        if (mail($to, $subject, $body, $headers)) {
            $success = "Mensagem enviada com sucesso! Obrigado por confiar em nós.";
        } else {
            $error = "Erro ao enviar a mensagem. Por favor, tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ferramentas de Suporte</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/suporte.css">
</head>
<body class="page-body pastel-yellow">
  <header>
    <div class="container">
      <img src="../assets/img/logo.png" class="logo" alt="TruePride Logo">
      <nav>
        <ul>
          <li><a href="../index.html#home">Início</a></li>
          <li><a href="recursos.html">Recursos Educacionais</a></li>
          <li><a href="eventos.html">Eventos e Campanhas</a></li>
          <li><a href="suporte.php">Ferramentas de Suporte</a></li>
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
      <h1>Ferramentas de Suporte</h1>

      <div class="support-container">
        <p>Envie uma denúncia de forma anônima diretamente ao nosso administrador.</p>

        <?php if (!empty($success)): ?>
          <p class="success-message"><?= htmlspecialchars($success) ?></p>
        <?php elseif (!empty($error)): ?>
          <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="suporte.php">
          <textarea name="message" placeholder="Digite sua mensagem aqui..." required><?= isset($mensagem) ? htmlspecialchars($mensagem) : '' ?></textarea>
          <button type="submit">Enviar</button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2024‑2025 TruePride. Todos os direitos reservados.</p>
    </div>
  </footer>
</body>
</html>
