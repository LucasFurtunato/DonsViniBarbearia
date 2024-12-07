<?php 

namespace app\controllers;

require_once  dirname( __DIR__ , 1).'/config.php';

$cliente = new CtrlCliente();

if ($cliente->eviandoEmail()) {
    echo "<br> Sucesso ao enviar email: " . $cliente->eviandoEmail();
} else {
    echo "<br> Erro ao enviar email: " . $cliente->eviandoEmail();
}



?>