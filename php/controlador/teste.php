<?php
include "../repositorio/conexao.php";

try {
    $stmt = $pdo->prepare('INSERT INTO funcionario(codigo, nome, email, fk_unidade, senha) VALUES (:co, :na, :em, :fku, :se)');
    $stmt->bindValue(':co', '1334');
    $stmt->bindValue(':na', 'aigd');
    $stmt->bindValue(':em', 'asdfgasd@asjdh.c');
    $stmt->bindValue(':fku', '1');
    $stmt->bindValue(':se', '1223');
    $stmt->execute();
} catch (Exception $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>