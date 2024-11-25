<?php
session_start();
session_unset();//destroi as variaveis
session_destroy();//encerra a sessao
header("location:./login/telalogin.html");
exit;





?>