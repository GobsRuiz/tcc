<?php
session_start();

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

// Variável para filtrar pacientes
$searchTerm = "";
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Consulta SQL com filtro
$ubsId = $_SESSION['Ubs_id'];
$sql = "SELECT pac_id, pac_nome FROM pacientes WHERE ubs_id = $ubsId and pac_nome LIKE ?";
$stmt = $conn->prepare($sql);
$searchTermWithWildcard = "%$searchTerm%";
$stmt->bind_param("s", $searchTermWithWildcard);
$stmt->execute();
$result = $stmt->get_result();

// Fechar conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Acompanhamento de Pacientes</title>
  <link rel="stylesheet" href="./pacientes.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <button class="botao-voltar" onclick="window.location.href='./../index.php';">Voltar</button>

    <h1>Acompanhamento de Pacientes</h1>

    <!-- Barra de Pesquisa -->
    <div class="barra-pesquisa">
      <input type="text" id="searchInput" placeholder="Pesquisar paciente...">
    </div>

    <div class="conteudo">
      <div class="secao-lista" id="patientList">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="paciente">
              <div class="informacoes-paciente">
                <p> <?php echo htmlspecialchars($row['pac_nome']); ?></p>
              </div>
              <div class="acoes-paciente">
                <button class="botao-ver" onclick="window.location.href='../examePaciente/examePaciente.php?pac_id=<?php echo $row['pac_id']; ?>'">Ver dados</button>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>Nenhum paciente encontrado.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    // Função de pesquisa em tempo real
    $('#searchInput').on('input', function() {
      var searchTerm = $(this).val();
      $.ajax({
        url: 'pacientes.php',
        type: 'GET',
        data: { search: searchTerm },
        success: function(response) {
          // Atualiza a lista de pacientes com a resposta da pesquisa
          $('#patientList').html($(response).find('#patientList').html());
        }
      });
    });
  </script>
</body>
</html>
