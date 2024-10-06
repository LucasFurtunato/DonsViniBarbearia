<?php
include "../repositorio/conexao.php";
include "verificacao-email.php";

$respostaJson = array();

$token = "";
$email = "";
$senha = "";
$confirmarsenha = "";

if(isset($_REQUEST["email"])) {
    $email = $_REQUEST["email"];
    
    $sql="SELECT * FROM cliente WHERE EMAIL = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result=$stmt->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(5));

        // Armazenar o token no banco de dados
        $sql_update = "UPDATE cliente SET TOKEN = ? WHERE EMAIL = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param('ss', $token, $email);
        $stmt->execute();

        enviarCodRecuperacaoSenha($email, $token);

        $respostaJson["texto"] = "código enviado para seu email";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }
}

if(isset($_REQUEST["token"]) && isset($_REQUEST["senha"]) & isset($_REQUEST["confirmarsenha"])) {
    $email = $_REQUEST["token"];
    $senha = $_REQUEST["senha"];
    $confirmarsenha = $_REQUEST["confirmarsenha"];
    
    $sql="SELECT * FROM cliente WHERE token = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param('s',$token);
    $stmt->execute();
    $result=$stmt->get_result();

    if ($result->num_rows > 0) {
        if ( $senha === $confirmarsenha){
        // Armazenar o senha no banco de dados
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql_update = "UPDATE cliente SET SENHA = ? WHERE TOKEN = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param('ss', $senhaHash, $token);
        $stmt->execute();

        $respostaJson["texto"] = "Nova senha cadastrada com sucesso";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        }
    }
}