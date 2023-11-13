$(document).ready(function() {

    // Desativa o botão de envio quando a página é carregada
    $('#btnSubmit').prop('disabled', true);

    // Ativa o botão de envio quando qualquer um dos campos de input é preenchido
    $('#postTitle, #postContent').on('input', function() {
        var postTitle = $('#postTitle').val();
        var postContent = $('#postContent').val();

        if (postTitle !== '' && postContent !== '') {
            $('#btnSubmit').removeClass('btn-secondary');
            $('#btnSubmit').addClass('btn-primary');
            $('#btnSubmit').prop('disabled', false);
        }
    });

    // Desativa o botão de envio quando qualquer um dos campos de input é esvaziado
    $('#postTitle, #postContent').on('input', function() {
        var postTitle = $('#postTitle').val();
        var postContent = $('#postContent').val();

        if (postTitle === '' || postContent === '') {
            $('#btnSubmit').prop('disabled', true);
            $('#btnSubmit').addClass('btn-secondary');
        }
    });

    // Requisição ajax do formulário de post
    $('#post-form').on('submit', function(e) {

        // Previne o comportamento padrão do formulário
        e.preventDefault();

        // Cria um novo objeto FormData
        var formData = new FormData(this);

        $.ajax({
            url: '/post-store', // URL do endpoint que irá processar a requisição
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var postHtml = response.post;

                if (postHtml != 'csrf_failure') {

                    // Adiciona o novo post no topo do feed
                    $('#post-feed').prepend(postHtml);

                    $('#postTitle').val('');
                    $('#postContent').val('');
                    $('#postFile').val('');

                } else {
                    Swal.fire(messages['csrf_failure']);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            }
        });
    });
    // Fim requisição ajax do formulário de post
});
