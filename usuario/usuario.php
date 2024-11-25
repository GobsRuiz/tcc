<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="./usuario.css">
</head>

<body>
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
    <a href="javascript:history.back()" class="back-btn">Voltar</a>
    <div class="form-container">

        <!-- Formulário -->
        <form id="formulario" class="formulario" action="inserir.php" method="post">
            <h1>Cadastro de Usuário</h1>
            <h2>Preencha com os dados do usuário</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="login">Novo usuário</label>
                    <input type="text" id="login" name="login" class="form-control" placeholder="Digite o novo usuário" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="senha">Nova senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite a nova senha" required>
                </div>
            </div>

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

                            $conn->close();
                        ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-finalizar">Finalizar Cadastro</button>
        </form>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
            alert('Cadastro realizado com sucesso!');
            document.getElementById("formulario").reset();  
        } else if (status === 'error') {
            alert('Erro ao realizar o cadastro. Tente novamente!');
        }
    </script>
</body>

</html>