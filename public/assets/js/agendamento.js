$(document).ready(function() {
    $('.btn-2').click(function() {
        // Encontra o próximo elemento com a classe "content-to-toggle"
        $(this).next('.content-to-toggle').slideToggle(); // Alterna a visibilidade
    });

    // Evento para alterar o texto do botão quando um item é clicado
    $('.content-to-toggle .itens li').click(function() {
        // Obtém o texto do item clicado
        const selectedText = $(this).text();
        
        // Encontra o botão pai correspondente e altera seu texto
        $(this).closest('.content-to-toggle').prev('.btn-2').text(selectedText);
        
        // Opcional: fecha o conteúdo após a seleção
        $(this).closest('.content-to-toggle').slideUp();
        
    });
});

