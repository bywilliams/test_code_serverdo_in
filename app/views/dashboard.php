<?php $this->layout('master', ['title' => $title]) ?>

<?php $this->start('conteudo') ?>
<div class="container mt-5">
    <h1>Feed de William</h1>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <!-- Formulário para Inserir Posts -->
            <div class="card border border-0 mb-4">
                <div class="card-header  bg-dark text-center text-white">
                    <h4>Criar publicação</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Título do Post</label>
                            <input type="text" class="form-control" id="postTitle" name="postTitle">
                        </div>
                        <div class="mb-3">
                            <label for "postContent" class="form-label">Conteúdo do Post</label>
                            <textarea class="form-control" id="postContent" name="postContent" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Imagem</label>
                            <input class="form-control" type="file" name="" id="">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- POSTS -->
    <div class="row justify-content-md-center">
        <div class="col-md-8  mb-5">
            <!-- Post 1 -->
            <?php foreach ($posts as $post): ?>
            <div class="card border border-0 mb-3">
                <div class="card-header bg-dark text-white">
                    <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Imagem de Perfil">
                    <?= $this->e($post->user_name) ?>
                    <a href="#!" onclick="togglerFooter(<?=$post->id?>)" title="opções"><i class="fas fa-ellipsis-v float-end" id="toggle-footer_<?=$post->id?>" style="cursor: pointer;"></i></a>
                </div>
                <img src="https://via.placeholder.com/1000x400" class="card-img-top" alt="Imagem do Post 1">
                <div class="card-body">
                    <h5 class="card-title">Título do Post 1</h5>
                    <p class="card-text">Conteúdo do Post 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="card-footer" id="card-footer_<?=$post->id?>" style="display: none;">
                    <button class="btn btn-primary"><i class="fas fa-thumbs-up"></i> Curtir</button>
                    <button class="btn btn-primary" id="show-comments-button_<?=$post->id?>"><i class="fas fa-comments"></i> Ver Comentários</button>
                    <button class="btn btn-warning"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
                </div>
                <div class="comments_<?=$post->id?>" id="comments_<?=$post->id?>" style="display: none;">
                    <div class="card border-bottom border-top border-start-0 border-end-0 mt-3">
                        <div class="card-body d-flex align-items-center">
                            <!-- Circle Avatar na esquerda -->
                            <div class="rounded-circle me-3" style="min-width: 50px; height: 50px; background-color: #555;"></div>
                            <!-- card-title e card-text na direita -->
                            <div>
                                <h5 class="card-title">Nome do Usuário 1</h5>
                                <p class="card-text">L de comentário 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?php $this->stop() ?>