<?php
// Incluindo as configurações
require_once dirname(__DIR__, 1).'/config.php';

// Informações do e-mail
$to = 'lucasfurtunato11@gmail.com';
$subject = 'Assunto do e-mail';
$message = 'Corpo do e-mail';
$headers = 'From: lucasfurtunato11@gmail.com' . "\r\n" .
    'Reply-To: lucasfurtunato11@gmail.com';


mail($to, $subject, $message, $headers);

echo "E-mail enviado com sucesso!";

?>
