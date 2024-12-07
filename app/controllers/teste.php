<?php 

namespace app\controllers;

require_once  dirname( __DIR__ , 1).'/config.php';

$to = "lucasfurtunato11@gmail.com";
$subject = "Olá, apenas um teste de envio de email, não se apavore, provavelmente coloquei o email errado";

$headers = array(
    "MIME-Version" => "1.0",
    "Content-Type" => "text/html;charset=UTF-8",
    "From" => "lucasfurtunato11@gmail.com",
    "Reply-To" => "lucasfurtunato11@gmail.com"
);

$message = "oi, isso é apenas um teste";

$send = \mail($to, $subject, $message);

echo ($send ? "Houve algum erro ao enviar" : "Email enviado");
?>