<?php
session_start();
require_once 'db.php'; // conexão

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$numero = $_POST['numero'] ?? '';

if (!$nome || !$email || !$senha || !$cpf) {
    header('Location: ../cadastro.html?error=missing_fields');
    exit;
}

// Verifica se email ou cpf já existe
$sqlCheck = "SELECT id FROM usuarios WHERE email = ? OR cpf = ? LIMIT 1";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param('ss', $email, $cpf);
$stmtCheck->execute();
$stmtCheck->store_result();
if ($stmtCheck->num_rows > 0) {
    header('Location: ../cadastro.html?error=already_exists');
    exit;
}

// Insere novo usuário
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$tipo_usuario = 'comum';

$sqlInsert = "INSERT INTO usuarios (nome, email, senha_hash, cpf, telefone, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?)";
$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param('ssssss', $nome, $email, $senha_hash, $cpf, $numero, $tipo_usuario);
$executou = $stmtInsert->execute();

if ($executou) {
    header('Location: ../login.html?success=registered');
} else {
    header('Location: ../cadastro.html?error=fail_insert');
}
exit;
