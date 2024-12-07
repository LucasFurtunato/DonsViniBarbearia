<?php
require_once dirname(__DIR__, 1).'/config.php';

function enviarEmailConfirmacao($email, $nome, $token) {
    try {
        $to = $email;
        $subject = "Comfirme seu Email em Don'Vini Barbearia";
        $link = "localhost/donvinibarbearia/public/confirmar_email.html?token=" . urlencode($token);
        $message = "Olá, $nome. Por favor, clique no link abaixo para confirmar seu e-mail:

$link

Se você não solicitou isso, ignore este e-mail.";
        
        $send = \mail($to, $subject, $message);
        
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
        $message = "Olá,$nome. Por favor, use o código abaixo para recuperar sua senha:

$token

Se você não solicitou isso, ignore este e-mail.";
        
        $send = \mail($to, $subject, $message);
        
        if ($send) {
            return ['status' => true, 'message' => 'Mensagem enviada com sucesso.'];
        } else {
            return ['status' => false, 'message' => 'Mensagem não enviada.'];
        }
    } catch (Exception $e) {
        return ['status' => false, 'message' => "Mail Error: {$send}"];
    }
}
