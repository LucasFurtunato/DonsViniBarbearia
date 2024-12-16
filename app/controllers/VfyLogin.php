<?php

require_once  dirname( __DIR__ , 1).'/config.php';

if (isset($_SESSION["cliente"])) {
  $result = [
      'usrType' => 'cliente',
      'name' => $_SESSION["cliente"]['nome'],
      'idCliente' => $_SESSION["cliente"]["clienteId"]
  ];
  
  $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  echo $json;
} else if (isset($_SESSION["gerente"])) {
  $result = [
      'usrType' => 'gerente',
      'name' => $_SESSION["gerente"]["nome"]
  ];
  
  $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  echo $json;
} else if (isset($_SESSION["funcionario"])) {
    $result = [
        'usrType' => 'funcionario',
        'name' => $_SESSION["funcionario"]["nome"]
    ];
    
    $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json;
}else {
    $result = [
        'usrType' => 'deslogado',
        'name' => ''
    ];
    
    $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json;
}