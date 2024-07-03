<!DOCTYPE html>
<html lang="pt-br">
<?php 
  session_start();
  
  if (isset($_SESSION["cliente"])) {
    $cliente = $_SESSION["cliente"];
}

include '.php/repositorio/conexao.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="COLOCAR ALGUMA DESCRIÇÃO AQUI">
    <meta name="keywords" content="Barbearia, Salão Masculino, Cabelo, Barba, Cuidados Pessoais">
    <link rel="stylesheet" href="css/styles.css">
    <title>Don's Vini - Barbearia </title>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <h1>Don's Vini</h1>
        </div>
        <div class="menu">
            <a href="index.php">Início</a>
            <a href="#content-sobre">Sobre Nós</a>
            <a href="#content-servicos">Serviços</a>
            <a href="#gallery-all">Galeria</a>
            <a href="#contato">Contato</a>
            <?php
            if (isset($_SESSION["cliente"])) 
            { ?>
                <a id="botao" href="#"><?php echo $cliente; ?></a>
                <a id="botao" href=".php/controlador/logout.php">Sair</a>
            <?php } 
            else{ ?>
                <a id="botao" href="login-cadastro.php">Entrar</a>
            <?php } ?>

            
        </div>
    </nav>

    <header class="header-content">

        <section class="call-to-action"> 
            
            <div class="container">
                <h1>Don's Vini</h1>
                <h2>Barbearias</h2>
                <a href="#" class="button">Agende já</a>
              </div>

        </section>

    </header>

    <main id="main-content">

        <section id="content-sobre">

            <div class="sobre-text">
                <h2>Quem Somos?</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus numquam reiciendis necessitatibus earum modi. Quisquam pariatur voluptas quas cum obcaecati laborum consequuntur fugiat quasi tempore iste, nobis neque quia quos.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus numquam reiciendis necessitatibus earum modi. Quisquam pariatur voluptas quas cum obcaecati laborum consequuntur fugiat quasi tempore iste, nobis neque quia quos.</p>
                <a href="#" class="button">Inscreva-se</a>
            </div>

        </section>

        <section id="content-servicos">

                <h3 class="p-above">Conheça Nossos</h3>
                <h2>Serviços</h2>
        
            <div class="servicos">
                <div class="card">
                    <img src="https://picsum.photos/64/64" alt="">
                    <div class="card-text">
                        <h3>SERVIÇO AQUI</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus magnam sint, modi molestiae vitae dolorum! Culpa ullam esse magni impedit quaerat accusantium voluptatum minus, dolorum corrupti! Quo, consequatur eligendi.</p>
                    </div>
                    <div class="texto-oculto">
                        <h3>Outro conteúdo qualquer</h3>
                        <p>Dorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus magnam sint, modi molestiae vitae dolorum! Culpa ullam esse magni impedit quaerat accusantium voluptatum minus, dolorum corrupti! Quo, consequatur eligendi.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/64/64" alt="">
                    <div class="card-text">
                        <h3>SERVIÇO AQUI</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus magnam sint, modi molestiae vitae dolorum! Culpa ullam esse magni impedit quaerat accusantium voluptatum minus, dolorum corrupti! Quo, consequatur eligendi.</p>
                    </div>
                    <div class="texto-oculto">
                        <h3>Outro conteúdo qualquer</h3>
                        <p>Dorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus magnam sint, modi molestiae vitae dolorum! Culpa ullam esse magni impedit quaerat accusantium voluptatum minus, dolorum corrupti! Quo, consequatur eligendi.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://picsum.photos/64/64" alt="">
                    <div class="card-text">
                        <h3>SERVIÇO AQUI</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus magnam sint, modi molestiae vitae dolorum! Culpa ullam esse magni impedit quaerat accusantium voluptatum minus, dolorum corrupti! Quo, consequatur eligendi.</p>
                    </div>
                    <div class="texto-oculto">
                        <h3>Outro conteúdo qualquer</h3>
                        <p>Dorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus magnam sint, modi molestiae vitae dolorum! Culpa ullam esse magni impedit quaerat accusantium voluptatum minus, dolorum corrupti! Quo, consequatur eligendi.</p>
                    </div>
                </div>
            </div>

        </section>

        <section id="gallery-all">
            
            <h3 class="p-above">Veja Nossa</h3>
            <h2>Galeria</h2>
        <div class="">
           <div class="gallery">
            <div class="gallery-container">
                <img class="gallery-item gallery-item-1" src="img/1.jpg" alt="" data-index="1">
                <img class="gallery-item gallery-item-2" src="img/2.jpg" alt="" data-index="2">
                <img class="gallery-item gallery-item-3" src="img/3.jpg" alt="" data-index="3">
                <img class="gallery-item gallery-item-4" src="img/4.jpg" alt="" data-index="4">
                <img class="gallery-item gallery-item-5" src="img/5.jpg" alt="" data-index="5">
            </div>
            <div class="gallery-controls"></div>
           </div>
        </div>   
        </section>

        <div class="striped-line"></div>

        <section id="contato">

            <h3 class="p-above">Fale</h3>
            <h2>Conosco</h2>

            <div class="contato-area">

               <div class="contato-img">
                    <img src="img/barber.jpeg" alt="" class="barbeiro">
               </div>
               <div class="contato-info">
                    <p class="italico">Nos Contate</p>
                    <h4>Nossos Contatos</h4>
                    <div class="small-section">
                        <img src="img/icons8-telefone-50.png" alt="">
                        <p>21 0000-0000</p>
                    </div>
                    <div class="small-section">
                        <img src="img/icons8-email-50.png" alt="">
                        <p>email_teste@gmail.com</p>
                    </div>
                    <div class="small-section">
                        <img src="img/icons8-smartphone-50.png" alt="">
                        <p>11 00000-0000</p>
                    </div>
                    <div class="small-section">
                        <img src="img/icons8-localização-50.png" alt="">
                        <p>Rua NomeRua, 000, Guarulhos, SP. Das 13h às 20h</p>
                    </div>
                    <p class="italico">Nos siga em</p>
                    <div class="redes-sociais">
                        <a href=""><img src="img/icons8-instagram-50.png" alt=""></a>
                        <a href=""><img src="img/icons8-facebook-novo-50.png" alt=""></a>
                        <a href=""><img src="img/icons8-reproduzir-youtube-50.png" alt="" ></a>
                    </div>
               </div>

            </div>
        
        </section>

        <section id="mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d234337.73703207538!2d-46.557856270466!3d-23.405317633732594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sInstituto%20Federal%20de%20Educa%C3%A7%C3%A3o%2C%20Ci%C3%AAncia%20e%20Tecnologia%20de%20S%C3%A3o%20Paulo!5e0!3m2!1spt-BR!2sbr!4v1716739406273!5m2!1spt-BR!2sbr" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Barbearias Don's Vini. Todos os direitos reservados.</p>
            <p>Por: RootingTI</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>