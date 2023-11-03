<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Vincule o evento de clique aos ícones com id começando com 'toggle-footer_'
        $('[id^="toggle-footer_"]').on('click', function() {
            // Extraia o ID do ícone para identificar a div correspondente
            var postId = $(this).attr('id').split('_')[1];

            // Construa o ID da div a ser exibida
            var footerId = 'card-footer_' + postId;

            // Use o método "toggle" para alternar a exibição da div com base no seu estado atual
            $('#' + footerId).toggle();
        });

        $('[id^="show-comments-button_"]').on('click', function() {
            // Extraia o ID do ícone para identificar a div correspondente
            var postId = $(this).attr('id').split('_')[1];
            
            // Construa o ID da div a ser exibida
            var commentId = 'comments_' + postId;

            // Use o método "toggle" para alternar a exibição da div com base no seu estado atual
            $('#' + commentId).toggle();
        });


    });
</script>
</body>