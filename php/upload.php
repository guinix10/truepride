<?php
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
  exit('Acesso negado.');
}

$uploadDir = '../uploads/';
if (!is_dir($uploadDir)) {
  mkdir($uploadDir, 0755, true);
}

if (isset($_FILES['arquivo'])) {
  $nome = basename($_FILES['arquivo']['name']);
  $destino = $uploadDir . $nome;

  if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $destino)) {
    echo "Arquivo enviado com sucesso!";
  } else {
    echo "Falha ao enviar arquivo.";
  }
} else {
  echo "Nenhum arquivo enviado.";
}
