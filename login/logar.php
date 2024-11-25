<?php
$username = $_POST ['username'];
$password = $_POST ['password'];

include_once ("../conexao.php");
$sql = mysqli_query ($conexao, "select * from usuario where user_login like '$username' and user_senha like '$password'");
if (mysqli_num_rows($sql)==1)
{
    $resultado = mysqli_fetch_assoc ($sql);
    session_start();// inicia a sessão
    $_SESSION['Logado'] = true;
    $_SESSION['Ubs_id'] = $resultado['ubs_id'];
    $_SESSION['User_login'] = $resultado['user_login'];
    $_SESSION['User_id'] = $resultado['user_id'];
    
   header("location:../index.php");
} 
else{

   header("location:telalogin.html");

}



?>