$(document).ready(function() {

    // Vincula o evento de clique ao ícone com id 'toggle-footer_'
    $(document).on('click', '[id^="toggle-footer_"]', function() {

        // Extrai o ID do ícone para identificar a div correspondente
        var postId = $(this).attr('id').split('_')[1];

        // Constroi o ID da div a ser exibida
        var footerId = 'card-footer_' + postId;

        // Usa o método "toggle" para alternar a exibição da div com base no seu estado atual
        $('#' + footerId).toggle();
    });

    // Vincula o evento de clique ao ícone com id 'show-comments-button_'
    $(document).on('click', '[id^="show-comments-button_"]', function() {

        // Extrai o ID do ícone para identificar a div correspondente
        var postId = $(this).attr('id').split('_')[1];

        // Constroi o ID da div a ser exibida
        var commentId = 'comments_' + postId;

        // Usa o método "toggle" para alternar a exibição da div com base no seu estado atual
        $('#' + commentId).toggle();
    });

});