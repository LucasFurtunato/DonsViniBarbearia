<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Alterar agendamento</title>
    <link rel="stylesheet" href="assets/css/alterar.agendamento.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>

    <header>
        <nav>
            <img src="assets/img/logo.png" alt="Don' Vini logo" class="logo">
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="#">Início</a></li>
                <li><a href="#" class="login-button">Cliente</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="content first-content">
            <div class="first-collumn">

    <div class="agenda">
        <h2 class="title title-second">Alterar serviços</h2>
    </div>
                <ul class="li-1">
                    <h4>CORTES</h4>
                    <li>
                        <button class="btn-2" onclick="1"> Selecione corte</i><i class="bi bi-caret-down-fill"></i></button>
                        <div class="content-to-toggle">
                            <!-- Conteúdo para cortes aqui -->
                            <ul class="itens">
                                <li>Corte low fade</li>                               
                                <li>Corte low fade</li>
                                <li>Corte low fade</li>
                            </ul>
                        </div>
                    </li>
                    <h4>BARBA</h4>
                    <li>
                        <button class="btn-2"> Selecione Barba<i class="bi bi-caret-down-fill"></i></button>
                        <div class="content-to-toggle" style="display: none;">
                            <!-- Conteúdo para barba aqui -->
                            <ul class="itens">
                                <li>Barba quadrada</li>
                                <li>Barba quadrada</li> 
                                <li>Barba quadrada</li>                                                              
                            </ul>
                        </div>
                    </li>
                    <h4>CUIDADOS</h4>
                    <li>
                        <button class="btn-2"> Selecione Cuidados</i><i class="bi bi-caret-down-fill"></i></button>
                        <div class="content-to-toggle" style="display: none;">
                            <!-- Conteúdo para cuidados aqui -->
                            <ul class="itens">
                                <li>Sobrancelha</li>                               
                                <li>Sobrancelha</li>
                                <li>Sobrancelha</li>
                            </ul>
                        </div>
                    </li>
                    <h4>DATA</h4>
                    <li>
                        <button class="btn-2"> Selecione Data</i><i class="bi bi-caret-down-fill"></i></button>
                        <div class="content-to-toggle" style="display: none;">
                            <!-- Conteúdo para data aqui -->
                            <ul class="itens">
                                <li>19/10/24</li>                               
                                <li>19/10/24</li>
                                <li>19/10/24</li>
                            </ul>
                        </div>
                    </li>
                    <h4>HORÁRIO</h4>
                    <li>
                        <button class="btn-2"> Selecione Horário</i><i class="bi bi-caret-down-fill"></i></button>
                        <div class="content-to-toggle" style="display: none;">
                            <!-- Conteúdo para horário aqui -->
                            <ul class="itens">
                                <li>14h</li>                               
                                <li>14h</li>
                                <li>14h</li>
                            </ul>
                        </div>
                    </li>
                    <h4>PROFISSIONAL</h4>
                    <li>
                        <button class="btn-2"> Selecione barbeiro</i><i class="bi bi-caret-down-fill"></i></button>
                        <div class="content-to-toggle" style="display: none;">
                            <!-- Conteúdo para aqui -->
                            <ul class="itens">
                                <li>Vinicius</li>                               
                                <li>Vinicius</li>
                                <li>Vinicius</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="second-collumn">
                <h2>PREÇO</h2>
                <span id="price">R$ 00,00</span>
                <button class="btn btn-second">Confimar</button>
            </div>
        </div>
    </div>


    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Barbearias Don' Vini. Todos os direitos reservados.</p>
            <p>Por: RootingTI</p>
        </div>
    </footer>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/mobile-navbar.js">
    </script>
    <script src="assets/js/agendamento.js"></script>
</body>


</html>