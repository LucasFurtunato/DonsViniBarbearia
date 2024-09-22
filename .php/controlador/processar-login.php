<?php
require "../repositorio/conexao.php";
require "autenticacao.php";

$email = "";
$senha = "";

if(isset($_REQUEST['email']) && isset($_REQUEST['senha'])){  
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    
    $login = new autenticacao($conn);
    $cliente = $login->verificarCliente($email, $senha);
    if ($cliente){
        session_start();
        $_SESSION["cliente"] = $cliente['NOME'];
        $_SESSION["nomecliente"] = $cliente["NOME"];
        header("Location: ../../index.php");
        exit;
    }else{
        $respostaJson["login"]  = "false";
        $respostaJson["msg"]    = "Usuário ou Senha inválidos!";
        $respostaJson["erro"]   = "1";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }
}

$respostaJson = array();


    
    

?>