<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "papanico";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_GET['pac_id'])) {
    $pac_id = $_GET['pac_id'];

    // Recupera as informações do paciente
    $sql = "
        SELECT 
            p.*, 
            u.ubs_nome, 
            u.ubs_telefone, 
            u.ubs_endereco
        FROM 
            pacientes p
        LEFT JOIN 
            ubs u 
        ON 
            p.ubs_id = u.ubs_id
        WHERE 
            p.pac_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pac_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o paciente foi encontrado
    if ($result->num_rows > 0) {
        $paciente = $result->fetch_assoc();
    } else {
        die("Paciente não encontrado.");
    }

    $stmt->close();

    // Recuperar os dados do exame, se existirem
    $sql_exame = "
        SELECT * FROM exameMock WHERE pac_id = ?";
    $stmt_exame = $conn->prepare($sql_exame);
    $stmt_exame->bind_param("i", $pac_id);
    $stmt_exame->execute();
    $result_exame = $stmt_exame->get_result();

    if ($result_exame->num_rows > 0) {
        $exame = $result_exame->fetch_assoc();
    } else {
        // Caso não tenha dados no exame, inicializa um array vazio
        $exame = [];
    }

    $stmt_exame->close();

    // Se o formulário foi enviado para editar, atualize os dados
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Atualiza as informações pessoais
        $pac_nome = $_POST['pac_nome'];
        $pac_cpf = $_POST['pac_cpf'];
        $pac_sus = $_POST['pac_sus'];
        $pac_datanasc = $_POST['pac_datanasc'];
        $pac_celular = $_POST['pac_celular'];
        $pac_telefone2 = $_POST['pac_telefone2'];
        $pac_tel_recados = $_POST['pac_tel_recados'];
        $pac_email = $_POST['pac_email'];
        $pac_endereco = $_POST['pac_endereco'];
        $ubs_id = $_POST['ubs_id'];

        // Atualiza no banco de dados a tabela 'pacientes'
        $update_sql = "
            UPDATE pacientes SET 
                pac_nome = ?, 
                pac_cpf = ?, 
                pac_sus = ?, 
                pac_datanasc = ?, 
                pac_celular = ?, 
                pac_telefone2 = ?, 
                pac_tel_recados = ?, 
                pac_email = ?, 
                pac_endereco = ?, 
                ubs_id = ? 
            WHERE pac_id = ?";
        
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssssssssi", $pac_nome, $pac_cpf, $pac_sus, $pac_datanasc, $pac_celular, $pac_telefone2, $pac_tel_recados, $pac_email, $pac_endereco, $ubs_id, $pac_id);
        
        if ($update_stmt->execute()) {
            echo "Informações de cadastro atualizadas com sucesso!";
        } else {
            echo "Erro ao atualizar as informações de cadastro: " . $conn->error;
        }
        $update_stmt->close();

        // Atualiza os dados do exame
        $papanicolau = isset($_POST['papanicolau']) ? $_POST['papanicolau'] : 'Não';
        $diu = isset($_POST['diu']) ? $_POST['diu'] : 'Não';
        $gravida = isset($_POST['gravida']) ? $_POST['gravida'] : 'Não';
        $pilula = isset($_POST['pilula']) ? $_POST['pilula'] : 'Não';
        $hormonio = isset($_POST['hormonio']) ? $_POST['hormonio'] : 'Não';
        $radioterapia = isset($_POST['radioterapia']) ? $_POST['radioterapia'] : 'Não';
        $sangramento = isset($_POST['sangramento']) ? $_POST['sangramento'] : 'Não';
        $sangramento_menopausa = isset($_POST['sangramento-menopausa']) ? $_POST['sangramento-menopausa'] : 'Não';
        $dst = isset($_POST['dst']) ? $_POST['dst'] : 'Não';
        $nao_lembra_menstruacao = isset($_POST['nao-lembra-menstruacao']) ? $_POST['nao-lembra-menstruacao'] : 'Não';

        $data_papanicolau = $_POST['data-papanicolau'] ?? null;
        $ultima_menstruacao = $_POST['ultima-menstruacao'] ?? null;
        $inspecao_colo = $_POST['inspecao-colo'] ?? null;

        // Atualiza ou insere os dados do exame
if ($exame) {
    $update_exame_sql = "
        UPDATE exameMock SET
            fez_papanicolau = ?, data_papanicolau = ?, usa_diu = ?, gravida = ?, usa_pilula = ?, usa_hormonio = ?, 
            fez_radioterapia = ?, data_ultima_menstruacao = ?, nao_lembra_menstruacao = ?, 
            sangramento_relacao = ?, sangramento_menopausa = ?, inspecao_colo = ?, sinais_dst = ? 
        WHERE pac_id = ?";
    
    // Prepara os dados
    $stmt_exame_update = $conn->prepare($update_exame_sql);
    $stmt_exame_update->bind_param(
        "sssssssssssssi", // Corrigido para 14 parâmetros, incluindo o pac_id
        $papanicolau, $data_papanicolau, $diu, $gravida, $pilula, $hormonio, 
        $radioterapia, $ultima_menstruacao, $nao_lembra_menstruacao, 
        $sangramento, $sangramento_menopausa, $inspecao_colo, $dst, $pac_id
    );
    $stmt_exame_update->execute();
    $stmt_exame_update->close();
} else {
    // Insere novos dados do exame
    $insert_exame_sql = "
        INSERT INTO exameMock (
            pac_id, fez_papanicolau, data_papanicolau, usa_diu, gravida, usa_pilula, usa_hormonio, fez_radioterapia,
            data_ultima_menstruacao, nao_lembra_menstruacao, sangramento_relacao, sangramento_menopausa, 
            inspecao_colo, sinais_dst
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepara os dados
    $stmt_exame_insert = $conn->prepare($insert_exame_sql);
    $stmt_exame_insert->bind_param(
        "isssssssssssss", // Corrigido para 14 parâmetros
        $pac_id, $papanicolau, $data_papanicolau, $diu, $gravida, $pilula, $hormonio, 
        $radioterapia, $ultima_menstruacao, $nao_lembra_menstruacao, 
        $sangramento, $sangramento_menopausa, $inspecao_colo, $dst
    );
    $stmt_exame_insert->execute();
    $stmt_exame_insert->close();
}
        header("Location: " . $_SERVER['PHP_SELF'] . "?pac_id=" . $pac_id);
        exit;
    }
} else {
    die("ID do paciente não fornecido.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Exame</title>
    <link rel="stylesheet" href="exameConsulta.css">
</head>
<body>
<!-- Conteúdo da página -->

<div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>
</body> <!-- Fim do corpo da página -->

    <div class="container">
        <a href="../consultar/consultar.php" class="btn-voltar">Voltar</a>
        <h1>Cadastro e Exame</h1>

        <!-- Informações de Cadastro -->
        <div class="section">
            <h2>Informações de Cadastro</h2>
            <form method="POST">
                <ul>
                    <li><strong>Nome:</strong> <input type="text" name="pac_nome" value="<?php echo htmlspecialchars($paciente['pac_nome']); ?>" readonly></li>
                    <li><strong>CPF:</strong> <input type="text" name="pac_cpf" value="<?php echo htmlspecialchars($paciente['pac_cpf']); ?>" readonly></li>
                    <li><strong>SUS:</strong> <input type="text" name="pac_sus" value="<?php echo htmlspecialchars($paciente['pac_sus']); ?>" readonly></li>
                    <li><strong>Data de Nascimento:</strong> <input type="date" name="pac_datanasc" value="<?php echo htmlspecialchars($paciente['pac_datanasc']); ?>" readonly></li>
                    <li><strong>Celular:</strong> <input type="text" name="pac_celular" value="<?php echo htmlspecialchars($paciente['pac_celular']); ?>" readonly></li>
                    <li><strong>Telefone:</strong> <input type="text" name="pac_telefone2" value="<?php echo htmlspecialchars($paciente['pac_telefone2'] ?? ''); ?>" readonly></li>
                    <li><strong>Telefone para Recado:</strong> <input type="text" name="pac_tel_recados" value="<?php echo htmlspecialchars($paciente['pac_tel_recados'] ?? ''); ?>" readonly></li>
                    <li><strong>E-mail:</strong> <input type="email" name="pac_email" value="<?php echo htmlspecialchars($paciente['pac_email'] ?? ''); ?>" readonly></li>
                    <li><strong>Endereço:</strong> <input type="text" name="pac_endereco" value="<?php echo htmlspecialchars($paciente['pac_endereco']); ?>" readonly></li>
                    <li><strong>UBS Selecionada:</strong>
                        <select name="ubs_id" disabled>
                            <option value="<?php echo htmlspecialchars($paciente['ubs_id']); ?>" selected><?php echo htmlspecialchars($paciente['ubs_nome']); ?></option>
                        </select>
                    </li>
                </ul>
        </div>
        <!-- Informações do Exame -->
        <div class="section">
            <h2>Informações do Exame</h2>
            <ul>
                <li><strong>Papanicolau:</strong> 
                    <input type="radio" name="papanicolau" value="Sim" <?php echo (isset($exame['fez_papanicolau']) && $exame['fez_papanicolau'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="papanicolau" value="Não" <?php echo (isset($exame['fez_papanicolau']) && $exame['fez_papanicolau'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Data do Papanicolau:</strong> <input type="date" name="data-papanicolau" value="<?php echo isset($exame['data_papanicolau']) ? htmlspecialchars($exame['data_papanicolau']) : ''; ?>" readonly required></li>
                <li><strong>DIU:</strong> 
                    <input type="radio" name="diu" value="Sim" <?php echo (isset($exame['usa_diu']) && $exame['usa_diu'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="diu" value="Não" <?php echo (isset($exame['usa_diu']) && $exame['usa_diu'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Grávida:</strong> 
                    <input type="radio" name="gravida" value="Sim" <?php echo (isset($exame['gravida']) && $exame['gravida'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="gravida" value="Não" <?php echo (isset($exame['gravida']) && $exame['gravida'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Pílula:</strong> 
                    <input type="radio" name="pilula" value="Sim" <?php echo (isset($exame['usa_pilula']) && $exame['usa_pilula'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="pilula" value="Não" <?php echo (isset($exame['usa_pilula']) && $exame['usa_pilula'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Hormônio:</strong> 
                    <input type="radio" name="hormonio" value="Sim" <?php echo (isset($exame['usa_hormonio']) && $exame['usa_hormonio'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="hormonio" value="Não" <?php echo (isset($exame['usa_hormonio']) && $exame['usa_hormonio'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Radioterapia:</strong> 
                    <input type="radio" name="radioterapia" value="Sim" <?php echo (isset($exame['fez_radioterapia']) && $exame['fez_radioterapia'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="radioterapia" value="Não" <?php echo (isset($exame['fez_radioterapia']) && $exame['fez_radioterapia'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Última Menstruação:</strong> <input type="date" name="ultima-menstruacao" value="<?php echo isset($exame['data_ultima_menstruacao']) ? htmlspecialchars($exame['data_ultima_menstruacao']) : ''; ?>" readonly></li>
                <li><strong>Sangramento:</strong> 
                    <input type="radio" name="sangramento" value="Sim" <?php echo (isset($exame['sangramento_relacao']) && $exame['sangramento_relacao'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="sangramento" value="Não" <?php echo (isset($exame['sangramento_relacao']) && $exame['sangramento_relacao'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Sangramento na Menopausa:</strong> 
                    <input type="radio" name="sangramento-menopausa" value="Sim" <?php echo (isset($exame['sangramento_menopausa']) && $exame['sangramento_menopausa'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="sangramento-menopausa" value="Não" <?php echo (isset($exame['sangramento_menopausa']) && $exame['sangramento_menopausa'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Inspeção do Colo:</strong>
                    <input type="radio" name="inspecao-colo" value="Normal" <?php echo (isset($exame['inspecao_colo']) && $exame['inspecao_colo'] == 'Normal') ? 'checked' : ''; ?> disabled> Normal
                    <input type="radio" name="inspecao-colo" value="Ausente" <?php echo (isset($exame['inspecao_colo']) && $exame['inspecao_colo'] == 'Ausente') ? 'checked' : ''; ?> disabled> Ausente
                    <input type="radio" name="inspecao-colo" value="Alterado" <?php echo (isset($exame['inspecao_colo']) && $exame['inspecao_colo'] == 'Alterado') ? 'checked' : ''; ?> disabled> Alterado
                    <input type="radio" name="inspecao-colo" value="Não visualizado" <?php echo (isset($exame['inspecao_colo']) && $exame['inspecao_colo'] == 'Não visualizado') ? 'checked' : ''; ?> disabled> Não visualizado
                </li>
                <li><strong>DST:</strong> 
                    <input type="radio" name="dst" value="Sim" <?php echo (isset($exame['sinais_dst']) && $exame['sinais_dst'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="dst" value="Não" <?php echo (isset($exame['sinais_dst']) && $exame['sinais_dst'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
                <li><strong>Não lembra última menstruação:</strong> 
                    <input type="radio" name="data-ultima-menstruacao" value="Sim" <?php echo (isset($exame['nao_lembra_menstruacao']) && $exame['nao_lembra_menstruacao'] == 'Sim') ? 'checked' : ''; ?> disabled> Sim
                    <input type="radio" name="data-ultima-menstruacao" value="Não" <?php echo (isset($exame['nao_lembra_menstruacao']) && $exame['nao_lembra_menstruacao'] == 'Não') ? 'checked' : ''; ?> disabled> Não
                </li>
            </ul>
        </div>
    </form>
</div>

</body>
</html>