<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" type="imagex/png" href="./img/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                <li class="login-item">
                    <a href="#" class="login-button" id="aCliente"></a>
                    <a href="#" class="login-button" id="aGerente"></a>
                    <a href="#" class="login-button" id="aEntrar">Entrar</a>

                    <div class="login-submenu">
                        <a href="#" id="aAgenda">Agenda</a>
                        <a href="php/controlador/logout.php" id="aSair">Sair</a>
                        <a href="login-cadastro.php" id="aEntrarUsr">Entrar Cliente</a>
                        <a href="login_admin.php" id="aEntrarAdm">Entrar Admin</a>
                    </div>
                </li>
            </ul>
        </nav>
        <script type="text/javascript">
            $(document).ready(function(){
                $.get( 'php/controlador/verificacao-login.php', function(dados) {
                    var objRetorno = JSON.parse(dados)

                    if (objRetorno.usrType == "cliente"){
                        $("#aCliente").text(objRetorno.name);

                        $("#aCliente").show();
                        $("#aGerente").hide();
                        $("#aSair").show();
                        $("#aAgenda").show();
                        $("#aEntrarUsr").hide();
                        $("#aEntrarAdm").hide();
                        $("#aEntrar").hide();
                    } else if (objRetorno.usrType == "gerente"){
                        $("#aGerente").text(objRetorno.name);

                        $("#aCliente").hide();
                        $("#aGerente").show();
                        $("#aSair").show();
                        $("#aAgenda").show();
                        $("#aEntrarUsr").hide();
                        $("#aEntrarAdm").hide();
                        $("#aEntrar").hide();
                    } else {
                        $("#aCliente").hide();
                        $("#aGerente").hide();
                        $("#aSair").hide();
                        $("#aAgenda").hide();
                        $("#aEntrarUsr").show();
                        $("#aEntrarAdm").show();
                        $("#aEntrar").show();
                    }
                });
            });
        </script>
    </header>
    <main>
        <div class="background-container">
            <h1>Don' Vini</h1>
            <h2>Barbearias</h2>
            <a href="#" class="button">Agende já</a>
        </div>

        <section id="about">

            <h2>Quem Somos?</h2>
            <p>Com mais de 6 anos sendo referência em Guarulhos, a barbearia Don' Vini oferece serviços de excelência pelo melhor preço da região. Em qualquer uma de nossas duas unidades, você terá acesso a uma equipe especializada em cortes, desenhos e colorações. Além disso, contamos com planos de assinaturas exclusivos feitos pensando especialmente em você. Aqui é o lugar para cuidar da sua aparência e renovar a autoestima. Clique no botão abaixo para se inscrever no nosso site e acessar todos nossos recursos aqui disponíveis.</p>
            <a href="#" class="button-generic">Inscreva-se</a>

        </section>

        <section id="services">
            
            <h3>Conheça Nossos</h3>
            <h2>Serviços</h2>

            <div class="services-container">

                <div class="card">
                    <div class="card-content">
                        <img src="img/tesoura_e_pente.png" alt="Tesoura">
                        <h3>Cabelo</h3>
                        <div class="line"></div>
                        <p>Fazemos cortes personalizados que atendem o seu pedido e valorizam sua identidade.</p>
                        <div class="hidden-text">
                            <p> Cada corte é pensado para atender às suas exigências, sempre buscando entregar os melhores resultados. Nossos profissionais contam com técnica e criatividade, respeitando seu formato de rosto e estilo para deixar você o mais confiante possível! </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <img src="img/navalha.png" alt="Navalha">
                        <h3>Barba</h3>
                        <div class="line sec-line"></div>
                        <p>Designs precisos e personalizados para uma barba que reflete seu estilo e revela todo seu potencial.</p>
                        <div class="hidden-text">
                            <p> Cada barba é única e, por isso, nossa equipe está preparada para te oferecer uma design personalizado que respeite seu formato de rosto, textura dos fios e, principalmente, suas preferências. O resultado é uma barba bem cuidada e aparada, que combina com você. </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <img src="img/pincel.png" alt="Pincel">
                        <h3>Cuidados</h3>
                        <div class="line"></div>
                        <p>Tratamentos para cabelo e pele para trazer o melhor de você ao garantir um visual impecável.</p>
                        <div class="hidden-text">
                            <p>Além de cortar seu cabelo e barba, nós também oferecemos cuidados que não somente turbinam sua aparência, mas também trazem saúde, hidratação e revitalização tanto para seu cabelo e barba quanto para a sua pele. Aqui usamos produtos de alta qualidade para manter seu visual impecável.</p>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <section id="gallery">

            <h3>Veja Nossa</h3>
            <h2>Galeria</h2>

            <div class="gallery-content">
                <div class="wrapper">
                    <i id="left" class="fa-solid fa-angle-left"></i>
                    <div class="carousel">
                        <img src="img/image1.jpg" alt="" draggable="false">
                        <img src="img/image2.jpg" alt="" draggable="false">
                        <img src="img/image3.jpg" alt="" draggable="false">
                        <img src="img/image4.jpg" alt="" draggable="false">
                        <img src="img/image5.jpg" alt="" draggable="false">
                        <img src="img/image6.jpg" alt="" draggable="false">
                        <img src="img/image7.jpg" alt="" draggable="false">
                        <img src="img/image8.jpg" alt="" draggable="false">
                        <img src="img/image9.jpg" alt="" draggable="false">
                        <img src="img/image10.jpg" alt="" draggable="false">
                        <img src="img/image11.jpg" alt="" draggable="false">
                        <img src="img/image12.jpg" alt="" draggable="false">
                    </div>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </section>

        <div class="striped-line"></div>

        <section id="contact">

            <h3>Fale</h3>
            <h2>Conosco</h2>

            <div class="contact-container">
                <div class="square square1">
                    <img src="img/barber-contact.jpeg" alt="Ilustração de barbeiro">
                </div>
                <div class="square square2">
                    <p id="p-italic">Nos contate</p>
                    <p id="p-top">Nossos Contatos</p>
                    <div class="icons">
                        <i class="fa-solid fa-envelope"></i>
                        <p>barbeariadonvini@hotmail.com</p>
                    </div>
                    <div class="icons">
                        <i class="fa-brands fa-whatsapp"></i>
                        <p>Unidade 1: 11 95863-8784
                        </p>
                    </div>
                    <div class="icons">
                        <i class="fa-brands fa-whatsapp"></i>
                        <p>Unidade 2: 11 95578-2837
                        </p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Unidade 1: R. São Geraldo, 446 - Jardim São Paulo, Guarulhos - SP, 07131-030</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Unidade 2: R. Joana Reche Reche, 12 - 2° piso - Jardim Adriana, Guarulhos - SP, 07135-040</p>
                    </div>
                    <div class="icons-social-media">
                        <a href="https://www.instagram.com/barbeariadonvinioficial/"><i class="fa-brands fa-instagram fa-2x"></i></a>
                        <a href="https://www.facebook.com/barbeariadonvini/"><i class="fa-brands fa-facebook fa-2x"></i></a>
                        <a href="https://www.youtube.com/channel/UCCRfZSrzWOCh8cM1vadsp5A"><i class="fa-brands fa-youtube fa-2x"></i></a>
                    </div>
                </div>
            </div>
        
        </section>

        <section class="map-container">

            <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d915.1359530924985!2d-46.53186845150258!3d-23.44084082425981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef526ca6da8e1%3A0x104d59622a0f2db1!2sBarbearia%20Don%20Vini!5e0!3m2!1spt-BR!2sbr!4v1725307982610!5m2!1spt-BR!2sbr" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p>Unidade 1</p>
            </div>
            <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3078.392184422543!2d-46.52990736558125!3d-23.429933598075035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef5c31c994509%3A0x9222a55a585984ef!2sBarbearia%20Don%20Vini!5e0!3m2!1spt-BR!2sbr!4v1725308078029!5m2!1spt-BR!2sbr" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p>Unidade 2</p>
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
    <script src="js/gallery.js"></script>
</body> 


</html>
