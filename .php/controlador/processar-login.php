<?php
require "../repositorio/conexao.php";
require "autenticacao.php";

$email = "";
$senha = "";

$respostaJson = array();

if(isset($_REQUEST['email']) && isset($_REQUEST['senha'])){  
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];

    echo "$email, $senha";

    $respostaJson["login"]  = "false";
    $respostaJson["msg"]    = "Usuário ou Senha inválidos!";
    $respostaJson["erro"]   = "1";
    
    echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    
    /*
    $login = new autenticacao($conn);
    $cliente = $login->verificarCliente($email, $senha);
    if ($cliente){
        session_start();
        $_SESSION["cliente"] = $cliente['NOME'];
        $_SESSION["nomecliente"] = $cliente["NOME"];
        header("Location: ../../index.php");
        exit;
    }else{
        session_start();
        $_SESSION["cliente"] = $cliente['NOME'];
        $_SESSION["nomecliente"] = $cliente["NOME"];
        session_destroy();

        $respostaJson["login"]  = "false";
        $respostaJson["msg"]    = "Usuário ou Senha inválidos!";
        $respostaJson["erro"]   = "1";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }*/
}
?>