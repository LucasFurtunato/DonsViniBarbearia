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

//Verificar se o campo de senha está preenchido

$(document).ready(function() {
    $('.btn1').on('click', function(event) {
        event.preventDefault();
        
        const passwordInput = $(this).closest('.form').find('input[type="password"]');
        
        if (passwordInput.val().trim() === '') {
            alert('Por favor, preencha o campo de senha.');
        } 
    });
});

//Esconder tabela e apararecer confirmar senha - alterar dados
$(document).ready(function() {
    $("#alterar_dados").click(function() {
        $("#table").hide();            // Esconde o elemento com id 'table'
        $("#first-container").show();  // Exibe o elemento com id 'first-container'
    });
});

//Esconder tabela e apararecer confirmar senha - excluir
$(document).ready(function() {
    $("#excluir_dados").click(function() {
        $("#table").hide();            // Esconde o elemento com id 'table'
        $("#second-container").show();  // Exibe o elemento com id 'first-container'
    });
});