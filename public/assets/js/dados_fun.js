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
    $(document).on('click','#alterar_dados',function(event) {
        event.preventDefault();
        $("#table").hide();            // Esconde o elemento com id 'table'
        $("#first-container").hide();
        $("#alterar-container").show();  // Exibe o elemento com id 'first-container'
    });
});

//Esconder tabela e apararecer confirmar senha - excluir
$(document).ready(function() {
    $("#excluir_dados").click(function() {
        $("#table").hide();            // Esconde o elemento com id 'table'
        $("#second-container").show();  // Exibe o elemento com id 'first-container'
    });
});

$(document).ready(function(){
    $.ajax({
        url: "../app/controllers/CtrlFuncionario.php",
        method: "GET",
        success: function(response) {
            console.log(response)
            var data = JSON.parse(response);

               // Limpar a tabela antes de adicionar novos dados
            $('#table-body').empty();

            // Inserir dados de Corte
            data.forEach(fun => {
                $('#table-body').append(`
                    <tr data-id="${fun.funcinarioId}">
						<td data-label="Nome Fun.">
                        ${fun.nome}
	                    </td>
						<td data-label="Email">
                        ${fun.email}
	                    </td>
	                    <td data-label="Unidade">
                        ${fun.unidadeId}
	                    </td>   
                        <td data-label="Código">
                        ${fun.codigo}
	                    </td>   
                        <td data-label="Ações">
                        <div class="btn-group">
                            <a href="#" class="btn" id="alterar_dados">Alterar dados</a>
                            <a href="#" class="btn, delete" id="excluir_dados">Excluir</a>
                        </div>
                    </td>
                    </tr>
                `);
            });
            
        },
        error: function(xhr, status, error) {
            $('#responseArea').text("Erro na requisição: " + error);
        }
    });
});
