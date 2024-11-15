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


//Redefinir senha produto e alterar produto
$(document).ready(function() {
    $('#btn-alterar').on('click', function() {
        let serviços = $('#services').val().trim();
        let preços = $('#prices').val().trim();
    
        if (serviços === '' || preços === '') {
            alert("Por favor, preencha os campos de serviço e preço.");
        } else {
            // Se todos os campos estiverem preenchidos corretamente
            $('#table-container-1').hide();
            $('#table-container-2').hide();
            $('#hr').hide();
            $('#fourth-container').show();
        }
    
    });

    $('#edit-password-change').on('click', function() {
        let password = $('#password-1').val().trim();

        if( password === '') {
            alert("Por favor, preencha o campo de redefinir senha.")
        } else{
            $('#first-content').show();
            $('#fourth-container').hide();
        }
    });

    // Ao clicar no botão de cancelar
    $('.cancel-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Esconder o segundo container e mostrar o primeiro novamente
        $('#first-content').hide();
        $('#table-container-1').show();
        $('#table-container-2').show();
        $('#hr').show();
    });
});




//Redefinir senha produto e excluir produto
$(document).ready(function() {
    $('#btn-excluir').on('click', function() {
        let serviço = $('#services').val().trim();
        let preço = $('#prices').val().trim();
    
        if (serviço === '' || preço === '') {
            alert("Os campos devem estar preenchidos, caso contrário não é possível excluir.");
        } else {
            // Se todos os campos estiverem preenchidos corretamente
            $('#table-container-1').hide();
            $('#table-container-2').hide();
            $('#hr').hide();
            $('#fifth-container').show();
        }
        
    });
    
    $('#edit-password-exclusion').on('click', function() {
        let password = $('#password-2').val().trim();

        if( password === '') {
            alert("Por favor, preencha o campo de redefinir senha.")
        } else{
            $('#second-container').show();
            $('#fifth-container').hide();
        }
    });

    // Ao clicar no botão de cancelar
    $('.cancel-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Esconder o segundo container e mostrar o primeiro novamente
        $('#second-container').hide();
        $('#table-container-1').show();
        $('#table-container-2').show();
        $('#hr').show();
    });
});



//Para cadastrar produto
$(document).ready(function() {
    $('#register-product').on('click', function() {
        let serviço = $('#service').val().trim();
        let preço = $('#price').val().trim();
    
        if (serviço === '' || preço === '') {
            alert("Por favor, preencha os campos de serviço e preço.");
        } else {
            // Se todos os campos estiverem preenchidos corretamente
            $('#table-container-1').hide();
            $('#table-container-2').hide();
            $('#hr').hide();
            $('#sixth-container').show();
        }
        
    });

    $('#edit-password-product').on('click', function() {
        let password = $('#password-3').val().trim();

        if( password === '') {
            alert("Por favor, preencha o campo de redefinir senha.")
        } else{
            $('#third-container').show();
            $('#sixth-container').hide();
        }
    });
    
    // Ao clicar no botão de cancelar
    $('.cancel-btn').on('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do botão

        // Esconder o segundo container e mostrar o primeiro novamente
        $('#third-container').hide();
        $('#table-container-1').show();
        $('#table-container-2').show();
        $('#hr').show();
    });
});



