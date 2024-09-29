<?php
include '../repositorio/conexao.php';

// Verifica se o token foi passado na URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Consulta para verificar se o token existe no banco de dados
    $sql = "SELECT * FROM cliente WHERE TOKEN = '$token' AND EMAIL_VERIFIED = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Token encontrado, agora atualizamos o status de email_verified
        $sql_update = "UPDATE cliente SET EMAIL_VERIFIED = 1, TOKEN = NULL WHERE TOKEN = '$token'";

        if ($conn->query($sql_update) === TRUE) {
            echo "Sua conta foi verificada com sucesso! Agora você pode fazer login.";
        } else {
            echo "Erro ao verificar a conta: " . $conn->error;
        }
    } else {
        // Se o token não for encontrado ou já estiver verificado
        echo "Token inválido ou conta já verificada.";
    }
} else {
    // Se o token não for passado na URL
    echo "Token não fornecido.";
}