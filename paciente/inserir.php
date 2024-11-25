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
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$sus = $_POST['sus'];
$datanasc = $_POST['datanasc'];
$celular = $_POST['celular'];
$telefone2 = $_POST['telefone2'];
$tel_recados = $_POST['tel_recados'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$ubs_id = $_POST['ubs_id']; // ID da UBS selecionada

// Inserir dados na tabela
$sql = "INSERT INTO pacientes (pac_nome, pac_cpf, pac_sus, pac_datanasc, pac_celular, pac_telefone2, pac_tel_recados, pac_email, pac_endereco, ubs_id, user_id)
        VALUES ('$nome', '$cpf', '$sus', '$datanasc', '$celular', '$telefone2', '$tel_recados', '$email', '$endereco', '$ubs_id', 1)";

if ($conn->query($sql) === TRUE) {
    // Redirecionar com mensagem de sucesso
    header("Location: http://localhost/sgp/paciente/form.php?status=success");
} else {
    // Redirecionar com mensagem de erro
    header("Location: http://localhost/sgp/paciente/form.php?status=error");
}

// Fechar conexão
$conn->close();
?>
