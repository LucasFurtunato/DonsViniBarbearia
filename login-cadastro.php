<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> <!-- link das imagens do formulário -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> <!-- link das imagens do formulário -->
    <link rel="shortcut icon" type="imagex/png" href="./img/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav>
      <img src="img/logo.png" alt="Don' Vini logo" class="logo">
      <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
      <ul class="nav-list">
        <li><a href="index.php">Início</a></li>
        <li><a href="#" class="login-button">Entrar</a></li>
      </ul>
    </nav>
    <div class="container"> 
        <div class="content first-content"> 
            <div class="first-column">
                <h2 class="title title-primary">Já possui conta?</h2>
                <p class="description description-primary">para acessar sua conta da barbearia</p>
                <p class="description description-primary">faça login com suas informações pessoais</p>
                <button id="signin" class="btn btn-primary">Entrar</button>
            </div> <!-- first-column -->   
            <div class="second-column">
                <h2 class="title title-second">Crie uma conta</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i> <!-- imagem facebook -->         
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="bi bi-google"></i> <!-- imagem google --> 
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i> <!-- imagem linkedin + -->
                            </li>
                        </a>
                    </ul>
                </div><!-- social media -->
                <p class="description description-second">ou use seu e-mail para cadastro</p>
                <form class="form" id="frmCadastro"> <!-- action=".php/controlador/processar-cadastro.php" -->
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i> <!-- imagem usuario -->
                        <input type="text" placeholder="Nome" name="nome" maxlength="50" required>
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i> <!-- imagem email -->
                        <input type="email" placeholder="Email" name="email" maxlength="50" id="email" required>
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i> <!-- imagem senha -->
                        <input type="password" placeholder="Senha" name="senha" maxlength="50" id="password-1" required>
                        <div class="btn-password">
                            <i class="bi bi-eye" id="btn-password-1" onclick="mostrarSenha1()"></i>
                        </div> 
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i> <!-- imagem senha -->
                        <input type="password" placeholder="Confirmar Senha" name="confirmarsenha"  maxlength="50" id="password-2" required> 
                        <div class="btn-password">
                            <i class="bi bi-eye" id="btn-password-2" onclick="mostrarSenha2()"></i>
                        </div> 
                    </label>
                    <label id="cUsrPassInvalid">Senha e confirmar senha não são iguais</label>
                    <label id="cErroInvalid">Houve algum erro ao cadastrar</label>
                    <label id="cUsrPassValid">Cadastrado</label> 
                    <button type="button" class="btn btn-second" id="btnCadastro">Criar</button>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#cUsrPassInvalid").hide();
                            $("#cUsrPassValid").hide();
                            $("#cErroInvalid").hide();

                            $("#btnCadastro").click(function(){
                                console.log("enviar login!");
                                console.log( $("#frmCadastro").serialize() );

                                $.post(".php/controlador/processar-cadastro.php", $("#frmCadastro").serialize(), function( dados ){

                                    var objRetorno = JSON.parse(dados);
                                    
                                    if (objRetorno.cadastro == "false" && objRetorno.erro == "1"){
                                        $("#cUsrPassInvalid").show();
                                        $("#cUsrPassValid").hide();
                                        $("#cErroInvalid").hide();
                                    }else if (objRetorno.cadastro == "false" && objRetorno.erro == "2"){
                                        $("#cUsrPassInvalid").hide();
                                        $("#cUsrPassValid").hide();
                                        $("#cErroInvalid").show();
                                    }
                                    else{
                                        $("#cUsrPassInvalid").hide();
                                        $("#cUsrPassValid").show();
                                        $("#cErroInvalid").hide();
                                    }
                                });
                            });
                        });
                    </script>
                </form>
            </div><!-- second column -->
        </div><!-- first content -->
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, Amigo!</h2>
                <p class="description description-primary">Insira seus dados pessoais para cadastro</p>
                <p class="description description-primary">e inicie a jornada conosco</p>
                <button id="signup" class="btn btn-primary">começar</button>
            </div> <!-- first-column -->
            <div class="second-column">
                <h2 class="title title-second">Login</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="bi bi-google"></i> 
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul>
                </div><!-- social media -->
                <p class="description description-second">ou use sua conta registrada:</p>
                <form class="form" id="frmLogin"> <!-- action=".php/controlador/processar-login.php" -->
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="Email" name="email" maxlength="50" required>
                    </label>
                
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha" name="senha" maxlength="50"  id="password-3" required>
                        <div class="btn-password">
                            <i class="bi bi-eye" id="btn-password-3" onclick="mostrarSenha3()"></i>
                        </div> 
                    </label>
                    <label id="lUsrPassInvalid">Usuário ou senha inválidos</label>
                    <a class="password" href="#">Esqueceu sua senha?</a>
                    <button type="button" class="btn btn-second" id="btnLogin">Entrar</button>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#lUsrPassInvalid").hide();
                            $("#btnLogin").click(function(){
                                $.post(".php/controlador/processar-login.php", $("#frmLogin").serialize(), function( dados ){
                                    var objRetorno = JSON.parse(dados);
                                    if ( objRetorno.login == "false"){
                                        $("#lUsrPassInvalid").show();
                                    }else{
                                        window.location.href = 'index.php';
                                    }
                                });
                            });
                        });
                    </script>
                </form>
            </div><!-- second column -->
        </div><!-- second-content -->
    </div> <!-- div pai -->
    <footer>
    <div class="footer-content">
      <p>&copy; 2024 Barbearias Don' Vini. Todos os direitos reservados.</p>
      <p>Por: RootingTI</p>
    </div>
    </footer> 
    <script src="js/mobile-navbar.js"></script>
    <script src="js/app.js"></script>
</body>
</html>