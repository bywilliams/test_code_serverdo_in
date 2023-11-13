$(document).ready(function() {

    // Pega cada form edit
    $('form[id^="post-form-edit-"]').each(function() {

        var form = $(this); // formulário atual no loop
        
        form.on('submit', function(e) {

            // Previne o comportamento padrão do formulário
            e.preventDefault();

            var messages = {
                'success': 'Post atualizado com sucesso!',
                'csrf_failure': 'Ação inválida!'
            }

            var id = $(this).find('input[name="id"]').val();
            var url = '/post-edit/' + id;

            // Cria um novo objeto FormData
            var formData = new FormData(this);

            $.ajax({
                url: url, // URL do endpoint que irá processar a requisição
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //console.error(textStatus, errorThrown);
                }
            });
        });
    });
    // Fim requisição ajax do formulário de post
});
