<?php
$token = bin2hex(random_bytes(50));
$link = "localhost/dvinibarbearia/confirmar-email.php?token=" . $token;
echo "Olá,<br><br>Por favor, clique no link abaixo para confirmar seu e-mail:<br><br>
    <a href='$link'>$link</a><br><br>Se você não solicitou isso, ignore este e-mail.";