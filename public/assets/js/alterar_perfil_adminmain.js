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

  // Função para alternar visibilidade da senha no campo 3
  $('#btn-password-3').click(function() {
   let inputPass = $('#password-3');
   let btnPass = $('#btn-password-3');

   if (inputPass.attr('type') === 'password') {
       inputPass.attr('type', 'text');
       btnPass.removeClass('bi-eye').addClass('bi-eye-slash');
   } else {
       inputPass.attr('type', 'password');
       btnPass.removeClass('bi-eye-slash').addClass('bi-eye');
   }
});


  // Deixa o campo de e-mail sempre em minúsculas
  $('#email').on('input', function() {
      $(this).val($(this).val().toLowerCase());
  });

$(document).ready(function() {
	$.get( '../controllers/VfyLogin.php', function(dados) {
	    var objRetorno = JSON.parse(dados)

	    if (objRetorno.usrType == "gerente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = '../../index.html';
		}
	});
    // Carregar as informações do gerente ao abrir a página

    // Ao clicar no botão de editar perfil
    $('#edit-profile-button').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Obter os valores dos campos
        let codigo = $('#codigo').val().trim();
        let nome = $('input[placeholder="Nome"]').val().trim();
        let email = $('#email').val().trim();
        let senha= $('#password-2').val().trim();
        let confirmarSenha = $('#password-3').val().trim();

        // Função de validação de email
        function validarEmail(email) {
            return email.includes('@') && email.includes('.');
        }

        // Se algum campo estiver vazio, exibir mensagem de erro
        if (codigo === '' || nome === '' || email === '' || senha === '' || confirmarSenha === '') {
            alert("Por favor, preencha todos os campos.");
        } else if (!validarEmail(email)) {
            alert("Por favor, insira um e-mail válido.");
        } else if (senha !== confirmarSenha) {
            alert("As senhas não correspondem.");
        } else {
            // Mostrar o segundo container de confirmação
            $('#first-container').hide();
            $('#second-container').show();
        }
    });

    // Ao clicar no botão de confirmar
    $('#perfilmain').on('click', function(event) {
        event.preventDefault();

        let codigo = $('#codigo').val().trim();
        let nome = $('#nome').val().trim();
        let email = $('#email').val().trim();
        let senha = $('#password-2').val().trim();

        $.ajax({
            url: "../controllers/CtrlGerente.php", // Alterando para o controlador do Gerente
            method: "PUT",
            data: {
                codigo: codigo,
                nome: nome,
                email: email,
                senha: senha
            },
            success: function(response) {
                let objRetorno = JSON.parse(response);
                if (objRetorno.status) {
                    alert("Perfil atualizado com sucesso!");
                    window.location.reload(); // Opcional: recarregar a página ou redirecionar
                } else {
                    alert(objRetorno.message);
                }
            }
        });
    });

    // Ao clicar no botão de cancelar
    $('#cperfilmain').on('click', function(event) {
        event.preventDefault();
        $('#second-container').hide();
        $('#first-container').show();
    });
});