$(document).ready(function() {
	$.get( '../app/controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)

	    if (objRetorno.usrType == "cliente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = 'index.html';
		}
	});
	
	const today = new Date().toISOString().split('T')[0];
	$('#data').attr('min', today);
	
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
	            `);
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
	    url: "../app/controllers/CtrlServicos.php",
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
	    url: "../app/controllers/CtrlFuncionario.php",
	    method: "GET",
	    success: function(response) {
	        let data = JSON.parse(response);
			
			// Limpar as tabelas antes de adicionar novos dados
			$('#profissional').empty();
			
			data.forEach(funcionario => {
				$('#profissional').append(`
					<li data-id="${funcionario.funcionarioId}">${funcionario.nome}</li>

				`);
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
		let horario = $('#horario').val();

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
			funcionarioId: funcionarioId,
			barbaId: barbaId,
			corteId: corteId,
			cuidadosId: cuidadosId,
			preco: preco,
			dia: dia,
			horario: horario
		}
		
		$.ajax({
		    url: "../app/controllers/CtrlAgendamentos.php",
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

