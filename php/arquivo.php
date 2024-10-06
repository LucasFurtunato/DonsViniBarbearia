<?php
echo "callback";
if (isset ($_POST ['sing up'])) {

    if (!empty($_POST ['g-recaptcha-response'])) {
    //continuar o envio 
    $url = "https://www.google.com/recaptcha/api/siteverify ";
    $secret = "6LfPGd4pAAAAAOIgkB0g7UzYeCYUhm_sOA3UID-T";
    $response = $_POST ['g-recaptcha-response'];
    $variaveis = "secret=".$secret."&response=".$response;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $variaveis);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $resposta = curl_exec($ch);
    print_r($resposta);


    }

}

?>