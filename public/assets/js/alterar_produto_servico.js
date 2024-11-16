// Função para alternar visibilidade da senha no campo 1
$('#btn-password-1').click(function() {
    let inputPass = $('#password-1');
    let btnPass = $('#btn-password-1');
  
    if (inputPass.attr('type') === 'password') {
        inputPass.attr('type', 'text');
        btnPass.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
        inputPass.attr('type', 'password');
        btnPass.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});

// Função para alternar visibilidade da senha no campo 2
$('#btn-password-2').click(function() {
    let inputPass = $('#password-2');
    let btnPass = $('#btn-password-2');
  
    if (inputPass.attr('type') === 'password') {
        inputPass.attr('type', 'text');
        btnPass.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
        inputPass.attr('type', 'password');
        btnPass.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});

// Função para alternar visibilidade da senha no campo 3
$('#btn-password-3').click(function() {
    let inputPass = $('#password-3');
    let btnPass = $('#btn-password-3');
  
    if (inputPass.attr('type') === 'password') {
        inputPass.attr('type', 'text');
        btnPass.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
        inputPass.attr('type', 'password');
        btnPass.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});


//Redefinir senha produto e alterar produto
$(document).ready(function() {
	// Fazer a requisição GET para o controlador combinado
    $.ajax({
        url: "../app/controllers/GetProdutosCombinados.php", // URL para o controlador combinado
        method: "GET",
        success: function(response) {
            let data = JSON.parse(response);
            
            // Limpar a tabela antes de adicionar novos dados
            $('#table-body').empty();

            // Inserir dados de Corte
            data.cortes.forEach(corte => {
                $('#table-body').append(`
                    <tr>
						<td data-label="Serviços">
	                        <label for="typeServicos">Corte</label>
	                    </td>
						<td data-label="Serviços">
	                        <label for="servicos">${corte.nomeCorte}</label>
	                    </td>
	                    <td data-label="Preços">
	                        <label for="preco">${corte.preco}</label> 	
	                    </td>   
	                    <td data-label="Alterar">
	                        <a href="#" class="btn-alterar" id="btn-alterar" >Alterar</a>
	                    </td>
	                    <td data-label="Excluir">
	                        <a href="#" class="btn-excluir" id="btn-excluir">Excluir</a>
	                    </td>
                    </tr>
                `);
            });

            // Inserir dados de Barba
            data.barbas.forEach(barba => {
                $('#table-body').append(`
                    <tr>
						<td data-label="Serviços">
						    <label for="typeServicos">Barba</label>
						</td>
						<td data-label="Serviços">
					        <label for="servicos">${barba.nomeBarba}</label>
					    </td>
					    <td data-label="Preços">
					        <label for="preco">${barba.preco}</label> 	
					    </td>   
					    <td data-label="Alterar">
					        <a href="#" class="btn-alterar" id="btn-alterar" >Alterar</a>
					    </td>
					    <td data-label="Excluir">
					        <a href="#" class="btn-excluir" id="btn-excluir">Excluir</a>
					    </td>
                    </tr>
                `);
            });

	            // Inserir dados de Cuidados
	            data.cuidados.forEach(cuidado => {
	                $('#table-body').append(`
	                    <tr>
							<td data-label="Serviços">
							    <label for="typeServicos">Cuidados</label>
							</td>
							<td data-label="Serviços">
							    <label for="servicos">${cuidado.nomeCuidado}</label>
							</td>
							<td data-label="Preços">
							    <label for="preco">${cuidado.preco}</label> 	
							</td>   
							<td data-label="Alterar">
							    <a href="#" class="btn-alterar" id="btn-alterar" >Alterar</a>
							</td>
							<td data-label="Excluir">
							    <a href="#" class="btn-excluir" id="btn-excluir">Excluir</a>
							</td>
	                    </tr>
	                `);
	            });
	        },
	        error: function(xhr, status, error) {
	            console.error("Erro ao carregar os dados: ", error);
	        }
	    });
	
	
    $('#btn-alterar').on('click', function() {
        let serviços = $('#services').val().trim();
        let preços = $('#prices').val().trim();
    
        if (serviços === '' || preços === '') {
            alert("Por favor, preencha os campos de serviço e preço.");
        } else {
            // Se todos os campos estiverem preenchidos corretamente
            $('#table-container-1').hide();
            $('#table-container-2').hide();
            $('#hr').hide();
            $('#fourth-container').show();
        }
    
    });

    $('#edit-password-change').on('click', function() {
        let password = $('#password-1').val().trim();

        if( password === '') {
            alert("Por favor, preencha o campo de redefinir senha.")
        } else{
            $('#first-content').show();
            $('#fourth-container').hide();
        }
    });

    // Ao clicar no botão de cancelar
    $('.cancel-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Esconder o segundo container e mostrar o primeiro novamente
        $('#first-content').hide();
        $('#table-container-1').show();
        $('#table-container-2').show();
        $('#hr').show();
    });
});




//Redefinir senha produto e excluir produto
$(document).ready(function() {
    $('#btn-excluir').on('click', function() {
        let serviço = $('#services').val().trim();
        let preço = $('#prices').val().trim();
    
        if (serviço === '' || preço === '') {
            alert("Os campos devem estar preenchidos, caso contrário não é possível excluir.");
        } else {
            // Se todos os campos estiverem preenchidos corretamente
            $('#table-container-1').hide();
            $('#table-container-2').hide();
            $('#hr').hide();
            $('#fifth-container').show();
        }
        
    });
    
    $('#edit-password-exclusion').on('click', function() {
        let password = $('#password-2').val().trim();

        if( password === '') {
            alert("Por favor, preencha o campo de redefinir senha.")
        } else{
            $('#second-container').show();
            $('#fifth-container').hide();
        }
    });

    // Ao clicar no botão de cancelar
    $('.cancel-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Esconder o segundo container e mostrar o primeiro novamente
        $('#second-container').hide();
        $('#table-container-1').show();
        $('#table-container-2').show();
        $('#hr').show();
    });
});


var data = {};
var servType = '';
//Para cadastrar produto
$(document).ready(function() {
    $('#register-product').on('click', function() {
        let serviço = $('#service').val().trim();
		let nomeServiço = $('#serviceName').val().trim();
        let preço = $('#price').val().trim();
		
		// Crie um objeto para armazenar as informações
		let formData = {
		    servico: serviço,
		    nomeServico: nomeServiço,
		    preco: preço
		};
    
        if (serviço === '' || nomeServiço === '' || preço === '') {
            alert("Por favor, preencha os campos de serviço e preço.");
        } else {
            // Se todos os campos estiverem preenchidos corretamente
            $('#table-container-1').hide();
            $('#table-container-2').hide();
            $('#hr').hide();
            $('#sixth-container').show();
			
			data = formData;
			servType = serviço;
        }
        
    });

    $('#edit-password-product').on('click', function() {
        let password = $('#password-3').val().trim();

        if( password === '') {
            alert("Por favor, preencha o campo de senha.")
        } else{		
			$.ajax({
		        url: "../app/controllers/CtrlGerente.php",
		        method: "POST",
		        data: $("#form-password").serialize(),
		        success: function(response) {
		            var objRetorno = JSON.parse(response);
					
					if (objRetorno.status === "true") {
						$('#third-container').show();
						$('#sixth-container').hide();
					} else {
						$("#responseArea").text("Senha Incorreta");
					}
		        },
		        error: function(xhr, status, error) {
		            $('#responseArea').text("Erro na requisição: " + error);
		        }
		    });
        }
    });
    
    // Ao clicar no botão de cancelar
    $('.cancel-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Esconder o segundo container e mostrar o primeiro novamente
        $('#third-container').hide();
        $('#table-container-1').show();
        $('#table-container-2').show();
        $('#hr').show();
    });
	
	// Ao clicar no botão de adicionar
    $('.add-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão
		
		$.ajax({
            url: "../app/controllers/Ctrl" + servType + ".php",
            method: "POST",
            data: data,
            success: function(response) {
                var objRetorno = JSON.parse(response);
				
				if (objRetorno.id) { // Verifica se o produto foi criado
	                // Adicione o produto na tabela de alterar produtos
	                $('#table-body').append(`
	                    <tr>
							<td data-label="Serviços">
		                        <label for="typeServicos">${servType}</label>
		                    </td>
							<td data-label="Serviços">
		                        <label for="servicos">${objRetorno.nomeServico}</label>
		                    </td>
		                    <td data-label="Preços">
		                        <label for="preco">${objRetorno.preco}</label> 	
		                    </td>   
	                        <td data-label="Alterar">
	                            <a href="#" class="btn-alterar">Alterar</a>
	                        </td>
	                        <td data-label="Excluir">
	                            <a href="#" class="btn-excluir">Excluir</a>
	                        </td>
	                    </tr>
	                `);
	
					// Esconder o segundo container e mostrar o primeiro novamente
			        $('#third-container').hide();
			        $('#table-container-1').show();
			        $('#table-container-2').show();
			        $('#hr').show();
                } else {
                    $('#responseArea').text("Erro ao adicionar produto.");
                }
				
            },
            error: function(xhr, status, error) {
                $('#responseArea').text("Erro na requisição: " + error);
            }
        });
    });
});



