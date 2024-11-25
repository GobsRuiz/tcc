<?php
// Conexão com o banco de dados
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "papanico";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber os dados do formulário
$pac_id = $_POST['pac_id'];
$data = $_POST['data'];
$horario = $_POST['horario'];

// Inserir o agendamento no banco de dados
$sql = "INSERT INTO agenda (pac_id, data, horario) VALUES ('$pac_id', '$data', '$horario')";

if ($conn->query($sql) === TRUE) {
    header("Location: agenda.php?status=success");
} else {
    header("Location: agenda.php?status=error");
}

$conn->close();
?>
