<?php
include "../repositorio/conexao.php";
include "../tabelas/funcionario.php";

$codigoatual = "";
$codigo = "";
$nome = "";
$email = "";
$unidade = "";
$senha = "";
$confirmarsenha = "";

$respostaJson = array();

if (isset($_REQUEST["codigoatual"]) && isset($_REQUEST["codigo"]) && isset($_REQUEST["nome"]) && isset($_REQUEST["email"]) && isset($_REQUEST["unidade"]) && isset($_REQUEST["senha"]) && isset($_REQUEST["confirmarsenha"])){
    $codigoatual    = $_REQUEST["codigoatual"];
    $codigo         = $_REQUEST["codigo"];
    $nome           = $_REQUEST["nome"];
    $email          = $_REQUEST["email"];
    $unidade        = $_REQUEST["unidade"];
    $senha          = $_REQUEST["senha"];
    $confirmarsenha = $_REQUEST["confirmarsenha"];

    if ($senha === $confirmarsenha) {
        $sql = "SELECT * FROM funcionario WHERE codigo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $codigoatual);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            // Trocar os dados no banco de dados
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql_update = "UPDATE funcionario SET codigo = ?, nome = ?, email = ?, fk_unidade = ?, senha = ? WHERE codigo = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param('sssiss', $codigo, $nome, $email, $unidade, $senhaHash, $codigoatual);
            $stmt->execute();

            $respostaJson["texto"] = "Modificação feita com sucesso";
            $respostaJson["erro"] = "0";
            echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        } else {
            $respostaJson["texto"] = "Este código não está registrado";
            $respostaJson["erro"] = "2";
            echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $respostaJson["texto"] = "Senha e confirma senha errados";
        $respostaJson["erro"] = "1";
        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
    }
}
?>
