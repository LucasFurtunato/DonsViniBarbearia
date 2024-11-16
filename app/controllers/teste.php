<?php

namespace app\controllers;
require_once  dirname( __DIR__ , 1).'/config.php';

$codeG = new CtrlCliente();

// Agora vai retornar o email correto
echo $codeG->getByEmail();
