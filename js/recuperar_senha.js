function validateEmail(email) {

    var re = /([\S[\.\S]*)+@\S+[\.\S+/]*/;
    return re.test(email);
}


$(document).ready(function() {
    // Esconde os campos de código de verificação, nova senha e botão "Entrar" no início
    $('#input2, #input3, #input4, #btn-second-2').hide();
    $("#lStatus").hide();

    // Ao clicar no botão "Enviar"
    $('#btn-second-1').click(function(event) {
        event.preventDefault(); // Evita o comportamento padrão do botão de envio
        if(   ($("#email").val()).indexOf("@") >= 0 ){

            // Esconde o campo de email e o botão "Enviar"
            $('#email, #btn-second-1, #apagar_icon').hide();
            // Mostra os campos de código de verificação, nova senha e o botão "Entrar"
            $('#input2, #input3, #input4, #btn-second-2, #lStatus').show();
            
            $.post("php/controlador/processar-recuperar-senha.php", $("#frmEmail").serialize(), function( dados ){
                var objRetorno = JSON.parse(dados);
                $("#lStatus").text(objRetorno.texto);
            })

        } else {
            $("#email").css('background-color', "#FFAAAA");
            $("#email").focus();
            $("#msgEmailInput").html("Entre com um email válido!");
            $("#msgEmailInput").show();

        }
        
    });

    // Ao clicar no botão "Entrar"
    $('#btn-second-2').click(function(event) {
        event.preventDefault(); // Evita o comportamento padrão do botão "Entrar"
        $("#lStatus").text("Aguarde um momento novamente");

        $.post("php/controlador/processar-trocar-senha.php", $("#frmSenha").serialize(), function( dados ){
            var objRetorno = JSON.parse(dados);
            $("#lStatus").text(objRetorno.texto);

            if (objRetorno.texto == "Nova senha cadastrada com sucesso"){
                window.location.href = 'index.php';
            }
        })
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
});
