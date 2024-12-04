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
	$.get( '../controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)

	    if (objRetorno.usrType == "gerente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = '../../index.html';
		}
	});
	// Fazer a requisição GET para o controlador combinado
    $.ajax({
        url: "../controllers/CtrlServicos.php", // URL para o controlador combinado
        method: "GET",
        success: function(response) {
            let data = JSON.parse(response);
            
            // Limpar a tabela antes de adicionar novos dados
            $('#table-body').empty();

            // Inserir dados de Corte
            data.cortes.forEach(corte => {
                $('#table-body').append(`
                    <tr data-id="${corte.servicosId}">
						<td data-label="TiposDeServicos">
	                        <label for="servType">${corte.tipoServico}</label>
	                    </td>
						<td data-label="Serviços">
	                        <label for="servicos">${corte.nomeServico}</label>
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
                    <tr data-id="${barba.servicosId}">
						<td data-label="TiposDeServicos">
						    <label for="servType">${barba.tipoServico}</label>
						</td>
						<td data-label="Serviços">
					        <label for="servicos">${barba.nomeServico}</label>
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
	                    <tr data-id="${cuidado.servicosId}">
							<td data-label="TiposDeServicos">
							    <label for="servType">${cuidado.tipoServico}</label>
							</td>
							<td data-label="Serviços">
							    <label for="servicos">${cuidado.nomeServico}</label>
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
	            alert("Erro na requisição: " + error);
	        }
	    });
	
	
		// Captura o evento de clique no botão "Alterar"
		$(document).on('click', '.btn-alterar', function(event) {
		    event.preventDefault(); // Previne o comportamento padrão do link
			
			// Adiciona a classe 'active' ao botão clicado e remove de seus irmãos
			$(this).addClass('active').closest('tr').siblings().find('.btn-alterar').removeClass('active');
		    
			// Obtém a linha da tabela onde o botão foi clicado
		    let row = $(this).closest('tr');
		    
			// Extrai os valores das células na linha
			let idServico = $(this).closest('tr').data('id');
		    let tipoServico = row.find('td[data-label="TiposDeServicos"] label').text();
		    let nomeServico = row.find('td[data-label="Serviços"]:nth-child(2) label').text();
		    let preco = row.find('td[data-label="Preços"] label').text();

		    // Preenche os campos do formulário de alteração com os dados existentes
			$('#idServico').val(idServico);
		    $('#alterar-servico').val(tipoServico);
		    $('#alterar-nome-servico').val(nomeServico);
		    $('#alterar-preco').val(preco);

		    // Exibe o formulário de edição e esconde a tabela
		    $('#table-container-1').hide();
		    $('#table-container-2').hide();
		    $('#hr').hide();
		    $('#alterar-container').show(); // Mostra a seção de alteração
		});
		
		$(document).on('click', '.btn-excluir', function(event) {
		    event.preventDefault(); // Previne o comportamento padrão do link
			
			// Encontrar a linha <tr> mais próxima ao botão "Excluir" clicado
			let row = $(this).closest('tr');
			
		    // Extrai os valores das células na linha
			let idServico = $(this).closest('tr').data('id');
			
			
			let dataId = {
					    servicosId: idServico,
			};
		    // Preenche os campos do formulário de alteração com os dados existentes
			$('#idServico').val(idServico);
			$.ajax({
		        url: "../controllers/CtrlServicos.php",
		        method: "DELETE",
		        data: dataId,
		        success: function(response) {
		            var objRetorno = JSON.parse(response);
					
					if (objRetorno.status == false) {
						alert(objRetorno.message);
					} else {
						alert(objRetorno.message);
						// Remover a linha
						row.remove();
					}
		        },
		        error: function(xhr, status, error) {
					alert("Erro na requisição: " + error);
		        }
		    });
		});

		// Confirma a alteração e atualiza os dados na tabela
		$('#confirmar-alteracao').on('click', function() {
		    // Obtém os valores do formulário
			let idServico = $('#idServico').val().trim();
		    let tipoServico = $('#alterar-servico').val().trim();
		    let nomeServico = $('#alterar-nome-servico').val().trim();
		    let preco = $('#alterar-preco').val().trim();

		    // Valida os campos
		    if (tipoServico === '' || nomeServico === '' || preco === '' || idServico === '') {
		        alert("Por favor, preencha todos os campos.");
		    } else {
				$.ajax({
			        url: "../controllers/CtrlServicos.php",
			        method: "PUT",
			        data: $("#form-alterar").serialize(),
			        success: function(response) {
			            var objRetorno = JSON.parse(response);
						
						if (objRetorno.status == false) {
							alert(objRetorno.message);
						} else {
							// Atualiza os valores na tabela (supondo que a linha alterada ainda está selecionada)
						    let row = $('.btn-alterar.active').closest('tr'); // Mantém referência à linha ativa
							row.find('td[data-label="TiposDeServicos"] label').text(tipoServico);
						    row.find('td[data-label="Serviços"]:nth-child(2) label').text(nomeServico);
						    row.find('td[data-label="Preços"] label').text(preco);
							// Oculta o formulário de edição e volta para a tabela
						    $('#alterar-container').hide();
						    $('#table-container-1').show();
						    $('#table-container-2').show();
						    $('#hr').show();
						}
			        },
			        error: function(xhr, status, error) {
						alert("Erro na requisição: " + error);
			        }
			    });
			}		    
		});

		// Ao clicar em "Cancelar" no formulário de alteração
		$('#cancelar-alteracao').on('click', function() {
		    // Oculta o formulário de edição e volta para a tabela
		    $('#alterar-container').hide();
		    $('#table-container-1').show();
		    $('#table-container-2').show();
		    $('#hr').show();
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
//Para cadastrar produto
$(document).ready(function() {
    $('#register-product').on('click', function() {
        let serviço = $('#service').val().trim();
		let nomeServiço = $('#serviceName').val().trim();
        let preço = $('#price').val().trim();
		
		// Crie um objeto para armazenar as informações
		let formData = {
		    tipoServico: serviço,
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
        }
        
    });

    $('#edit-password-product').on('click', function() {
        let password = $('#password-3').val().trim();

        if( password === '') {
            alert("Por favor, preencha o campo de senha.")
        } else{		
			$.ajax({
		        url: "../controllers/CtrlGerente.php",
		        method: "POST",
		        data: $("#form-password").serialize(),
		        success: function(response) {
		            var objRetorno = JSON.parse(response);
					
					if (objRetorno.status === "true") {
						$('#third-container').show();
						$('#sixth-container').hide();
					} else {
						alert(objRetorno.message)
					}
		        },
		        error: function(xhr, status, error) {
		            alert("Erro na requisição: " + error);
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
		$('#responseArea').text('');
    });
	
	// Ao clicar no botão de adicionar
    $('.add-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão
		
		$.ajax({
            url: "../controllers/CtrlServicos.php",
            method: "POST",
            data: data,
            success: function(response) {
                var objRetorno = JSON.parse(response);
				
				if (objRetorno.id) { // Verifica se o produto foi criado
	                // Adicione o produto na tabela de alterar produtos
	                $('#table-body').append(`
	                    <tr data-id="${objRetorno.id}">
							<td data-label="Serviços">
		                        <label for="servType">${objRetorno.tipoServico}</label>
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
                    alert(objRetorno.message);
                }
				
            },
            error: function(xhr, status, error) {
                alert("Erro na requisição: " + error);
            }
        });
    });
});



