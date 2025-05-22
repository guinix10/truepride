<?php
$dir = '../uploads/';
$arquivos = [];

if (is_dir($dir)) {
  foreach (scandir($dir) as $arquivo) {
    if ($arquivo !== '.' && $arquivo !== '..') {
      $arquivos[] = $arquivo;
    }
  }
}

echo json_encode($arquivos);
