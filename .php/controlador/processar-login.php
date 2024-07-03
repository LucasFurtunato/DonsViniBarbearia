<?php
require "../repositorio/conexao.php";
require "autenticacao.php";

if ($_SERVER["REQUEST_METHOD"] =="POST"){
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    $login = new autenticacao($conn);
    $cliente = $login->verificarCliente($email, $senha);
    if ($cliente){
        session_start();
        $_SESSION["cliente"] = $cliente['NOME'];
        $_SESSION["nomecliente"] = $cliente["NOME"];
        header("Location: ../../index.php");
        exit;
    }else{

        header("Location: ../../login-cadastro.php?erro=1");
    }
}
?>