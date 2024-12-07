<?php 

namespace app\controllers;

require_once  dirname( __DIR__ , 1).'/config.php';

$cliente = new CtrlCliente();

echo ($cliente->eviandoEmail() ? "Email enviado" : "Houve algum erro ao enviar");
?>