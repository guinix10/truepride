<?php
// db.php - Conexão com o banco de dados MySQL

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meu_site_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
