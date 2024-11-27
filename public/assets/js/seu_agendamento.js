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
	$.get( '../app/controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)
	
	    if (objRetorno.usrType == "cliente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = 'index.html';
		}
	});
	
	$.ajax({
	    url: "../app/controllers/CtrlAgendamentos.php",
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
	
    $('.btn1').on('click', function(event) {
        event.preventDefault();
        
        const passwordInput = $(this).closest('.form').find('input[type="password"]');
        
        if (passwordInput.val().trim() === '') {
            alert('Por favor, preencha o campo de senha.');
        }
    });
});

//Esconder tabela e apararecer confirmar senha - alterar dados
$(document).ready(function() {
    $("#alterar_dados").click(function() {
        $("#table").hide();            // Esconde o elemento com id 'table'
        $("#first-container").show();  // Exibe o elemento com id 'first-container'
    });
});

//Esconder tabela e apararecer confirmar senha - excluir
$(document).ready(function() {
    /*$("#excluir_dados").click(function() {
        $("#table").hide();            // Esconde o elemento com id 'table'
        $("#second-container").show();  // Exibe o elemento com id 'first-container'
    });*/

	$(document).on('click', '#excluir_dados', function(event) {
	    event.preventDefault(); // Previne o comportamento padrão do link
		
		// Encontrar a linha <tr> mais próxima ao botão "Excluir" clicado
		let row = $(this).closest('tr');
		
	    // Extrai os valores das células na linha
		let idAgendamento = $(this).closest('tr').data('id');
		
		
		let dataId = {
				    agendamentosId: idAgendamento,
		};
		console.log(dataId);
		$.ajax({
	        url: "../app/controllers/CtrlAgendamentos.php",
	        method: "DELETE",
	        data: dataId,
	        success: function(response) {
				console.log(response);
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
});