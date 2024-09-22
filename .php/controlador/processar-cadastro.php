<?php
include '../repositorio/conexao.php';
include '../tabelas/cliente.php';

$nome = "";
$email = "";
$senha = "";
$confirmarsenha = "";

$respostaJson = array();

if (isset($_REQUEST['nome']) && isset($_REQUEST['email']) && isset($_REQUEST['senha']) && isset($_REQUEST['confirmarsenha'])){
        $nome = $_REQUEST["nome"];
        $email = $_REQUEST['email'];
        $senha = $_REQUEST["senha"];
        $confirmarsenha = $_REQUEST["confirmarsenha"];

        if ($senha === $confirmarsenha) 
            {
                //conexão com o banco de dados;
                $usuario = new cliente($conn);
                //cadastrar o usuário
                if ($usuario->cadastrar($nome, $email, $senha)) 
                    {
                        $respostaJson["cadastro"]  = "true";
                        $respostaJson["erro"]  = "0";
                        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
                    } 
                else 
                    {
                        echo "erro! tente novamente!";
                        $respostaJson["cadastro"]  = "false";
                        $respostaJson["erro"]  = "2";
                        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
                    }
            }
        else
        {
            $respostaJson["cadastro"]  = "false";
            $respostaJson["erro"]  = "1";
            echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
        }
    }
?>