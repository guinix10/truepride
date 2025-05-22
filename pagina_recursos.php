<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php'); // Carrega o WordPress

$current_user = wp_get_current_user();
$is_logged_in = is_user_logged_in();
$is_admin = current_user_can('administrator');

// Pasta onde os arquivos ficarão salvos
$upload_dir = __DIR__ . '/uploads/';
$upload_url = dirname($_SERVER['PHP_SELF']) . '/uploads/';

if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Upload (apenas se for admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $is_admin) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $filename = basename($_FILES['file']['name']);
        $target = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
            $message = "✅ Arquivo enviado com sucesso!";
        } else {
            $message = "❌ Erro ao mover o arquivo.";
        }
    } else {
        $message = "❌ Arquivo inválido.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Recursos Enviados</title>
  <style>
    body { font-family: sans-serif; margin: 2rem; background: #f9f9f9; }
    h2, h3 { color: #333; }
    .upload-box, .file-list { background: white; padding: 20px; margin-bottom: 30px; border-radius: 10px; }
    button { padding: 10px 20px; background: #2c3e50; color: #fff; border: none; border-radius: 4px; }
    input[type="file"] { margin-bottom: 10px; }
    a { color: #2980b9; text-decoration: none; }
  </style>
</head>
<body>

<?php if ($is_logged_in): ?>
  <h2>Bem-vindo(a), <?php echo esc_html($current_user->display_name); ?>!</h2>

  <?php if ($is_admin): ?>
  <div class="upload-box">
    <h3>Enviar novo arquivo</h3>
    <?php if (!empty($message)) echo "<p><strong>$message</strong></p>"; ?>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="file" required><br>
      <button type="submit">Enviar</button>
    </form>
  </div>
  <?php endif; ?>

  <div class="file-list">
    <h3>Arquivos disponíveis</h3>
    <?php
      $files = array_diff(scandir($upload_dir), ['.', '..']);
      if (empty($files)) {
        echo "<p>Nenhum arquivo enviado ainda.</p>";
      } else {
        foreach ($files as $file) {
          $url = $upload_url . '/' . rawurlencode($file);
          echo "<p><a href=\"$url\" target=\"_blank\">📄 $file</a></p>";
        }
      }
    ?>
  </div>

<?php else: ?>
  <p>⚠️ Você precisa estar logado para acessar esta página.</p>
<?php endif; ?>

</body>
</html>