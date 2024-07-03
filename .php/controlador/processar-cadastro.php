<?php
include '../repositorio/conexao.php';
include '../tabelas/cliente.php';

if (($_SERVER["REQUEST_METHOD"] == "POST")) 
    {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $confirmarsenha = $_POST["confirmarsenha"];

        if ($senha === $confirmarsenha) 
            {
                //conexão com o banco de dados;
                $usuario = new cliente($conn);
                //cadastrar o usuário
                if ($usuario->cadastrar($nome, $email, $senha)) 
                    {
                        // Redirecionar para a página de sucesso após o cadastro
                        header("Location: ../../login-cadastro.php");
                        exit();
                    } 
                else 
                    {
                        echo "erro! tente novamente!";
                    }
            }
        else
        {
            header("Location: ../../login-cadastro.php?erro=1");
        }
    }
?>