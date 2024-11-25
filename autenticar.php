<?php
    session_start(); //inicia ou retoma uma sessão
    if (!$_SESSION ['Logado'] )//procura variavel 
    {
        //se nao estiver logado retorna a tela de login
        header("location:./login/telalogin.html");
    }
?>