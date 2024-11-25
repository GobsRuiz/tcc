<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de UBS</title>
    <link rel="stylesheet" href="./style.css">
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
    <a href="../index.php" class="back-btn">Voltar</a>
    <div class="form-container">

        <!-- Formulário -->
        <form class="formulario" action="inserir.php" method="post">
            <h1>Cadastro de UBS</h1>
            <h2>Preencha com os dados da unidade</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome da UBS</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome da ubs" required>
                </div>  
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telefone">Telefone da Unidade</label>
                    <input type="tel" id="telefone" name="telefone" class="form-control" placeholder="(00) 0000-0000" required>
                </div>
        
            <div class="form-row">
                <div class="form-group">
                    <label for="endereco">Endereço da unidade</label>
                    <textarea id="endereco" name="endereco" class="form-control" placeholder="Digite o endereço"></textarea>
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