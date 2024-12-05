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


$(document).ready(function(){
	$.get( '../controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)

	    if (objRetorno.usrType == "gerente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = '../../index.html';
		}
	});
	
    $.ajax({
        url: "../controllers/CtrlFuncionario.php",
        method: "GET",
        success: function(response) {
            var data = JSON.parse(response);
			console.log(data);

               // Limpar a tabela antes de adicionar novos dados
            $('#table-body').empty();

            // Inserir dados de Corte
            data.forEach(fun => {
				if (fun.unidadeId !== 3) { // Apenas processa se unidadeId não for 3
				    $('#table-body').append(`
				        <tr data-id="${fun.funcionarioId}">
				            <td data-label="Nome Fun.">${fun.nome}</td>
				            <td data-label="Email">${fun.email}</td>
				            <td data-label="Unidade">${fun.unidadeId}</td>   
				            <td data-label="Código">${fun.codigo}</td>   
				            <td data-label="Ações">
				                <div class="btn-group">
				                    <a href="#" class="btn" id="alterar_dados">Alterar dados</a>
				                    <a href="#" class="btn, delete" id="excluir_dados">Excluir</a>
				                </div>
				            </td>
				        </tr>
                	`);
				}
            });
            
        },
        error: function(xhr, status, error) {
            $('#responseArea').text("Erro na requisição: " + error);
        }
    });

	$(document).on('click', '#alterar_dados', function(event) {
	    $(this).addClass('active').closest('tr').siblings().find('#alterar_dados').removeClass('active');
	    
	    // Obtém a linha da tabela onde o botão foi clicado
	    let row = $(this).closest('tr');
	
	    // Extrai os valores das células na linha
	    let Idfuncionario = $(this).closest('tr').data('id');
	    let nome = row.find('td[data-label="Nome Fun."]').text();
	    let email = row.find('td[data-label="Email"]').text();
	    let unidadeId = row.find('td[data-label="Unidade"]').text();
	    let codigo = row.find('td[data-label="Código"]').text();
	
	    // Preenche os campos do formulário de alteração com os dados existentes
	    $('#idfuncionario').val(Idfuncionario);
	    $('#alterar-nome').val(nome);
	    $('#alterar-email').val(email);
	    $('#unidade_fun').val(unidadeId);
	    $('#alterar-codigo').val(codigo);
	    
        // Oculta o formulário de edição e volta para a tabela
        $('#table').hide();
        $('#alterar-container').show(); // Mostra a seção de alteração
	});

	// Confirma a alteração e atualiza os dados na tabela
	$('#confirmar-alteracao').on('click', function() {
	    // Obtém os valores do formulário
	    let Idfuncionario= $('#idfuncionario').val().trim();
	    let nome = $('#alterar-nome').val().trim();
	    let email = $('#alterar-email').val().trim();
	    let unidadeId = $('#unidade_fun').val().trim();
	    let codigo = $('#alterar-codigo').val().trim();
	    let senha = $('#alterar-senha').val().trim();
	    let confirmarsenha = $('#alterar-senha').val().trim();
	    // Valida os campos
	    if (Idfuncionario === '' || nome === '' || email === '' || unidadeId === '' || codigo ==='' || senha ==='' || confirmarsenha ==='') {
	        alert("Por favor, preencha todos os campos.");
	    } else {
	        $.ajax({
	            url: "../controllers/CtrlFuncionario.php",
	            method: "PUT",
	            data: $("#form-alterar").serialize(),
	            success: function(response) {
	                var objRetorno = JSON.parse(response);
	                
	                if (objRetorno.status == false) {
	                    alert(objRetorno.message);
	                } else {
	                    // Atualiza os valores na tabela (supondo que a linha alterada ainda está selecionada)
	                    let row = $('#alterar_dados.active').closest('tr'); // Mantém referência à linha ativa
	                    row.find('td[data-label="Nome Fun."]').text(nome);
	                    row.find('td[data-label="Email"]').text(email);
	                    row.find('td[data-label="Unidade"]').text(unidadeId);
	                    row.find('td[data-label="Código"]').text(codigo);
	                    // Oculta o formulário de edição e volta para a tabela
	                    $('#table').show();
	                    $('#alterar-container').hide(); // Mostra a seção de alteração
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
	        $('#table').show();
		});
	
	$('#cancelar-exclusão').on('click', function() {
		   // Oculta o formulário de edição e volta para a tabela
		    $('#alterar-container').hide();
	        $('#table').show();
		});

	//senha 
	let dataIdx = null;
	let rowExcluirDados;
	$(document).on('click', '#excluir_dados', function(event) {
		 event.preventDefault(); // Previne o comportamento padrão do link

		// Encontrar a linha <tr> mais próxima ao botão "Excluir" clicado
		rowExcluirDados = $(this).closest('tr'); 
	    let Idfuncionario = $(this).closest('tr').data('id');
	    
	     dataIdx = {
	                funcionarioId: Idfuncionario,
	    };

		 $('#alterar-container').hide();
		 $('#delete-container').show();
	     $('#table').hide();
	});

	//deletar
	$(document).on('click', '#delete-fun', function(event) {
	    event.preventDefault();

		$.ajax({
			url: "../controllers/CtrlFuncionario.php",
			method: "DELETE",
			data: dataIdx,
			success: function(response) {
				var objRetorno = JSON.parse(response);

				if (objRetorno.status == false) {
					alert(objRetorno.message);
				} else {
					alert(objRetorno.message);
					// Remover a linha
					rowExcluirDados.remove();
					$('#alterar-container').hide();
					$('#delete-container').hide();
					$('#table').show();
				}
			},
			error: function(xhr, status, error) {
				alert("Erro na requisição: " + error);
			}
		});
	});
});
