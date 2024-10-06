<?php
include '../repositorio/conexao.php';

session_start();

$respotaJson = array();

if (isset($_SESSION["cliente"])) {
  $cliente = $_SESSION["cliente"];

  $respotaJson["usrType"] = "cliente";
  $respotaJson["name"] = $cliente;
  echo json_encode($respotaJson);

} else if (isset($_SESSION["gerente"])) {
  $gerente = $_SESSION["gerente"];

  $respotaJson["usrType"] = "gerente";
  $respotaJson["name"] = $gerente;
  echo json_encode($respotaJson);

} else {
    $respotaJson["usrType"] = "deslogado";
    echo json_encode($respotaJson);
}