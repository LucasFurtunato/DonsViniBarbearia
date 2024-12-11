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

	    if (objRetorno.usrType == "cliente"){
	        $("#login-button").text(objRetorno.name);
	    } else {
			window.location.href = '../../index.html';
		}
	});
    // Ao clicar no botão de editar perfil
    $('#edit-profile-button').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Obter os valores dos campos do formulário
        let nome = $('#name').val().trim();
        let email = $('#email').val().trim();
        let senha = $('#password-2').val().trim();
        let confirmarSenha = $('#password-3').val().trim();

        // Função de validação de email
        function validarEmail(email) {
            return email.includes('@') && email.includes('.');
        }

        // Se algum campo estiver vazio, exibir mensagem de erro
        if (nome === '' || email === '' || senha === '' || confirmarSenha === '') {
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
    $('#perfilcliente').on('click', function(event) {
        event.preventDefault();

        // Obter os dados novamente
        let nome = $('#name').val().trim();
        let email = $('#email').val().trim();
        let senha = $('#password-2').val().trim();
        
        // Aqui você pode pegar o ID do cliente via variável de sessão ou algum campo oculto no formulário
        let clienteId = $('#clienteId').val();  // Supondo que o ID do cliente seja passado assim

        // Enviar os dados para o servidor
        $.ajax({
            url: "../controllers/CtrlClienteAl.php", // URL do seu controlador
            method: "PUT",
            data: {
                clienteId: clienteId,  // ID do cliente
                nome: nome,
                email: email,
                senha: senha  // Enviar a nova senha, caso tenha sido preenchida
            },
            success: function(response) {
                let objRetorno = JSON.parse(response);
                if (objRetorno.status) {
                    alert("Perfil atualizado com sucesso!");
                    window.location.reload(); // Recarrega a página ou redireciona para outra
                } else {
                    alert(objRetorno.message); // Exibe a mensagem de erro
                }
            },
            error: function() {
                alert("Erro ao tentar atualizar o perfil.");
            }
        });
    });

    // Ao clicar no botão de cancelar
    $('#cperfilcliente').on('click', function(event) {
        event.preventDefault();
        // Esconde o segundo container e mostra o primeiro novamente
        $('#second-container').hide();
        $('#first-container').show();
    });

});


