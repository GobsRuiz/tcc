<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Link para o CSS externo -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
</head>
<body class="body">

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

<?php
    include_once("autenticar.php");
?>
    <div class="container">
      <br><br> <center> <h1>SISTEMA DE GESTÃO</h1> </center>
       <br><br>
        
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgba(148,0,211,0.7);"> 
            <div class="container-fluid" >
                    <div class="collapse navbar-collapse" id="navbarNavDropdown" >
                        <ul class="navbar-nav" style="margin: auto!important">
                            <li class="nav-item fs-5">   
                                <a class="nav-link active" href="#">Início</a>
                            </li>
                            <li class="nav-item fs-5">
                                <a class="nav-link" aria-current="page" href="paciente/form.php">Cadastro</a>
                            </li>
                            <li class="nav-item fs-5">
                                <a class="nav-link" href="consultar/consultar.php">Consultar</a>
                            </li>
                            <li class="nav-item fs-5">
                                <a class="nav-link" href="agenda/agenda.php">Agenda</a>
                            </li>
                            <li class="nav-item fs-5">
                                <a class="nav-link" href="pacientes/pacientes.php">Pacientes</a>
                            </li>
                            <li class="nav-item fs-5">
                                <a class="nav-link" href="metas/metas.html">Metas</a>
                            </li>
                            <li class="nav-item dropdown fs-5">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Relatórios
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="#">Gerar relatório</a></li>
                                    <li><a class="dropdown-item" href="#">Imprimir</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown fs-5">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                🔐 Acesso
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="ubs/form.php">Nova UBS</a></li>
                                    <li><a class="dropdown-item" href="usuario/usuario.php">Novo usuário</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown fs-5">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Olá, <?php echo  $_SESSION['User_login'];  ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    
                                    <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
  
    <br>
    <p class="fw-light text-center fs-4"><br><br>A saúde da mulher envolve aspectos físicos, emocionais e sociais, com desafios ao longo da vida. A prevenção, conscientização sobre saúde reprodutiva e acesso a cuidados médicos são essenciais. O exame Papanicolau, recomendado a partir dos 25 anos, é crucial para a prevenção do câncer do colo do útero, especialmente quando combinado com a vacinação contra o HPV.</p>

    <div class="slider">
        <div class="slide"><img src="ubs.png" alt="Imagem 1"></div>
        <div class="slide"><img src="utero2.png" alt="Imagem 2"></div>
        <div class="slide"><img src="examehsp.png" alt="Imagem 3"></div>
        <div class="slide"><img src="lacoroxo1.png" alt="Imagem 4"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.slider').slick({
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 3,
                dots: true,
                arrows: true // Ativa as setas
            });
        });
    </script>
</body>
</html>
