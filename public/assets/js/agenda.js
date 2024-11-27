$(document).ready(function() {
	$.get( '../app/controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)

	    if (objRetorno.usrType == "funcionario"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = 'index.html';
		}
	});

	$.ajax({
	    url: "../app/controllers/CtrlAgendamentos.php",
	    method: "GET",
	    success: function(response) {
			console.log(response);
	        let data = JSON.parse(response);
			// Limpa o corpo da tabela antes de adicionar novos dados
	        $('#table-body').empty();

	        // Itera sobre cada registro retornado
	        data.forEach(item => {
	            $('#table-body').append(`
					<tr>
					    <td data-label="Nome Fun."><p>${item.funNome}</p></td>
					    <td data-label="Dia">${item.dia}</td>
					    <td data-label="Horário">${item.horario}</td>
					    <td data-label="Serviços">${
						    [item.corteNome, item.barbaNome, item.cuidadosNome]
						        .filter(nome => nome && nome.trim() !== "") // Remove itens vazios ou apenas espaços
						        .join(", ") // Junta os valores restantes com uma vírgula
						}</td>                    
					    <td data-label="Nome Cliente">${item.clienteNome}</td>      
					    <td data-label="Situação"><a href="#" class="btn">Feito</a></td>              
					</tr>
	            `);
	        });
	    },
	    error: function(xhr, status, error) {
			alert("Erro na requisição: " + error);
	    }
	});

	
    $('#add-row').click(function() {
        // Dados da nova linha
        const newRow = `
            <tr>
                <td data-label="Nome Fun."><p>Funcionário Novo</p></td>
                <td data-label="Dia">XX/XX/XX</td>
                <td data-label="Horário">00:00</td>
                <td data-label="Serviços">Serviço Novo</td>                    
                <td data-label="Nome Cliente"> Cliente Novo</td>      
                <td data-label="Situação"><a href="#" class="btn">Nova</a></td>              
            </tr>
        `;
        // Adiciona a nova linha ao tbody
        $('#table-body').append(newRow);
    });
});

$(document).ready(function() {
    $('.btn').on('click', function() {
        const $btn = $(this);
        
        if ($btn.css('background-color') === 'rgb(50, 205, 50)') { // Verde
            $btn.css('background-color', '#ff1046'); // Muda para vermelho
            $btn.text('Pendente'); // Altera o texto
        } else if ($btn.css('background-color') === 'rgb(255, 16, 70)') { // Vermelho
            $btn.css('background-color', '#32cd32'); // Muda para verde
            $btn.text('Feito'); // Altera o texto
        }
    });
});
