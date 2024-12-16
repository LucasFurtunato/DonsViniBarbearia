$(document).ready(function () {
	let suEmail = $("#email-text").text();
	let suTelefone1 = $("#telefone-text-unidade-1").text();
	let suEndereco1 = $("#endereco-text-unidade-1").text();
	let suTelefone2 = $("#telefone-text-unidade-2").text();
	let suEndereco2 = $("#endereco-text-unidade-2").text();
	
	$.ajax({
	    url: "app/controllers/CtrlEmpresa.php",
	    method: "GET",
	    success: function (response) {
			var data = JSON.parse(response);
			
			data.forEach(contato => {
				$(`#email-text`).text(contato.email);
				$(`#telefone-text-unidade-${contato.Idempresa}`).text(`Unidade ${contato.Idempresa}: ` + contato.telefone);
				$(`#endereco-text-unidade-${contato.Idempresa}`).text(`Unidade ${contato.Idempresa}: ` + contato.endereco);
				
				suEmail = $("#email-text").text();
				suTelefone1 = $("#telefone-text-unidade-1").text();
				suEndereco1 = $("#endereco-text-unidade-1").text();
				suTelefone2 = $("#telefone-text-unidade-2").text();
				suEndereco2 = $("#endereco-text-unidade-2").text();
			});
	    },
	    error: function (error) {
	        alert("Erro ao atualizar os contatos.");
	        console.error(error);
	    },
	});
	
	$.ajax({
	    url: "app/controllers/CtrlTxtServicos.php",
	    method: "GET",
	    success: function (response) {
			var data = JSON.parse(response);
			
			data.forEach(servicoTxt => {
				$(`#${servicoTxt.localizacao}-txt-1`).text(servicoTxt.texto1);
				$(`#${servicoTxt.localizacao}-txt-2`).text(servicoTxt.texto2);
			});
	    },
	    error: function (error) {
	        alert("Erro ao atualizar os contatos.");
	        console.error(error);
	    },
	});

	
	$("#saveContactBtn-1").hide();
	$("#saveContactBtn-2").hide();
	
    $("#editContactBtn-1").click(function () {
		$("#editContactBtn-2").show();
		$("#saveContactBtn-2").hide();
		
		
		
		$("#email-text").text(suEmail);
		$("#telefone-text-unidade-2").text(suTelefone2);
		$("#endereco-text-unidade-2").text(suEndereco2);

        // Capturar os valores atuais dos campos
        let email = $("#email-text").text()
        let telefone1 = $("#telefone-text-unidade-1").text().replace(`Unidade 1: `, '');
        let endereco1 = $("#endereco-text-unidade-1").text().replace(`Unidade 1: `, '');

        // Criar campos editáveis
        $("#email-text").html(`<input type='text' id='edit-email' value='${email}' />`);
        $("#telefone-text-unidade-1").html(`<input type='text' id='edit-telefone1' value='${telefone1}' />`);
        $("#endereco-text-unidade-1").html(`<input type='text' id='edit-endereco1' value='${endereco1}' />`);

        // Alterar botão para salvar
        $("#saveContactBtn-1").show();
		$(this).hide();
    });
	// Evento para salvar as alterações
	$("#saveContactBtn-1").click(function () {
	    // Obter os valores editados
	    suEmail = $("#edit-email").val();
	    suTelefone1 = $("#edit-telefone1").val();
	    suEndereco1 = $("#edit-endereco1").val();

	    // Enviar para o servidor via AJAX
	    $.ajax({
	        url: "app/controllers/CtrlEmpresa.php", // Ajuste conforme seu ambiente
	        method: "PUT",
	        data: {
	            Idempresa: 1, // ID fixo ou dinâmico, dependendo da lógica do seu sistema
	            unidade: "Unidade 1",
	            email: suEmail,
	            telefone: suTelefone1, // Use outros campos para cada unidade, se necessário
	            endereco: suEndereco1,
	        },
	        success: function (response) {
				console.log(response);
	            alert("Contatos atualizados com sucesso!");
	            // Atualizar os textos na página
	            $("#email-text").text(suEmail);
				suTelefone1 = "Unidade 1: " + suTelefone1;
				suEndereco1 = "Unidade 1: " + suEndereco1;
	            $("#telefone-text-unidade-1").text(suTelefone1);
	            $("#endereco-text-unidade-1").text(suEndereco1);

	            // Alterar botão de volta
	            $("#editContactBtn-1").show();
				$("#saveContactBtn-1").hide();
	        },
	        error: function (error) {
	            alert("Erro ao atualizar os contatos.");
	            console.error(error);
	        },
	    });
	});
	
	$("#editContactBtn-2").click(function () {
		$("#editContactBtn-1").show();
		$("#saveContactBtn-1").hide();
		
		$("#email-text").text(suEmail);
		$("#telefone-text-unidade-1").text(suTelefone1);
		$("#endereco-text-unidade-1").text(suEndereco1);
		
	    // Capturar os valores atuais dos campos
	    let email = $("#email-text").text();
	    let telefone2 = $("#telefone-text-unidade-2").text().replace(`Unidade 2: `, '');
	    let endereco2 = $("#endereco-text-unidade-2").text().replace(`Unidade 2: `, '');

	    // Criar campos editáveis
	    $("#email-text").html(`<input type='text' id='edit-email' value='${email}' />`);
	    $("#telefone-text-unidade-2").html(`<input type='text' id='edit-telefone2' value='${telefone2}' />`);
	    $("#endereco-text-unidade-2").html(`<input type='text' id='edit-endereco2' value='${endereco2}' />`);

	    // Alterar botão para salvar
	    $("#saveContactBtn-2").show();
		$(this).hide();
	});
	// Evento para salvar as alterações
	$("#saveContactBtn-2").click(function () {
	    // Obter os valores editados
	    suEmail = $("#edit-email").val();
	    suTelefone2 = $("#edit-telefone2").val();
	    suEndereco2 = $("#edit-endereco2").val();

	    // Enviar para o servidor via AJAX
	    $.ajax({
	        url: "app/controllers/CtrlEmpresa.php", // Ajuste conforme seu ambiente
	        method: "PUT",
	        data: {
	            Idempresa: 2, // ID fixo ou dinâmico, dependendo da lógica do seu sistema
	            unidade: "Unidade 2",
	            email: suEmail,
	            telefone: suTelefone2, // Use outros campos para cada unidade, se necessário
	            endereco: suEndereco2,
	        },
	        success: function (response) {
	            alert("Contatos atualizados com sucesso!");
	            // Atualizar os textos na página
	            $("#email-text").text(suEmail);
				suTelefone2 = "Unidade 2: " + suTelefone2;
				suEndereco2 = "Unidade 2: " + suEndereco2;
	            $("#telefone-text-unidade-2").text(suTelefone2);
	            $("#endereco-text-unidade-2").text(suEndereco2);

	            // Alterar botão de volta
	            $("#editContactBtn-2").show();
				$("#saveContactBtn-2").hide();
	        },
	        error: function (error) {
	            alert("Erro ao atualizar os contatos.");
	            console.error(error);
	        },
	    });
	});

	$("#save-txt-cabelo").hide();
	$("#save-txt-barba").hide();
	$("#save-txt-cuidados").hide();
	
	$("#edit-txt-cabelo").click(function() {
	    // Capturar os valores atuais dos campos
	    let cabeloTXT1 = $("#Cabelo-txt-1").text();
	    let cabeloTXT2 = $("#Cabelo-txt-2").text();

	    // Criar campos editáveis
	    $("#Cabelo-txt-1").html(`<textarea id='edit-cabelo-txt-1' class='large-textarea'>${cabeloTXT1}</textarea>`);
	    $("#Cabelo-txt-2").html(`<textarea id='edit-cabelo-txt-2' class='large-textarea'>${cabeloTXT2}</textarea>`);

		// Alterar botão para salvar
		$("#save-txt-cabelo").show();
		$(this).hide();
	});

	$("#save-txt-cabelo").click(function() {
	    // Capturar os valores atuais dos campos
	    let cabeloTXT1 = $("#edit-cabelo-txt-1").val();
	    let cabeloTXT2 = $("#edit-cabelo-txt-2").val();

		// Enviar para o servidor via AJAX
		$.ajax({
			url: "app/controllers/CtrlTxtServicos.php", // Ajuste conforme seu ambiente
			method: "PUT",
			data: {
				txtServicosId: 1,
				localizacao: "Cabelo",
				texto1: cabeloTXT1,
				texto2: cabeloTXT2,
			},
			success: function (response) {
				alert("Textos do cabelo atualizados com sucesso!");
				$("#Cabelo-txt-1").text(cabeloTXT1);
				$("#Cabelo-txt-2").text(cabeloTXT2);
				// Alterar botão para salvar
				$("#save-txt-cabelo").hide();
				$("#edit-txt-cabelo").show();
			},
			error: function (error) {
				alert("Erro ao atualizar os contatos.");
				console.error(error);
			},
		});
	});

	$("#edit-txt-barba").click(function() {
	    // Capturar os valores atuais dos campos
	    let barbaTXT1 = $("#Barba-txt-1").text();
	    let barbaTXT2 = $("#Barba-txt-2").text();

	    $("#Barba-txt-1").html(`<textarea id='edit-barba-txt-1' class='large-textarea'>${barbaTXT1}</textarea>`);
	    $("#Barba-txt-2").html(`<textarea id='edit-barba-txt-2' class='large-textarea'>${barbaTXT2}</textarea>`);

		$("#save-txt-barba").show();
		$("#edit-txt-barba").hide();
	});
	
	$("#save-txt-barba").click(function() {
	    // Capturar os valores atuais dos campos
	    let barbaTXT1 = $("#edit-barba-txt-1").val();
	    let barbaTXT2 = $("#edit-barba-txt-2").val();
		

		// Enviar para o servidor via AJAX
		$.ajax({
			url: "app/controllers/CtrlTxtServicos.php", // Ajuste conforme seu ambiente
			method: "PUT",
			data: {
				txtServicosId: 2,
				localizacao: "Barba",
				texto1: barbaTXT1,
				texto2: barbaTXT2,
			},
			success: function (response) {
				alert("Textos da barba atualizados com sucesso!");
				$("#Barba-txt-1").text(barbaTXT1);
				$("#Barba-txt-2").text(barbaTXT2);
				// Alterar botão para salvar
				$("#save-txt-barba").hide();
				$("#edit-txt-barba").show();
			},
			error: function (error) {
				alert("Erro ao atualizar os contatos.");
				console.error(error);
			},
		});
	});

	$("#edit-txt-cuidados").click(function() {
	    // Capturar os valores atuais dos campos
	    let cuidadosTXT1 = $("#Cuidados-txt-1").text();
	    let cuidadosTXT2 = $("#Cuidados-txt-2").text();
		
	    // Criar campos editáveis
	    $("#Cuidados-txt-1").html(`<textarea id='edit-cuidados-txt-1' class='large-textarea'>${cuidadosTXT1}</textarea>`);
	    $("#Cuidados-txt-2").html(`<textarea id='edit-cuidados-txt-2' class='large-textarea'>${cuidadosTXT2}</textarea>`);
		
		// Alterar botão para salvar
		$("#save-txt-cuidados").show();
		$("#edit-txt-cuidados").hide();
	});
	
	$("#save-txt-cuidados").click(function() {
	    // Capturar os valores atuais dos campos
	    let cuidadosTXT1 = $("#edit-cuidados-txt-1").val();
	    let cuidadosTXT2 = $("#edit-cuidados-txt-2").val();
		

		// Enviar para o servidor via AJAX
		$.ajax({
			url: "app/controllers/CtrlTxtServicos.php", // Ajuste conforme seu ambiente
			method: "PUT",
			data: {
				txtServicosId: 3,
				localizacao: "Cuidados",
				texto1: cuidadosTXT1,
				texto2: cuidadosTXT2,
			},
			success: function (response) {
				alert("Textos da cuidados atualizados com sucesso!");
				$("#Cuidados-txt-1").text(cuidadosTXT1);
				$("#Cuidados-txt-2").text(cuidadosTXT2);
				// Alterar botão para salvar
				$("#save-txt-cuidados").hide();
				$("#edit-txt-cuidados").show();
			},
			error: function (error) {
				alert("Erro ao atualizar os contatos.");
				console.error(error);
			},
		});
	});
	
	$("#save-txt").hide();
	
	$("#edit-txt").click(function() {
	    // Capturar os valores atuais dos campos
	    let quemsomosTXT = $("#Quem-somos-txt-1").text();
		
	    // Criar campos editáveis
	    $("#Quem-somos-txt-1").html(`<textarea id='edit-quem-somos-txt' class='large-textarea'>${quemsomosTXT}</textarea>`);
		
		// Alterar botão para salvar
		$("#save-txt").show();
		$("#edit-txt").hide();
	});
	
	$("#save-txt").click(function() {
	    // Capturar os valores atuais dos campos
	    let quemsomosTXT = $("#edit-quem-somos-txt").val();
		

		// Enviar para o servidor via AJAX
		$.ajax({
			url: "app/controllers/CtrlTxtServicos.php", // Ajuste conforme seu ambiente
			method: "PUT",
			data: {
				txtServicosId: 4,
				localizacao: "Quem-somos",
				texto1: quemsomosTXT,
				texto2: '',
			},
			success: function (response) {
				alert("Texto quem somos atualizados com sucesso!");
				$("#Quem-somos-txt-1").text(quemsomosTXT);
				// Alterar botão para salvar
				$("#save-txt").hide();
				$("#edit-txt").show();
			},
			error: function (error) {
				alert("Erro ao atualizar os contatos.");
				console.error(error);
			},
		});
	});

});