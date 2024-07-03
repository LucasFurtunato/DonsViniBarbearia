<?php
// Inicialize a sessão (se já não estiver inicializada)
session_start();

// Destrua todas as variáveis de sessão
session_unset();

// Destrua a sessão
session_destroy();

// Redirecione o usuário para a página de login ou para onde desejar
header("Location: ../../index.php");
exit;
?>
