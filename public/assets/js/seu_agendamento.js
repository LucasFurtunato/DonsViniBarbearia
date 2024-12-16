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

//Verificar se o campo de senha está preenchido

$(document).ready(function() {
	var objUser = null;
	
	$.get( '../controllers/VfyLogin.php', function(dados) {
	    objUser = JSON.parse(dados)
	
	    if (objUser.usrType == "cliente"){
	        $("#login-button").text(objUser.name);
	    } else {
			window.location.href = '../../index.html';
		}
	});
	
	$.ajax({
	    url: "../controllers/CtrlServicos.php",
	    method: "GET",
	    success: function(response) {
	        let data = JSON.parse(response);
				
			data.cortes.forEach(corte => {
				$('#alterar-corte').append(`
					<option value="${corte.nomeServico}" data-preco="${corte.preco}" data-id="${corte.servicosId}">${corte.nomeServico}</option>
				`);
			});
			
			data.barbas.forEach(barba => {
				$('#alterar-barba').append(`
					<option value="${barba.nomeServico}" data-preco="${barba.preco}" data-id="${barba.servicosId}">${barba.nomeServico}</option>
				`);
			});
			data.cuidados.forEach(cuidado => {
				$('#alterar-cuidados').append(`
					<option value="${cuidado.nomeServico}" data-preco="${cuidado.preco}" data-id="${cuidado.servicosId}">${cuidado.nomeServico}</option>
				`);
			});
	    },
	    error: function(xhr, status, error) {
			alert("Erro na requisição: " + error);
	    }
	});

	$.ajax({
	    url: "../controllers/CtrlFuncionario.php",
	    method: "GET",
	    success: function(response) {
	        let data = JSON.parse(response);
			
			// Limpar as tabelas antes de adicionar novos dados
			$('#profissional').empty();
			
			data.forEach(funcionario => {
				$('#alterar-funcionario').append(`
					<option value="${funcionario.nome}" data-id="${funcionario.funcionarioId}">${funcionario.nome}</option>

				`);
			});
	    },
	    error: function(xhr, status, error) {
			alert("Erro na requisição: " + error);
	    }
	});
	
	atualizarTabela();
	
	function atualizarTabela(){
		$.ajax({
		    url: "../controllers/CtrlAgendamentos.php",
		    method: "GET",
		    success: function(response) {
		        let data = JSON.parse(response);
				// Limpa o corpo da tabela antes de adicionar novos dados
		        $('#table-body').empty();

		        // Itera sobre cada registro retornado
		        data.forEach(item => {
		            $('#table-body').append(`
		                <tr data-id="${item.agendamentosId}">
		                    <td data-label="Local">${item.unidadeId}</td>
		                    <td data-label="Nome Fun.">${item.funNome}</td>
		                    <td data-label="Dia">${item.dia}</td>
		                    <td data-label="Horário">${item.horario}</td>
							<td data-label="Serviço">${
							    [item.corteNome, item.barbaNome, item.cuidadosNome]
							        .filter(nome => nome && nome.trim() !== "") // Remove itens vazios ou apenas espaços
							        .join(", ") // Junta os valores restantes com uma vírgula
							}</td>
		                    <td data-label="Preço">${item.preco}</td>
		                    <td data-label="Ações">
		                        <div class="btn-group">
		                            <a href="#" class="btn" id="alterar_dados">Alterar dados</a>
		                            <a href="#" class="btn delete" id="excluir_dados" style="background-color: rgb(255, 62, 62);">Excluir</a>
		                        </div>
		                    </td>
		                </tr>
		            `);
		        });
		    },
		    error: function(xhr, status, error) {
				alert("Erro na requisição: " + error);
		    }
		});

	}
	
	let agendamentos = [];

	$.ajax({
	    url: "../controllers/CtrlAgendamentosListAll.php",
	    method: "GET",
	    success: function(response) {
			agendamentos = JSON.parse(response);
	    },
	    error: function(xhr, status, error) {
	        alert("Erro na requisição: " + error);
	    }
	});
	

	// Função para calcular o preço baseado nos serviços selecionados
	function atualizarPreco() {
	    let precoCorte = 0;
	    let precoBarba = 0;
	    let precoCuidados = 0;

	    // Obtém o preço do serviço de corte
	    $('#alterar-corte option:selected').each(function() {
	        precoCorte += parseFloat($(this).data('preco')) || 0;
	    });

	    // Obtém o preço do serviço de barba
	    $('#alterar-barba option:selected').each(function() {
	        precoBarba += parseFloat($(this).data('preco')) || 0;
	    });

	    // Obtém o preço do serviço de cuidados
	    $('#alterar-cuidados option:selected').each(function() {
	        precoCuidados += parseFloat($(this).data('preco')) || 0;
	    });

	    // Calcula o preço total
	    let precoTotal = precoCorte + precoBarba + precoCuidados;

	    // Atualiza os preços individuais e o preço total
	    $('#preco-corte').text(precoCorte.toFixed(2)); 
	    $('#preco-barba').text(precoBarba.toFixed(2)); 
	    $('#preco-cuidados').text(precoCuidados.toFixed(2)); 
	    $('#alterar-preco').text("R$ " + precoTotal.toFixed(2)); // Exibe o preço total
	}

	// Atualiza o preço sempre que um serviço for alterado
	$('#alterar-corte, #alterar-barba, #alterar-cuidados').change(function() {
	    atualizarPreco(); // Recalcula o preço
	});

	// Função de inicialização: calcula o preço baseado nos serviços já selecionados
	atualizarPreco();
	
    $('#edit-password-product').on('click', function(event) {
        event.preventDefault();
        
        const passwordInput = $(this).closest('.form').find('input[type="password"]');
        
        if (passwordInput.val().trim() === '') {
            alert('Por favor, preencha o campo de senha.');
        } else {
			$.ajax({
			    url: "../controllers/CtrlClienteVfyPass.php",
			    method: "POST",
			    data: $("#formAlterarAgendamentoPassword").serialize(),
			    success: function(response) {
			        var objRetorno = JSON.parse(response);
					
					if (objRetorno.status == false) {
						alert(objRetorno.message);
					} else {
						$("#table").hide();            // Esconde o elemento com id 'table'
						$("#first-container").hide();  // Exibe o elemento com id 'first-container'
						$('#alterar-container').show(); // Mostra a seção de alteração
					}
			    },
			    error: function(xhr, status, error) {
			        $('#responseArea').text("Erro na requisição: " + error);
			    }
			});
		}
    });
	
	let dataId = null;
	let rowExcluirDados;
	
	$('#delete-password-product').on('click', function(event) {
	    event.preventDefault();

		$.ajax({
			url: "../controllers/CtrlAgendamentos.php",
			method: "DELETE",
			data: dataId,
			success: function(response) {
				
				var objRetorno = JSON.parse(response);
				
				if (objRetorno.status == false) {
					alert(objRetorno.message);
				} else {
					alert(objRetorno.message);
					// Remover a linha
					rowExcluirDados.remove();
					
					$("#table").show();            // Esconde o elemento com id 'table'
					$("#first-container").hide();  // Exibe o elemento com id 'first-container'
					$('#alterar-container').hide(); // Mostra a seção de alteração
					$("#second-container").hide();
				}
			},
			error: function(xhr, status, error) {
				alert("Erro na requisição: " + error);
			}
		});
	});
	
	let unidade = null;
	
	$(document).on('click', '#alterar_dados', function(event) {
		event.preventDefault(); // Previne o comportamento padrão do link
		unidade = $("#alterar-local").val().trim();
				
		$(this).addClass('active').closest('tr').siblings().find('.btn-alterar').removeClass('active');
		   
	   // Obtém a linha da tabela onde o botão foi clicado
	   let row = $(this).closest('tr');
	   
	   // Extrai os valores das células na linha
	   let idAgendamento = $(this).closest('tr').data('id');
	   
	   let local = row.find('td[data-label="Local"]').text();
	   let funcionario = row.find('td[data-label="Nome Fun."]').text();
	   let dia = row.find('td[data-label="Dia"]').text();
	   let horario = row.find('td[data-label="Horário"]').text();

	   let servico = row.find('td[data-label="Serviço"]').text();

	   let servicosArray = servico.split(',').map(item => item.trim());

	   let corte = servicosArray.length > 0 ? servicosArray[0] : 'Sem Corte';
	   let barba = servicosArray.length > 1 ? servicosArray[1] : 'Sem Barba';
	   let cuidados = servicosArray.length > 2 ? servicosArray[2] : 'Sem Cuidados';
	   let preco = row.find('td[data-label="Preço"]').text();

	   // Preenche os campos do formulário de alteração com os dados existentes
	   $('#idAgendamento').val(idAgendamento);
	   $('#alterar-local').val(local);
	   $('#alterar-funcionario').val(funcionario);
	   $('#alterar-dia').val(dia);
	   $('#alterar-horario').val(horario);
	   $('#alterar-corte').val(corte);
	   $('#alterar-barba').val(barba);
	   $('#alterar-cuidados').val(cuidados);
	   $('#alterar-preco').text("R$ " + preco); // Exibe o preço como texto no campo de preço
	   
	   const dataSelecionada = $('#alterar-dia').val();

	   if (dataSelecionada) {
	       // Filtra os agendamentos para o dia e unidade selecionados
	       const horariosIndisponiveis = agendamentos
	           .filter(agendamento => 
	               agendamento.dia === dataSelecionada && 
	               parseInt(agendamento.unidadeId) === parseInt(unidade) // Comparação de unidadeId
	           )
	           .map(agendamento => agendamento.horario);

	       // Esconde os horários já agendados
	       $('#alterar-horario option').each(function () {
	           const horario = $(this).val();
	           if (horariosIndisponiveis.includes(horario)) {
	               $(this).hide();
	           }
	       });
	   }

		
		$("#table").hide();            // Esconde o elemento com id 'table'
		//$("#first-container").show();  // Exibe o elemento com id 'first-container'
		$('#alterar-container').show(); // Mostra a seção de alteração
	})
	
	$(document).on('click', '#excluir_dados', function(event) {
	    event.preventDefault(); // Previne o comportamento padrão do link
		
		// Encontrar a linha <tr> mais próxima ao botão "Excluir" clicado
		rowExcluirDados = $(this).closest('tr');
		
	    // Extrai os valores das células na linha
		let idAgendamento = $(this).closest('tr').data('id');
		
		
		dataId = {
				    agendamentosId: idAgendamento,
		};
		
		$("#table").hide();            // Esconde o elemento com id 'table'
		$("#first-container").hide();  // Exibe o elemento com id 'first-container'
		$('#alterar-container').hide(); // Mostra a seção de alteração
		$("#second-container").show();
	});
	
	// Ao clicar em "Cancelar" no formulário de alteração
	$('#cancelar-alteracao').on('click', function() {
	    // Oculta o formulário de edição e volta para a tabela
		$("#table").show();            // Esconde o elemento com id 'table'
		$("#first-container").hide();  // Exibe o elemento com id 'first-container'
		$('#alterar-container').hide(); // Mostra a seção de alteração
	});
	
	// Ao clicar em "Cancelar" no formulário de alteração
	$('#cancelar-exclusao').on('click', function() {
	    // Oculta o formulário de edição e volta para a tabela
		$("#table").show();            // Esconde o elemento com id 'table'
		$("#first-container").hide();  // Exibe o elemento com id 'first-container'
		$("#second-container").hide(); 
		$('#alterar-container').hide(); // Mostra a seção de alteração
	});
	
	$("#confirmar-alteracao").on('click', function() {
		let idAgendamento = $('#idAgendamento').val().trim();
		let idLocal = $('#alterar-local').val().trim();
		let idFuncionario = $('#alterar-funcionario option:selected').data('id');
		let dia = $('#alterar-dia').val().trim();
		let horario = $('#alterar-horario').val().trim();
		
		// Captura os IDs dos serviços selecionados a partir dos atributos 'data-id' das opções selecionadas
	    let idCorte = $('#alterar-corte option:selected').data('id') || 1;
	    let idBarba = $('#alterar-barba option:selected').data('id') || 1;
	    let idCuidados = $('#alterar-cuidados option:selected').data('id') || 1;
		
		let precoTotalTexto = $('#alterar-preco').text();
		let precoTotalNumero = parseFloat(precoTotalTexto.replace('R$ ', '').trim()); 
		
		let data = {
		    agendamentosId: idAgendamento,
			unidadeId: idLocal,
			funcionarioId: idFuncionario,
			barbaId: idBarba,
			corteId: idCorte,
			cuidadosId: idCuidados,
			preco: precoTotalNumero,
			dia: dia,
			horario: horario
		};
		
		const clienteId = objUser.idCliente;

		// Verifique se o cliente já tem agendamento no mesmo dia
		const agendamentoClienteDia = agendamentos.find(agendamento =>
		    agendamento.dia === dia && agendamento.clienteId === clienteId
		);

		if (agendamentoClienteDia) {
		    alert("Você já possui um agendamento nesta data.");
		    return;
		}
		
		$.ajax({
		    url: "../controllers/CtrlAgendamentos.php",
		    method: "PUT",
		    data: data,
		    success: function(response) {
		        var objRetorno = JSON.parse(response);
				
				if (objRetorno.status == false) {
					alert(objRetorno.message);
				} else {
					alert(objRetorno.message);
					atualizarTabela();
					
					$.ajax({
					    url: "../controllers/CtrlAgendamentosListAll.php",
					    method: "GET",
					    success: function(response) {
							agendamentos = JSON.parse(response);
					    },
					    error: function(xhr, status, error) {
					        alert("Erro na requisição: " + error);
					    }
					});
					
					$("#table").show();            // Esconde o elemento com id 'table'
					$('#alterar-container').hide(); // Mostra a seção de alteração
				}
		    },
		    error: function(xhr, status, error) {
				alert("Erro na requisição: " + error);
		    }
		});
	})
	
	
	const today = new Date().toISOString().split('T')[0];
	$('#alterar-dia').attr('min', today);
	
	$("#alterar-local").on("change", function() {
		unidade = $("#alterar-local").val().trim();
		
		const dataSelecionada = $('#alterar-dia').val();

		if (dataSelecionada) {
		    // Filtra os agendamentos para o dia e unidade selecionados
		    const horariosIndisponiveis = agendamentos
		        .filter(agendamento => 
		            agendamento.dia === dataSelecionada && 
		            parseInt(agendamento.unidadeId) === parseInt(unidade) // Comparação de unidadeId
		        )
		        .map(agendamento => agendamento.horario);

		    // Esconde os horários já agendados
		    $('#alterar-horario option').each(function () {
		        const horario = $(this).val();
		        if (horariosIndisponiveis.includes(horario)) {
		            $(this).hide();
		        } else {
					$(this).show();	
				}
		    });
		}
	})
	
	$('#alterar-dia').on('change', function () {
	    const dataSelecionada = $(this).val();

	    if (dataSelecionada) {
			
			// Verifica se o cliente já tem agendamento no mesmo dia
			const clienteId = objUser.idCliente;
			const agendamentoClienteDia = agendamentos.find(agendamento =>
			    agendamento.dia === dataSelecionada && agendamento.clienteId === clienteId
			);

			if (agendamentoClienteDia) {
			    alert("Você já possui um agendamento nesta data. Por favor, escolha outra.");
			    $(this).val(''); // Reseta a data selecionada
			    return;
			}
	        // Filtra os agendamentos para o dia e unidade selecionados
	        const horariosIndisponiveis = agendamentos
	            .filter(agendamento => 
	                agendamento.dia === dataSelecionada && 
	                parseInt(agendamento.unidadeId) === parseInt(unidade) // Comparação de unidadeId
	            )
	            .map(agendamento => agendamento.horario);

	        // Esconde os horários já agendados
	        $('#alterar-horario option').each(function () {
	            const horario = $(this).val();
	            if (horariosIndisponiveis.includes(horario)) {
	                $(this).hide();
	            }
	        });
	    }
	});


});