<!DOCTYPE html>
<html lang="pt-br">
<?php include '../repositorio/conexao.php';?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="../../css/recuperar_senha.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        #msgEmailInput{
            color: red;
            font-weight: bold;
            text-align: center;
        }

    </style>
</head>

<body>
    <header>
        <nav>
            <img src="../../img/logo.png" alt="Don' Vini logo" class="logo">
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="index.php">Início</a></li>
                <li><a href="login-cadastro.php" class="login-button">Entrar</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container"> 
            <div class="content first-content"> 
                <div class="second-column">
                    <?php
                    // Verifica se o token foi passado na URL
                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];

                        // Consulta para verificar se o token existe no banco de dados
                        $sql = "SELECT * FROM cliente WHERE TOKEN = '$token' AND EMAIL_VERIFIED = 0";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Token encontrado, agora atualizamos o status de email_verified
                            $sql_update = "UPDATE cliente SET EMAIL_VERIFIED = 1, TOKEN = NULL WHERE TOKEN = '$token'";

                            if ($conn->query($sql_update) === TRUE) {
                                echo "<h2 class='title title-second'>Sua conta foi verificada com sucesso! Agora você pode fazer login.</h2>";
                            } else {
                                echo "<h2 class='title title-second'>Erro ao verificar a conta: " . $conn->error . "</h2>";
                            }
                        } else {
                            // Se o token não for encontrado ou já estiver verificado
                            echo "<h2 class='title title-second'>Token inválido ou conta já verificada.</h2>";
                        }
                    } else {
                        // Se o token não for passado na URL
                        echo "<h2 class='title title-second'>Token não fornecido.</h2>";
                    }
                    ?>
                    <p class="description description-second"></p>
                    <a class="btn btn-second" id="btn-second-1" href="../../login-cadastro.php">Voltar</a>
                </div><!-- second column -->
            </div><!-- first content -->
        </div>
    </main>
    
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Barbearias Don' Vini. Todos os direitos reservados.</p>
            <p>Por: RootingTI</p>
        </div>
    </footer>

    <script src="js/mobile-navbar.js"></script>
    <script src="js/recuperar_senha.js"></script>

</body> 
</html>
