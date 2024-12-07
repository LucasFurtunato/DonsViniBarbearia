<?php 

namespace app\controllers;

require_once  dirname( __DIR__ , 1).'/config.php';

$to = "lucasfurtunato11@gmail.com";
$subject = "Olá, apenas um teste de envio de email, não se apavore, provavelmente coloquei o email errado";

$headers = array(
    "MIME-Version" => "1.0",
    "Content-Type" => "text/html;charset=UTF-8"
);

$message = "oi, isso é apenas um teste <a href='google.com.br'> google </a>";

$send = \mail($to, $subject, $message, $headers);

echo ($send ? "Houve algum erro ao enviar" : "Email enviado");
?>