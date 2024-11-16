
    

    $(document).ready(function() {
        $("#lStatus").hide();
        // Ao clicar no botão de editar perfil
        $('#btn-second-1').on('click', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do botão
            
            // Verificar se todos os campos estão preenchidos
            let email = $('#email').val().trim();
    
            // Função de validação de email
            function validarEmail(email) {
                return email.includes('@') && email.includes('.');
            }
    
            // Se algum campo estiver vazio, exibir mensagem de erro
            if (email === '') {
                alert("Por favor, preencha todos os campos.");
            } else if (!validarEmail(email)) {
                // Verificar se o email contém "@" e "."
                alert("Por favor, insira um e-mail válido.");
            }
             else {
                $("#lStatus").show();

                $.post("php/controlador/processar-recuperar-senha.php", $("#frmEmail").serialize(), function( dados ){
                    var objRetorno = JSON.parse(dados);

                    // Se o email for válido, mostrar o próximo container
                    if (objRetorno.valCompo == "true") {
                        $('#frmEmail').hide();
                        $('#frmSenha').show();
                        $("#lStatus").text(objRetorno.texto);
                    } else {
                        $("#lStatus").text(objRetorno.texto);
                    }
                    
                })
            }
        });

        $('#btn-second-2').on('click', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do botão
            
            // Verificar se todos os campos estão preenchidos
            let codigo = $('#codigo').val().trim();
            let senha = $('#password-1').val().trim();
            let confirmarSenha = $('#password-2').val().trim();
    
            // Se algum campo estiver vazio, exibir mensagem de erro
            if (codigo === '' || senha === '' || confirmarSenha === '') {
                alert("Por favor, preencha todos os campos.");
            }
             else if (senha !== confirmarSenha) {
                // Verificar se as senhas não correspondem
                alert("As senhas do funcionário não correspondem. Por favor, tente novamente.");
            } 
            else{
                $("#lStatus").text("Aguarde um momento novamente");

                $.post("php/controlador/processar-trocar-senha.php", $("#frmSenha").serialize(), function( dados ){
                    var objRetorno = JSON.parse(dados);
                    $("#lStatus").text(objRetorno.texto);

                    if (objRetorno.texto == "Nova senha cadastrada com sucesso"){
                        window.location.href = 'index.php';
                    }
                });
            }
        });

    });

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

    // Deixa o campo de e-mail sempre em minúsculas
    $('#email').on('input', function() {
        $(this).val($(this).val().toLowerCase());
    });
