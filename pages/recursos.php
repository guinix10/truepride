<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');

// Redireciona se não estiver logado
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

// Verifica se é administrador
$current_user = wp_get_current_user();
$is_admin = user_can($current_user, 'administrator');

if (!$is_admin) {
    echo "Acesso restrito aos administradores.";
    exit;
}

// Diretório de upload
$upload_dir = __DIR__ . '/uploads/';
$upload_url = 'uploads/';

if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$message = '';

// Upload de arquivos
if (isset($_FILES['upload_file'])) {
    $file = $_FILES['upload_file'];
    $allowed_types = ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'];

    if (in_array($file['type'], $allowed_types)) {
        $filename = basename($file['name']);
        $target = $upload_dir . $filename;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            $message = 'Upload feito com sucesso!';
        } else {
            $message = 'Erro ao fazer upload.';
        }
    } else {
        $message = 'Tipo de arquivo não permitido.';
    }
}

function listarArquivos($dir, $urlBase) {
    $files = array_diff(scandir($dir), ['.', '..']);
    $links = [];

    foreach ($files as $file) {
        $links[] = "<li><a href='{$urlBase}" . rawurlencode($file) . "' target='_blank'>" . htmlspecialchars($file) . "</a></li>";
    }

    return $links;
}

$arquivos = listarArquivos($upload_dir, $upload_url);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Admin - Recursos Educacionais</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/recursos.css">
</head>
<body class="page-body pastel-red">
  <header>
    <div class="container">
      <img src="../assets/img/logo.png" class="logo" alt="TruePride Logo" />
      <nav>
        <ul>
          <li><a href="../admin.html">Painel Admin</a></li>
          <li><a href="recursos.php">Recursos Educacionais</a></li>
          <li><a href="eventos.html">Eventos e Campanhas</a></li>
          <li><a href="suporte.html">Ferramentas de Suporte</a></li>
          <li><a href="jogos.html">Jogos</a></li>
          <li><a href="sobre.html">Sobre nós</a></li>
          <li><a href="ongs.html">ONGs e Parcerias</a></li>
          <li><a href="contato.html">Entre em contato</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section class="content container">
      <h1>Recursos Educacionais (Admin)</h1>

      <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <label for="upload_file">Escolha um arquivo:</label>
        <input type="file" name="upload_file" required>
        <button type="submit">Enviar</button>
      </form>

      <h2>Arquivos disponíveis:</h2>
      <ul>
        <?= implode('', $arquivos) ?>
      </ul>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2024‑2025 TruePride.</p>
    </div>
  </footer>
</body>
</html>