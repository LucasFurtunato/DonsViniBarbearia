<?php
include "../repositorio/conexao.php";
include "verificacao-email.php";

$respostaJson = array();

$token = "";
$senha = "";
$confirmarsenha = "";

if(isset($_REQUEST["token"]) && isset($_REQUEST["senha"]) & isset($_REQUEST["confirmarsenha"])) {
    $token = $_REQUEST["token"];
    $senha = $_REQUEST["senha"];
    $confirmarsenha = $_REQUEST["confirmarsenha"];
    
    $sql ="SELECT * FROM cliente WHERE TOKEN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if ( $senha === $confirmarsenha){
        // Armazenar o senha no banco de dados
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql_update = "UPDATE cliente SET SENHA = ? WHERE TOKEN = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param('ss', $senhaHash, $token);
        $stmt->execute();
        $result = $stmt->get_result();

        $respostaJson["texto"] = "Nova senha cadastrada com sucesso";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        } else {
            $respostaJson["texto"] = "erro 3";
            echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $respostaJson["texto"] = "erro 2";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }
}else {
    $respostaJson["texto"] = "erro 1";
    echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
}