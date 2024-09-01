<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
        <div class="background-container">
            <h1>Don' Vini</h1>
            <h2>Barbearias</h2>
            <a href="#" class="button">Agende já</a>
        </div>

        <section id="about">

            <h2>Quem Somos?</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem ut debitis doloremque provident eaque aspernatur cumque nihil obcaecati tempora excepturi. Magnam labore fuga consectetur eum ducimus quisquam temporibus, dolor harum?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem ut debitis doloremque provident eaque aspernatur cumque nihil obcaecati tempora excepturi. Magnam labore fuga consectetur eum ducimus quisquam temporibus, dolor harum.</p>
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
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit, voluptatibus explicabo deserunt.</p>
                        <div class="hidden-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quidem maxime voluptatum reprehenderit? At aspernatur aut facilis obcaecati nulla sunt modi consequuntur tempore perspiciatis hic placeat, consequatur ea ducimus magnam?</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <img src="img/navalha.png" alt="Navalha">
                        <h3>Barba</h3>
                        <div class="line sec-line"></div>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit, voluptatibus explicabo deserunt.</p>
                        <div class="hidden-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quidem maxime voluptatum reprehenderit? At aspernatur aut facilis obcaecati nulla sunt modi consequuntur tempore perspiciatis hic placeat, consequatur ea ducimus magnam?</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <img src="img/pincel.png" alt="Pincel">
                        <h3>Cuidados</h3>
                        <div class="line"></div>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit, voluptatibus explicabo deserunt.</p>
                        <div class="hidden-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quidem maxime voluptatum reprehenderit? At aspernatur aut facilis obcaecati nulla sunt modi consequuntur tempore perspiciatis hic placeat, consequatur ea ducimus magnam?</p>
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
                        <i class="fa-solid fa-phone-volume"></i>
                        <p>21 0000-0000</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-envelope"></i>
                        <p>teste123@gmail.com</p>
                    </div>
                    <div class="icons">
                        <i class="fa-brands fa-whatsapp"></i>
                        <p>21 0000-0000</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Unidade 1: Rua Avenida Sei Lá Oque, 0000-000</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Unidade 2: Rua Avenida Sei Lá Oque, 0000-000</p>
                    </div>
                    <div class="icons-social-media">
                        <a href=""><i class="fa-brands fa-instagram fa-2x"></i></a>
                        <a href=""><i class="fa-brands fa-facebook fa-2x"></i></a>
                        <a href=""><i class="fa-brands fa-youtube fa-2x"></i></a>
                    </div>
                </div>
            </div>
        
        </section>

        <section class="map-container">

            <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d234337.73703207538!2d-46.557856270466!3d-23.405317633732594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sInstituto%20Federal%20de%20Educa%C3%A7%C3%A3o%2C%20Ci%C3%AAncia%20e%20Tecnologia%20de%20S%C3%A3o%20Paulo!5e0!3m2!1spt-BR!2sbr!4v1716739406273!5m2!1spt-BR!2sbr" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p>Unidade 1</p>
            </div>
            <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d234337.73703207538!2d-46.557856270466!3d-23.405317633732594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sInstituto%20Federal%20de%20Educa%C3%A7%C3%A3o%2C%20Ci%C3%AAncia%20e%20Tecnologia%20de%20S%C3%A3o%20Paulo!5e0!3m2!1spt-BR!2sbr!4v1716739406273!5m2!1spt-BR!2sbr" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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