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
        $("#statusCadastro").hide();
        // Ao clicar no botão de editar perfil
        $('#edit-profile-button').on('click', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do botão
            
            // Verificar se todos os campos estão preenchidos
            let codigo = $('#codigo').val().trim();
            let nome = $('input[placeholder="Nome"]').val().trim();
            let email = $('#email').val().trim();
            let unidade = $('#unidade').val();
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
                alert($("#frmCadastroFun").serialize())
                $("#statusCadastro").show();
                $.post("php/controlador/processar_cadastro_fun.php", $("#frmCadastroFun").serialize(), function ( dados ) {
                    var objRetorno = JSON.parse(dados);
                    console.log(dados)
                    alert(objRetorno.erro)
                })
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
    
