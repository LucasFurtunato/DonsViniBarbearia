<?php
$servername = "144.217.39.54";
$username = "donvinibarbearia";
$password = "barbearia2024";
$databasename = "ifhostgru_donvinibarbearia";

//criação da conexão
$conn = new mysqli($servername, $username, $password, $databasename);

// verificando a conexão
if (!$conn){
    //die("conexão falhou".mysqli_connect_error());
    echo "não foi possível conectar ao banco de dados";
}
?>
