<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Produtos e Serviços</title>
    <link rel="stylesheet" href="assets/css/style_products.css">
    <link rel="stylesheet" href="assets/css/alterar_produtos_servicos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
            integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    
    <header>
        <nav>
            <img src="assets/img/logo.png" alt="Don' Vini logo" class="logo">
            <div class="mobile-menu" style="z-index: 999;">
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
        <div class="table-container" id="table-container-1">
            <h1 class="heading">Alterar Produtos e Serviços</h1>
            <table class="table">
                <thead>
                    <tr>
                    	<th>Tipo de serviço</th>
                        <th>Serviços</th>
                        <th>Preços</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody id="table-body"> 
					
                </tbody>
            </table>
        </div>
        <hr id="hr">
        <div class="table-container" id="table-container-2">
            <h1 class="heading">Cadastrar Produto</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Nome do Serviço</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody id="table-body"> 
                    <tr>
                        <td data-label="Serviço">
                            <select id="service" name="service">
                                <option value="Corte">Corte</option>
                                <option value="Barba">Barba</option>
                                <option value="Cuidados">Cuidados</option>
                            </select>
                        </td>
                        <td data-label="Nome do Serviço">
                            <input type="text" name="servico" placeholder="Digite o nome do serviço" maxlength="30" id="serviceName" name="serviceName" required>
                        </td>
                        <td data-label="Preço">
                            <input type="number" name="preco" placeholder="Digite o preço" maxlength="8" id="price" name="price" required>
                        </td>   
                    </tr>
                </tbody>
            </table>
            <div class="button-container">
                <button type="submit" id="register-product" class="b-table" >Cadastrar Produto</button> 
            </div>
        </div>
    </main>
    <div class="container" id="first-content" style="display: none">
        <div class="content first-content">
            <div class="second-column">
                <h2 class="title title-second">Confirmar Alteração</h2>
                <p class="description description-second">Tem certeza de que deseja alterar serviço ou preço?</p>
                <form class="form-confirmation">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-second">Alterar</button>
                        <button type="button" class="btn btn-second cancel-btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="second-container" style="display: none">
        <div class="content first-content">
            <div class="second-column">
                <h2 class="title title-second">Confirmar Exclusão</h2>
                <p class="description description-second">Tem certeza de que deseja excluir esse produto?</p>
                <form class="form-confirmation">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-second">Excluir</button>
                        <button type="button" class="btn btn-second cancel-btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="third-container" style="display: none">
        <div class="content first-content">
            <div class="second-column">
                <h2 class="title title-second">Confirmar Produto</h2>
                <p class="description description-second">Tem certeza de que deseja adicionar esse serviço?</p>
                <form class="form-confirmation">
                    <div class="btn-group">
                        <button type="button" class="btn btn-second add-btn">Adicionar</button>
                        <button type="button" class="btn btn-second cancel-btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="fourth-container" style="display:none"> 
        <div class="content first-content"> 
            <div class="second-column">
                <h2 class="title title-second">Confirmar Alteração</h2>
                <p class="description description-second">Insira a senha para conseguir alterar o produto e serviço</p>
                <form class="form">
                    <label class="label-input">
                        <div class="space_icon">
                            <i class="fas fa-lock icon-modify"></i> 
                        </div>
                        <input type="password" placeholder="Senha atual" maxlength="50" id="password-1">
                        <div class="btn-fig">
                            <i class="bi bi-eye" id="btn-password-1"></i>
                        </div>
                    </label>
                    <button class="btn btn-second" id="edit-password-change">Alterar</button>        
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="fifth-container" style="display:none"> 
        <div class="content first-content"> 
            <div class="second-column">
                <h2 class="title title-second">Confirmar Exclusão</h2>
                <p class="description description-second">Insira a senha para conseguir excluir o produto e serviço</p>
                <form class="form">
                    <label class="label-input">
                        <div class="space_icon">
                            <i class="fas fa-lock icon-modify"></i> 
                        </div>
                        <input type="password" placeholder="Senha atual" maxlength="50" id="password-2">
                        <div class="btn-fig">
                            <i class="bi bi-eye" id="btn-password-2"></i>
                        </div>
                    </label>
                    <button class="btn btn-second" id="edit-password-exclusion">Excluir</button>        
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="sixth-container" style="display:none"> 
        <div class="content first-content"> 
            <div class="second-column">
                <h2 class="title title-second">Confirmar Produto</h2>
                <p class="description description-second">Insira a senha para conseguir cadastrar o produto e serviço</p>
                <form class="form" id="form-password">
                    <label class="label-input">
                        <div class="space_icon">
                            <i class="fas fa-lock icon-modify"></i> 
                        </div>
                        <input type="password" placeholder="Senha atual" maxlength="50" id="password-3" name="senha">
                        <div class="btn-fig">
                            <i class="bi bi-eye" id="btn-password-3"></i>
                        </div>
                    </label>
                    <label id="responseArea"></label>
                    <button type="button" class="btn btn-second" id="edit-password-product">Adicionar</button>        
                </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Barbearias Don' Vini. Todos os direitos reservados.</p>
            <p>Por: RootingTI</p>
        </div>
    </footer> 

    <script src="assets/js/mobile-navbar.js"></script>
    <script src="assets/js/alterar_produto_servico.js"></script>
</body>
</html>
