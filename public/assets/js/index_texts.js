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
});
