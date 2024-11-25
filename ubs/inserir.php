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

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

$sql = "INSERT INTO ubs (ubs_nome, ubs_telefone, ubs_endereco) VALUES ('$nome', '$telefone', '$endereco')";

if ($conn->query($sql) === TRUE) {
    header("Location: http://localhost/sgp/ubs/form.php?status=success");
} else {
    header("Location: http://localhost/sgp/ubs/form.php?status=error");
}

$conn->close();
?>