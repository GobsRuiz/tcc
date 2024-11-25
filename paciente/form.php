<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link rel="stylesheet" href="paciente.css">
    <script>
        // Exibir alerta com base no status
        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'success') {
                alert('Paciente cadastrado com sucesso!');
                document.querySelector('form').reset(); // Limpar os campos do formulário
            } else if (status === 'error') {
                alert('Erro ao cadastrar o paciente. Tente novamente.');
            }
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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
    <a href="../index.php" class="back-btn">Voltar</a>
    <div class="form-container">
        <!-- Formulário -->
        <form class="formulario" action="inserir.php" method="post">
            <h1>Cadastro de Paciente</h1>
            <h2>Preencha com os dados da paciente</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome da paciente" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="XXX.XXX.XXX-XX" required>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#cpf').mask('000.000.000-00');
                    });
                </script>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="sus">SUS</label>
                    <input type="text" id="sus" name="sus" class="form-control" placeholder="000 0000 0000 0000">
                </div>
                <script>
                    $(document).ready(function() {
                        $('#sus').mask('000 0000 0000 0000');
                    });
                </script>

                <div class="form-group">
                    <label for="datanasc">Data de Nascimento</label>
                    <input type="date" id="datanasc" name="datanasc" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="tel" id="celular" name="celular" class="form-control" placeholder="(00) 00000-0000" required>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#celular').mask('(00) 00000-0000');
                    });
                </script>

                <div class="form-group">
                    <label for="telefone2">Telefone</label>
                    <input type="tel" id="telefone2" name="telefone2" class="form-control" placeholder="(00) 0000-0000" pattern="\(\d{2}\) \d{4}-\d{4}">
                </div>
                <script>
                    $(document).ready(function() {
                        $('#telefone2').mask('(00) 0000-0000');
                    });
                </script>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tel_recados">Telefone para recado</label>
                    <input type="text" id="tel_recados" name="tel_recados" class="form-control" placeholder="(00) 0000-0000" pattern="\(\d{2}\) \d{4}-\d{4}">
                </div>
                <script>
                    $(document).ready(function() {
                        $('#tel_recados').mask('(00) 0000-0000');
                    });
                </script>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <textarea id="endereco" name="endereco" class="form-control" placeholder="Digite seu endereço"></textarea>
                </div>
            </div>

            <!-- Dropdown para selecionar a UBS -->
            <div class="form-row">
                <div class="form-group">
                    <label for="ubs">Selecione a UBS</label>
                    <select id="ubs" name="ubs_id" class="form-control" required>
                        <option value="">Selecione uma UBS</option>
                        <?php
                            // Conexão com o banco de dados
                            $host = "127.0.0.1";
                            $user = "root";
                            $password = "";
                            $dbname = "papanico";

                            $conn = new mysqli($host, $user, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Conexão falhou: " . $conn->connect_error);
                            }

                            // Consulta para buscar as UBS's
                            $result = $conn->query("SELECT * FROM ubs");

                            // Verificar se há resultados
                            if ($result->num_rows > 0) {
                                // Preencher o dropdown com as UBS's
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['ubs_id'] . "'>" . $row['ubs_nome'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhuma UBS encontrada</option>";
                            }

                            // Fechar conexão
                            $conn->close();
                        ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-finalizar">Finalizar Cadastro</button>
        </form>
    </div>
</body>
</html>
