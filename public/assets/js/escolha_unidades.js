$(document).ready(function () {
	$.get( '../controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)

	    if (objRetorno.usrType == "cliente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = '../../index.html';
		}
	});
	
    $(".card").on("click", function () {
        // Remove a seleção anterior
        $(".card").removeClass("selected");

        // Adiciona a classe 'selected' ao card clicado
        $(this).addClass("selected");

        // Obtém o valor do card selecionado
        const selectedValue = $(this).data("value");

        // Exibe o valor selecionado no console (ou utilize conforme a necessidade)
        console.log("Card selecionado:", selectedValue);
        window.location.href = 'agendamento.html?unidade=' + selectedValue;
    });
});