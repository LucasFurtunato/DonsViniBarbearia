$(document).ready(function() {
	$('.btn').hide();
	// Função para pegar o parâmetro 'token' da URL
	function getUrlParameter(name) {
	    var url = new URL(window.location.href);
	    return url.searchParams.get(name);
	}

	// Obtendo o token da URL
	var token = getUrlParameter('token');
	
	data = {
		token: token
	};
	
	$.ajax({
	    url: "../controllers/CtrlCliente.php",
	    method: "PUT",
	    data: data,
	    success: function(response) {
			console.log(response);
	        var objRetorno = JSON.parse(response);

	        if(objRetorno.status == false) {
	            $('#status').text(objRetorno.message);
				$('.btn').show();
	        } else {
	            $('#status').text(objRetorno.message);
				$('.btn').show();
	        }
	    },
	    error: function(xhr, status, error) {
	        $('#responseArea').text("Erro na requisição: " + error);
	    }
	});
	
	
	$('.btn-1').click(function() {
		window.location.href = 'login-cadastro.html';
	});

	
});