   // Função para alternar visibilidade da senha no campo 1
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
  
    // Função para alternar visibilidade da senha no campo 2
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


    var data = {};
    //Para cadastrar produto
    $(document).ready(function() {
      $('#edit-profile-button').on('click', function(event) {

         // Verificar se todos os campos estão preenchidos
        let codigo = $('#codigo').val().trim();
        let nome = $('#nome').val().trim();
        let email = $('#email').val().trim();
        let unidade = $('#unidadeId').val();
        let senhaFuncionario = $('#password-2').val().trim();
        let confirmarSenhaFuncionario = $('#password-3').val().trim();

		
		// Crie um objeto para armazenar as informações
		let formData = {
            codigo: codigo,
            nome:nome,
            email: email,
            unidade: unidade,
            senhaFuncionario: senhaFuncionario,
            confirmarSenhaFuncionario: confirmarSenhaFuncionario
		};
        function validarEmail(email) {
            return email.includes('@') && email.includes('.');
        }
        // Se algum campo estiver vazio, exibir mensagem de erro
        if (codigo === '' || nome === '' || email === '' || unidade === '' || senhaFuncionario === '' || confirmarSenhaFuncionario === '') {
            alert("Por favor, preencha todos os campos.");
        } else if (!validarEmail(email)) {
            // Verificar se o email contém "@" e "."
            alert("Por favor, insira um e-mail válido.");
        } else if (senhaFuncionario !== confirmarSenhaFuncionario) {
            // Verificar se as senhas não correspondem
            alert("As senhas do funcionário não correspondem. Por favor, tente novamente.");
        } else {
            // Se todos os campos estiverem preenchidos corretamente
            $('#first-container').hide();
            $('#second-container').show();
			
			data = formData;
        }
      });
    });

    function restoreFormFields(data) {
        $('#codigo').val(data.codigo || '');
        $('#nome').val(data.nome || '');
        $('#email').val(data.email || '');
        $('#unidadeId').val(data.unidade || '');
        $('#password-2').val(data.senhaFuncionario || '');
        $('#password-3').val(data.confirmarSenhaFuncionario || ''); }
    $(document).ready(function() {
        // Ao clicar no botão de editar perfil
        $('#add-profile-button').on('click', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do botão
                // Se todos os campos estiverem preenchidos corretamente e o email for válido, mostrar o próximo container
                $.ajax({
                    url: "../app/controllers/CtrlFuncionario.php",
                    method: "POST",
                    data: $("#form-fun").serialize() ,
                    success: function(response) {
                        console.log(response);
                        var objRetorno = JSON.parse(response);
                        if(objRetorno.status === "error") {
                            $('#responseArea').text("Email errado");
                            console.log('errado');
                            $('#second-container').hide();
                            $('#first-container').show();

                        } else { 
                            let data = {}
                            restoreFormFields(data);
                            $('#second-container').hide();
                            $('#first-container').show();     
                            $('#responseArea').text("Registrado");
                            console.log('registrado');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#responseArea').text("Erro na requisição: " + error);
                    }
                });
    
        });
    
        // Ao clicar no botão de cancelar
        $('.cancel-btn').on('click', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do botão
    
            // Esconder o segundo container e mostrar o primeiro novamente
            restoreFormFields(data); 
            $('#second-container').hide();
            $('#first-container').show();
            
        });

    });



