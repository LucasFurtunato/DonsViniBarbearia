$(document).ready(function(){
	$.get( 'app/controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)

	    if (objRetorno.usrType == "gerente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = 'index.html';
		}
	});
});