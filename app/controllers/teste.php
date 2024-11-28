<?php
// Incluindo as configurações
require_once dirname(__DIR__, 1).'/config.php';

// Informações do e-mail
$to = 'lucasfurtunato11@gmail.com';
$subject = 'Assunto do e-mail';
$message = 'Corpo do e-mail';
$headers = 'From: meuemail@gmail.com' . "\r\n" .
    'Reply-To: meuemail@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Enviando o e-mail
if(mail($to, $subject, $message, $headers)) {
    echo "E-mail enviado com sucesso!";
} else {
    echo "Falha ao enviar o e-mail.";
}
?>
