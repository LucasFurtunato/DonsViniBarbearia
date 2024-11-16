<?php

require_once  dirname( __DIR__ , 1).'/config.php';

if (isset($_SESSION["cliente"])) {
  $cliente = $_SESSION["cliente"];
  
  $result = [
      'usrType' => 'cliente',
      'name' => $cliente
  ];
  
  $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  echo $json;
} else if (isset($_SESSION["gerente"])) {
  $gerente = $_SESSION["gerente"];
  
  $result = [
      'usrType' => 'gerente',
      'name' => $gerente
  ];
  
  $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  echo $json;
} else if (isset($_SESSION["funcionario"])) {
    $funcionario = $_SESSION["funcionario"];
    
    $result = [
        'usrType' => 'funcionario',
        'name' => $funcionario
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