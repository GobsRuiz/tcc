<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "papanico";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$searchTerm = "";
$ubsFilter = [];

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}
if (isset($_GET['ubs'])) {
    $ubsFilter = $_GET['ubs']; 
}

$ubsQuery = "SELECT ubs_id, ubs_nome FROM ubs";
$ubsResult = $conn->query($ubsQuery);

$sql = "SELECT pac_id, pac_nome, ubs_id FROM pacientes WHERE pac_nome LIKE ?";
if (!empty($ubsFilter)) {
    $inQuery = implode(',', array_fill(0, count($ubsFilter), '?'));
    $sql .= " AND ubs_id IN ($inQuery)";
}

$stmt = $conn->prepare($sql);
$searchTermWithWildcard = "%$searchTerm%";
$params = [$searchTermWithWildcard];
foreach ($ubsFilter as $ubs) {
    $params[] = $ubs;
}
$stmt->bind_param(str_repeat("s", count($params)), ...$params);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Cadastros</title>
  <link rel="stylesheet" href="consultar.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<body> <!-- Inicio do corpo da página -->

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
  <button class="botao-voltar" onclick="window.location.href='./../index.php';">Voltar</button>

  <div class="container">
    <h1>Consultar Paciente</h1>

    <div class="barra-pesquisa">
      <input type="text" id="searchInput" placeholder="Pesquisar cadastros...">
    </div>

    <div class="conteudo">
      
      <div class="secao-filtros">
        <h3>Filtrar por UBS</h3>
        <ul>
          <?php if ($ubsResult->num_rows > 0): ?>
            <?php while ($ubs = $ubsResult->fetch_assoc()): ?>
              <li>
                <input type="checkbox" class="ubs-filter" data-ubs="<?php echo $ubs['ubs_id']; ?>" id="ubs<?php echo $ubs['ubs_id']; ?>">
                <label for="ubs<?php echo $ubs['ubs_id']; ?>"><?php echo htmlspecialchars($ubs['ubs_nome']); ?></label>
              </li>
            <?php endwhile; ?>
          <?php else: ?>
            <li>Nenhuma UBS encontrada.</li>
          <?php endif; ?>
        </ul>
      </div>

      <div class="secao-lista" id="patientList">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="item-lista">
            <p><?php echo htmlspecialchars($row['pac_nome']); ?></p>
            <button class="botao-ver" onclick="window.location.href='../exameConsulta/exameConsulta.php?pac_id=<?php echo $row['pac_id']; ?>'">Ver dados</button>
          </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>Nenhum paciente encontrado.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    $('#searchInput').on('input', function() {
      var searchTerm = $(this).val();
      var selectedUbs = [];
      
      $('.ubs-filter:checked').each(function() {
        selectedUbs.push($(this).data('ubs')); 
      });

      $.ajax({
        url: 'consultar.php',
        type: 'GET',
        data: {
          search: searchTerm,
          ubs: selectedUbs
        },
        success: function(response) {
          $('#patientList').html($(response).find('#patientList').html());
        }
      });
    });

    $('.ubs-filter').on('change', function() {
      var searchTerm = $('#searchInput').val();
      var selectedUbs = [];
      
      $('.ubs-filter:checked').each(function() {
        selectedUbs.push($(this).data('ubs')); 
      });

      $.ajax({
        url: 'consultar.php',
        type: 'GET',
        data: {
          search: searchTerm,
          ubs: selectedUbs
        },
        success: function(response) {
          $('#patientList').html($(response).find('#patientList').html());
        }
      });
    });
  </script>
</body>
</html>
