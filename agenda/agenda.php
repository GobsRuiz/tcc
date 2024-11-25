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

// Consulta para obter pacientes cadastrados
$pacientes = $conn->query("SELECT pac_id, pac_nome FROM pacientes");

// Consulta para exibir os agendamentos
$agendamentos = $conn->query("SELECT a.data, a.horario, p.pac_nome FROM agenda a JOIN pacientes p ON a.pac_id = p.pac_id ORDER BY a.data, a.horario");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Exames</title>
    <link rel="stylesheet" href="agenda.css">
</head>
<body>
<button class="botao-voltar" onclick="window.location.href='./../index.php';">Voltar</button>

    <h1>Agenda de Exames</h1>

    <!-- Formulário para agendar exames -->
    <form action="agendar.php" method="post">
        <div>
            <label for="paciente">Selecione o Paciente:</label>
            <select id="paciente" name="pac_id" required>
                <option value="">Escolha um paciente</option>
                <?php while ($row = $pacientes->fetch_assoc()): ?>
                    <option value="<?= $row['pac_id'] ?>"><?= $row['pac_nome'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>
        </div>

        <div>
            <label for="horario">Horário:</label>
            <input type="time" id="horario" name="horario" required>
        </div>

        <button type="submit">Agendar</button>
    </form>

    <!-- Tabela com agendamentos -->
    <h2>Agendamentos</h2>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Paciente</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $agendamentos->fetch_assoc()): ?>
                <tr>
                    <td><?= date("d/m/Y", strtotime($row['data'])) ?></td>
                    <td><?= $row['horario'] ?></td>
                    <td><?= $row['pac_nome'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
