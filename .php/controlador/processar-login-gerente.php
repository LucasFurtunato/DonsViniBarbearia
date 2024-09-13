<?php
require "../repositorio/conexao.php";
require "autenticacao.php";

if ($_SERVER["REQUEST_METHOD"] =="POST"){
    $codigo = $_POST["codigo"];
    $senha = $_POST["senha"];
    
    $login = new autenticacao($conn);
    $gerente = $login->verificarGerente($codigo, $senha);
    if ($gerente){
        session_start();
        $_SESSION["gerente"] = $gerente['NOME'];
        $_SESSION["nomegerente"] = $gerente["NOME"];
        header("Location: ../../index.php");
        exit;
    }else{

        header("Location: ../../login_admin.php?erro=1");
    }
}
?>