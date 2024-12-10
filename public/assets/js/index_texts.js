$(document).ready(function () {
	$.ajax({
	    url: "app/controllers/CtrlEmpresa.php", // Ajuste conforme seu ambiente
	    method: "GET",
	    success: function (response) {
			var data = JSON.parse(response);
			
			data.forEach(contato => {
				$(`#email-text`).text(contato.email);
				$(`#telefone-text-unidade-${contato.Idempresa}`).text(`Unidade ${contato.Idempresa}: ` + contato.telefone);
				$(`#endereco-text-unidade-${contato.Idempresa}`).text(`Unidade ${contato.Idempresa}: ` + contato.endereco);
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
});
