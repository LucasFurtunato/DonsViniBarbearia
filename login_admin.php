</html>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <title>Alterar Perfil</title>
  <link rel="stylesheet" href="css/login_admin.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

  <header>
    <nav>
      <img src="img/logo.png" alt="Don' Vini logo" class="logo">
      <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
      <ul class="nav-list">
        <li><a href="#">Início</a></li>
        <li><a href="#about">Sobre</a></li>
        <li><a href="#services">Serviços</a></li>
        <li><a href="#gallery">Galeria</a></li>
        <li><a href="#contact">Contato</a></li>
        <li><a href="#" class="login-button">Entrar</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="login_admin">
        <div class="container"> 
            <div class="content first-content"> 
                <div class="second-column">
                    <h2 class="title title-second">Login Admin</h2>
                    <p class="description description-second">insira os dados para acessar ao ambiente</p>
                    <form class="form">
                        <label class="label-input" for="">
                            <i class="far fa-user icon-modify"></i> <!-- imagem usuario -->
                            <input type="text" placeholder="Código" maxlength="50">
                        </label>
                        
                        <label class="label-input" for="">
                            <i class="far fa-envelope icon-modify"></i> <!-- imagem email -->
                            <input type="email" placeholder="Email" maxlength="50" id="email">
                        </label>
                        
                        <label class="label-input" for="">
                            <i class="fas fa-lock icon-modify"></i> <!-- imagem senha -->
                            <input type="password" placeholder="Senha" maxlength="50" id="password-1">
                            <div class="btn-password">
                                <i class="bi bi-eye" id="btn-password-1" onclick="mostrarSenha1()"></i>
                            </div>
                        </label>
    
                        <label class="label-input" for="">
                            <i class="fas fa-lock icon-modify"></i> <!-- imagem senha -->
                            <input type="password" placeholder="Confirmar senha" maxlength="50" id="password-2">
                            <div class="btn-password">
                                <i class="bi bi-eye" id="btn-password-2" onclick="mostrarSenha2()"></i>
                            </div> 
                        </label>      
                        <button class="btn btn-second">Entrar</button>        
                    </form>
                </div><!-- second column -->
            </div><!-- first content -->
        </div>
    </section>
  </main>

  <footer>
    <div class="footer-content">
      <p>&copy; 2024 Barbearias Don' Vini. Todos os direitos reservados.</p>
      <p>Por: RootingTI</p>
    </div>
  </footer>

  <script src="js/mobile-navbar.js"></script>
  <script src="js/login_admin.js"></script>

</body>

</html>
