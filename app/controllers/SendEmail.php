<?php
require_once dirname(__DIR__, 1).'/config.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function enviarEmailConfirmacao($email, $nome, $token) {
    $smtpConfig = $_SESSION['smtp'];
    
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $smtpConfig['host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $smtpConfig['username'];                     //SMTP username
        $mail->Password   = $smtpConfig['password'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $smtpConfig['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        // Desabilitar a exibição de debug (defina como 0)
        $mail->SMTPDebug = 0;  // Desativa o log detalhado
        
        //Recipients
        $mail->setFrom('suportedonvinibarbearia@gmail.com', "Suporte  Don'Vini Barbearia");
        $mail->addAddress($email, $nome);
        $mail->addReplyTo('suportedonvinibarbearia@gmail.com', "Suporte Don'Vini Barbearia");
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Comfirme seu Email em Don'Vini Barbearia";
        $link = "localhost/donvinibarbearia/public/confirmar_email.html?token=" . urlencode($token);
        $mail->Body    = "Olá,<br><br>Por favor, clique no link abaixo para confirmar seu e-mail:<br><br>
                          <a href='$link'>$link</a><br><br>Se você não solicitou isso, ignore este e-mail.";
        
        if ($mail->send()) {
            return ['status' => true, 'message' => 'Mensagem enviada com sucesso.'];
        } else {
            return ['status' => false, 'message' => 'Mensagem não enviada.'];
        }
    } catch (Exception $e) {
        return ['status' => false, 'message' => "Mailer Error: {$mail->ErrorInfo}"];
    }
}

function enviarCodRecuperacaoSenha($email, $nome, $token) {
    $smtpConfig = $_SESSION['smtp'];
    
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $smtpConfig['host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $smtpConfig['username'];                     //SMTP username
        $mail->Password   = $smtpConfig['password'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $smtpConfig['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        // Desabilitar a exibição de debug (defina como 0)
        $mail->SMTPDebug = 0;  // Desativa o log detalhado
        
        //Recipients
        $mail->setFrom('suportedonvinibarbearia@gmail.com', "Suporte  Don'Vini Barbearia");
        $mail->addAddress($email, $nome);
        $mail->addReplyTo('suportedonvinibarbearia@gmail.com', "Suporte Don'Vini Barbearia");
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Codigo de recuperação de senha";
        $mail->Body    = "Olá,<br><br>Por favor, use o código abaixo para recuperar sua senha:<br><br>
                          <h2>$token</h2><br><br>Se você não solicitou isso, ignore este e-mail.";
        
        if ($mail->send()) {
            return ['status' => true, 'message' => 'Mensagem enviada com sucesso.'];
        } else {
            return ['status' => false, 'message' => 'Mensagem não enviada.'];
        }
    } catch (Exception $e) {
        return ['status' => false, 'message' => "Mailer Error: {$mail->ErrorInfo}"];
    }
}
