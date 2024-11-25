<?php
    $servidor="localhost";
    $usuario="root";
    $senha="";
    $bd="papanico";    
    $conexao = mysqli_connect($servidor,$usuario,$senha) or die("Servidor não encontrado");
    mysqli_select_db($conexao,$bd);

?>