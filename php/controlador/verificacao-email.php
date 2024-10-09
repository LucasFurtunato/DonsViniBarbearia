<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

function enviarEmailConfirmacao($email, $token){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'lucasfurtunato11@gmail.com';                     //SMTP username
        $mail->Password   = 'gbxx kuhh anbt spkp';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('lucasfurtunato11@gmail.com');
        $mail->addAddress($email);                              //Add a recipient
        $mail->addReplyTo('lucasfurtunato11@gmail.com');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Comfirme seu Email';
        $link = "https://donsvinibarbearia.hostdeprojetosdoifsp.gru.br/php/controlador/confirmar-email.php?token=" . urlencode($token);
        $mail->Body    = "Olá,<br><br>Por favor, clique no link abaixo para confirmar seu e-mail:<br><br>
                          <a href='$link'>$link</a><br><br>Se você não solicitou isso, ignore este e-mail.";
        $mail->AltBody = 'Por favor, copie e cole este link no navegador para confirmar seu e-mail: $link';

        $mail->send();
    } catch (Exception $e) {
        
    }
}

function enviarCodRecuperacaoSenha($email, $token){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'lucasfurtunato11@gmail.com';                     //SMTP username
        $mail->Password   = 'gbxx kuhh anbt spkp';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('lucasfurtunato11@gmail.com');
        $mail->addAddress($email);                              //Add a recipient
        $mail->addReplyTo('lucasfurtunato11@gmail.com');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Codigo de recuperação de senha';
        $mail->Body    = "Olá,<br><br>Por favor, use o código abaixo para recuperar sua senha:<br><br>
                          <h2>$token</h2><br><br>Se você não solicitou isso, ignore este e-mail.";
        $mail->AltBody = 'Por favor, copie e cole este link no navegador para recuperar sua senha: $link';

        $mail->send();
    } catch (Exception $e) {
        
    }
}