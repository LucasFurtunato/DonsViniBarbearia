<?php
require_once dirname(__DIR__, 1).'/config.php';

function enviarEmailConfirmacao($email, $nome, $token) {
    try {
        $to = $email;
        $subject = "Comfirme seu Email em Don'Vini Barbearia";
        $headers = array(
            "MIME-Version" => "1.0",
            "Content-Type" => "text/html;charset=UTF-8"
        );
        $link = "https://donsvinibarbearia.hostdeprojetosdoifsp.gru.br/app/views/confirmar_email.html?token=" . urlencode($token);
        $message = "Olá, $nome. <br>
                    Por favor, clique no link abaixo para confirmar seu e-mail:
                    <br>
                    <a href='$link'>$link</a>
                    <br> 
                    Se você não solicitou isso, ignore este e-mail.";
        
        $send = \mail($to, $subject, $message, $headers);
        
        if ($send) {
            return ['status' => true, 'message' => 'Mensagem enviada com sucesso.'];
        } else {
            return ['status' => false, 'message' => 'Mensagem não enviada.'];
        }
    } catch (Exception $e) {
        return ['status' => false, 'message' => "Mail Error: {$send}"];
    }
}

function enviarCodRecuperacaoSenha($email, $nome, $token) {
    try {
        $to = $email;
        $subject = "Codigo de recuperação de senha em Don'Vini Barbearia";
        $headers = array(
            "MIME-Version" => "1.0",
            "Content-Type" => "text/html;charset=UTF-8"
        );
        $message = "Olá,$nome.
                    <br> 
                    Por favor, use o código abaixo para recuperar sua senha:
                    <br><br>
                    $token
                    <br><br>
                    Se você não solicitou isso, ignore este e-mail.";
        
        $send = \mail($to, $subject, $message, $headers);
        
        if ($send) {
            return ['status' => true, 'message' => 'Mensagem enviada com sucesso.'];
        } else {
            return ['status' => false, 'message' => 'Mensagem não enviada.'];
        }
    } catch (Exception $e) {
        return ['status' => false, 'message' => "Mail Error: {$send}"];
    }
}
