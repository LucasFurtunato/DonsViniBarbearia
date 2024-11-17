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



    $(document).ready(function() {
        // Ao clicar no botão de editar perfil
        $('#edit-profile-button').on('click', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do botão
            
            // Verificar se todos os campos estão preenchidos
            let codigo = $('#codigo').val().trim();
            let nome = $('#nome').val().trim();
            let email = $('#email').val().trim();
            let unidade = $('#unidadeId').val();
            let senhaFuncionario = $('#password-2').val().trim();
            let confirmarSenhaFuncionario = $('#password-3').val().trim();
    
            // Função de validação de email
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
                // Se todos os campos estiverem preenchidos corretamente e o email for válido, mostrar o próximo container
                $.ajax({
                    url: "../app/controllers/CtrlFuncionario.php",
                    method: "POST",
                    data: $("#form-fun").serialize(),
                    success: function(response) {
                        console.log(response);
                        var objRetorno = JSON.parse(response);
    
                        if(objRetorno.status === "error") {
                            console.log('errado');
                            $('#responseArea').text("errado");
                        } else {
                            $('#responseArea').text("Registrado");
                        }
                        $('#first-container').hide();
                        $('#second-container').show();
                    },
                    error: function(xhr, status, error) {
                        $('#responseArea').text("Erro na requisição: " + error);
                    }
                });
            }
        });
    
        // Ao clicar no botão de cancelar
        $('.cancel-btn').on('click', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do botão
    
            // Esconder o segundo container e mostrar o primeiro novamente
            $('#second-container').hide();
            $('#first-container').show();
        });

    });


