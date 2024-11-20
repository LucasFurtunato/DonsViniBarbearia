$(document).ready(function() {
    $('#add-row').click(function() {
        // Dados da nova linha
        const newRow = `
            <tr>
                <td data-label="Nome Fun."><p>Funcionário Novo</p></td>
                <td data-label="Dia">XX/XX/XX</td>
                <td data-label="Horário">00:00</td>
                <td data-label="Serviços">Serviço Novo</td>                    
                <td data-label="Nome Cliente"> Cliente Novo</td>      
                <td data-label="Situação"><a href="#" class="btn">Nova</a></td>              
            </tr>
        `;
        // Adiciona a nova linha ao tbody
        $('#table-body').append(newRow);
    });
});

$(document).ready(function() {
    $('.btn').on('click', function() {
        const $btn = $(this);
        
        if ($btn.css('background-color') === 'rgb(50, 205, 50)') { // Verde
            $btn.css('background-color', '#ff1046'); // Muda para vermelho
            $btn.text('Pendente'); // Altera o texto
        } else if ($btn.css('background-color') === 'rgb(255, 16, 70)') { // Vermelho
            $btn.css('background-color', '#32cd32'); // Muda para verde
            $btn.text('Feito'); // Altera o texto
        }
    });
});
