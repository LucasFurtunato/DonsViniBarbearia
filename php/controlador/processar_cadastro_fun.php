<?php
include '../repositorio/conexao.php';
include '../tabelas/funcionario.php';

$codigo = "";
$nome = "";
$email = "";
$fk_unidade = 0;
$senha = "";
$confirmarsenha = "";


$respostaJson = array();

if (isset($_REQUEST['codigo']) && isset($_REQUEST['nome']) && isset($_REQUEST['email']) && isset($_REQUEST['unidade']) && isset($_REQUEST['senha']) && isset($_REQUEST['confirmarsenha'])){
        $codigo = $_REQUEST["codigo"];
        $nome = $_REQUEST["nome"];
        $email = $_REQUEST['email'];
        $fk_unidade = $_REQUEST["unidade"];
        $senha = $_REQUEST["senha"];
        $confirmarsenha = $_REQUEST["confirmarsenha"];

        if ($senha === $confirmarsenha) 
            {
                //conexão com o banco de dados;
                $funcionario = new funcionario($conn);

                //cadastrar o usuário
                if ($funcionario->cadastrarFun($codigo, $nome, $email, $fk_unidade, $senha))
                    {
                        $respostaJson["cadastroFun"]  = "true";
                        $respostaJson["erro"]  = "0";
                        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
                    } 
                else 
                    {
                        $respostaJson["cadastroFun"]  = "false";
                        $respostaJson["erro"]  = "2";
                        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
                    }
            }
        else
        {
            $respostaJson["cadastroFun"]  = "false";
            $respostaJson["erro"]  = "1";
            echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        }
    }
?>