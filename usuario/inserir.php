<?php
// Configuração do banco de dados
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "papanico";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber dados do formulário
$login = $_POST['login'];
$senha = $_POST['senha'];
$ubs_id = $_POST['ubs_id'];

// Inserir dados na tabela
$sql = "INSERT INTO usuario (ubs_id, user_login, user_senha) VALUES ('$ubs_id', '$login', '$senha')";

if ($conn->query($sql) === TRUE) {
    // Redirecionar com mensagem de sucesso
    header("Location: http://localhost/sgp/usuario/usuario.php?status=success");
} else {
    // Redirecionar com mensagem de erro
    header("Location: http://localhost/sgp/usuario/usuario.php?status=error");
}

// Fechar conexão
$conn->close();
?>