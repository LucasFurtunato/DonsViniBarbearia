
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
	
	function getUrlParameter(name) {
	    var url = new URL(window.location.href);
	    return url.searchParams.get(name);
	}

	// Obtendo o unidade da URL
	var unidade = getUrlParameter('unidade');
	
	// Inicialmente, desabilitar os horários
	$('#horario li').addClass('disabled');
	
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
	
	$('#data').on('change', function () {
	    const dataSelecionada = $(this).val();

	    // Reinicia os horários para exibir todos
	    $('#horario li').show().addClass('disabled');
	    $('#horario li').removeClass('selected');
	    $('#horario-button').text("Selecione o horário");

	    if (dataSelecionada) {
	        $('#horario li').removeClass('disabled'); // Habilita os horários
			
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
	        $('#horario li').each(function () {
	            const horario = $(this).data('time');
	            if (horariosIndisponiveis.includes(horario)) {
	                $(this).hide();
	            }
	        });
	    }
	});
	
	// Evento de clique nos horários
	$('#horario li').on('click', function () {
	    if ($(this).hasClass('disabled')) {
	        alert("Por favor, selecione uma data antes de escolher o horário.");
	        return;
	    }
	});
	
	const today = new Date().toISOString().split('T')[0];
	$('#data').attr('min', today);
	
	
	if (!unidade || (unidade != 1 && unidade != 2)) {
		alert("A unidade não foi selecionada de forma correta, redicionaremos você para a páguna de seleção de unidades");
		window.location.href = 'escolha_unidades.html';
	}

	let totalPrice = 0;  // Variável para armazenar o preço total
	let selectedItems = [];  // Array para armazenar os itens selecionados

	function updatePrice() {
	    // Atualiza o preço total na tela
	    $('#price').text('R$ ' + totalPrice.toFixed(2));

	    // Atualiza os preços individuais
	    $('#individual-prices').empty();
	    $('.content-to-toggle .itens li.selected').each(function() {
	        const name = $(this).text();
	        const price = parseFloat($(this).data('preco')) || 0;

	        // Adiciona apenas itens com preço
	        if (price > 0) {
	            $('#individual-prices').append(`
	                <li>${name}: R$ ${price.toFixed(2)}</li>
	            `)
	        }
	    });
	}

	
    $('.btn-2').click(function() {
        // Encontra o próximo elemento com a classe "content-to-toggle"
        $(this).next('.content-to-toggle').slideToggle(); // Alterna a visibilidade
    });

	// Evento para selecionar itens de serviço (cortes, barbas, cuidados)
	$(document).on('click', '.content-to-toggle .itens li', function() {
	    // Ignora profissionais
	    if ($(this).closest('#profissional').length > 0) {
	        return; // Sai do evento sem fazer nada
	    }

	    const selectedPrice = parseFloat($(this).data('preco')) || 0; // Garantir que o preço seja numérico ou 0
	    const selectedText = $(this).text();

	    // Lida com seleção e desmarcação
	    if ($(this).hasClass('selected')) {
	        // Remover seleção existente
	        totalPrice -= selectedPrice;
	        $(this).removeClass('selected');
	    } else {
	        // Remover seleções anteriores da mesma categoria
	        $(this).closest('.content-to-toggle').find('li.selected').each(function() {
	            const priceToRemove = parseFloat($(this).data('preco')) || 0;
	            totalPrice -= priceToRemove;
	            $(this).removeClass('selected');
	        });

	        // Adicionar o preço do novo item selecionado
	        totalPrice += selectedPrice;
	        $(this).addClass('selected');
	    }

	    // Atualiza o preço total na tela
	    updatePrice();

	    // Atualiza o texto do botão correspondente
	    $(this).closest('.content-to-toggle').prev('.btn-2').text(selectedText);

	    // Fecha o menu dropdown
	    $(this).closest('.content-to-toggle').slideUp();
	});


	// Evento para seleção de profissionais (sem alterar preço)
	$(document).on('click', '#profissional li', function() {
		// Se o item já estiver selecionado, desmarque-o, se não, marque-o
		if ($(this).hasClass('selected')) {
		    $(this).removeClass('selected');
		} else {
		    // Apenas um profissional deve ser selecionado por vez
		    $('#profissional li').removeClass('selected');
		    $(this).addClass('selected');
		}

		// Atualiza o botão com o nome do profissional selecionado
		const selectedText = $(this).text();
		$(this).closest('.content-to-toggle').prev('.btn-2').text(selectedText);

		// Fecha o menu dropdown
		$(this).closest('.content-to-toggle').slideUp();
	});

	
	$.ajax({
	    url: "../controllers/CtrlServicos.php",
	    method: "GET",
	    success: function(response) {
	        let data = JSON.parse(response);
				
			data.cortes.forEach(corte => {
				$('#cortes').append(`
					<li data-id="${corte.servicosId}" data-preco="${corte.preco}">${corte.nomeServico}</li>
				`);
			});
			
			data.barbas.forEach(barba => {
				$('#barbas').append(`
					<li data-id="${barba.servicosId}" data-preco="${barba.preco}">${barba.nomeServico}</li>
				`);
			});
			data.cuidados.forEach(cuidado => {
				$('#cuidados').append(`
					<li data-id="${cuidado.servicosId}" data-preco="${cuidado.preco}">${cuidado.nomeServico}</li>
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
				if (funcionario.unidadeId == unidade) {
					$('#profissional').append(`
						<li data-id="${funcionario.funcionarioId}" data-unidadeId="${funcionario.unidadeId}">${funcionario.nome}</li>

					`);
				}
			});
	    },
	    error: function(xhr, status, error) {
			alert("Erro na requisição: " + error);
	    }
	});
	
	$('#btn-agendar').on('click', function() {
		let funcionarioId = $('#profissional li.selected').data('id');
		let barbaId = $('#barbas li.selected').data('id') || 1;
		let corteId = $('#cortes li.selected').data('id') || 2;
		let cuidadosId = $('#cuidados li.selected').data('id') || 3;
		let preco = totalPrice;
		let dia = $('#data').val();
		let horario = $('#horario li.selected').data('time');
		const clienteId = objUser.idCliente;

		// Verifique se o cliente já tem agendamento no mesmo dia
		const agendamentoClienteDia = agendamentos.find(agendamento =>
		    agendamento.dia === dia && agendamento.clienteId === clienteId
		);

		if (agendamentoClienteDia) {
		    alert("Você já possui um agendamento nesta data.");
		    return;
		}
		// Verifique se o funcionário foi selecionado
		if (!preco) {
		    alert("Por favor, selecione algum serviço que precisa ser feito");
		    return;  // Impede o envio do formulário
		} else if (!dia) {
			alert("Por favor, selecione um dia.");
			return;  // Impede o envio do formulário
		} else if (!horario) {
			alert("Por favor, selecione um horário.");
			return;  // Impede o envio do formulário
		} else if (!funcionarioId) {
			alert("Por favor, selecione um profissional para fazer o serviço");
			return;  // Impede o envio do formulário
		}
		
		let data = {
			unidadeId: unidade, 
			funcionarioId: funcionarioId,
			barbaId: barbaId,
			corteId: corteId,
			cuidadosId: cuidadosId,
			preco: preco,
			dia: dia,
			horario: horario
		}
		
		$.ajax({
		    url: "../controllers/CtrlAgendamentos.php",
		    method: "POST",
		    data: data,
		    success: function(response) {	
		        var objRetorno = JSON.parse(response);
				
				if (objRetorno.status === "true") {
					$('#third-container').show();
					$('#sixth-container').hide();
				} else {
					alert("Agendamento definido")
					window.location.href = 'seu_agendamento.html'
				}
		    },
		    error: function(xhr, status, error) {
		        alert("Erro na requisição: " + error);
		    }
		});
	})

	
});