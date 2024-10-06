<?php
require "../repositorio/conexao.php";
require "autenticacao.php";

$codigo = "";
$email = "";
$senha = "";
$confirmarsenha = "";

$respostaJson = array();

if (isset($_REQUEST['codigo']) && isset($_REQUEST['email']) && isset($_REQUEST['senha']) && isset($_REQUEST['confirmarsenha'])){
    $codigo = $_REQUEST["codigo"];
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];
    $confirmarsenha = $_REQUEST["confirmarsenha"];
    
    $login = new autenticacao($conn);
    $gerente = $login->verificarGerente($codigo, $email, $senha, $confirmarsenha);
    if ($gerente){
        session_start();
        $_SESSION["gerente"] = $gerente['NOME'];
        $_SESSION["nomegerente"] = $gerente["NOME"];
        
        $respostaJson["login"]  = "true";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }else{
        $respostaJson["login"]  = "false";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }
}
?>