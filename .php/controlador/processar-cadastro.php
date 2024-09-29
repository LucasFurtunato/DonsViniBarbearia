<?php
include '../repositorio/conexao.php';
include '../tabelas/cliente.php';
include 'verificacao-email.php';

$nome = "";
$email = "";
$senha = "";
$confirmarsenha = "";
$token = "";
$emailVerified = 0;


$respostaJson = array();

if (isset($_REQUEST['nome']) && isset($_REQUEST['email']) && isset($_REQUEST['senha']) && isset($_REQUEST['confirmarsenha'])){
        $nome = $_REQUEST["nome"];
        $email = $_REQUEST['email'];
        $senha = $_REQUEST["senha"];
        $confirmarsenha = $_REQUEST["confirmarsenha"];
        $token = bin2hex(random_bytes(10));

        if ($senha === $confirmarsenha) 
            {
                //conexão com o banco de dados;
                $usuario = new cliente($conn);
                //cadastrar o usuário
                if ($usuario->cadastrar($nome, $email, $senha, $token, $emailVerified))
                    {
                        $respostaJson["cadastro"]  = "true";
                        $respostaJson["erro"]  = "0";
                        $respostaJson["token"] = $token;
                        echo json_encode($respostaJson, JSON_UNESCAPED_UNICODE);
                        enviarEmailConfirmacao($email, $token);
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