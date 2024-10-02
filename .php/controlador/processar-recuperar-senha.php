<?php
include "../repositorio/conexao.php";
include "verificacao-email.php";

$respostaJson = array();

$token = "";
$email = "";

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