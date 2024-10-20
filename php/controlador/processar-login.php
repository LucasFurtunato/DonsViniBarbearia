<?php
require "../repositorio/conexao.php";
require "autenticacao.php";

$email = "";
$senha = "";

$respostaJson = array();

if(isset($_REQUEST['email']) && isset($_REQUEST['senha'])){  
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    
    $login = new autenticacao($conn);
    $cliente = $login->verificarCliente($email, $senha);
    if ($cliente){
        session_start();
        $_SESSION["cliente"] = $cliente['nome'];
        $_SESSION["nomecliente"] = $cliente["nome"];

        $respostaJson["login"]  = "true";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        
    }else{
        $respostaJson["login"]  = "false";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }
}
?>