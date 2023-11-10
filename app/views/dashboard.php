<?php $this->layout('master', ['title' => $title]) ?>

<?php $this->start('conteudo') ?>
<div class="container mt-5">

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <?php if ($status !== '') : ?>
                <div class="d-block status-message <?= $status ?>"><?= $status_message ?></div>
            <?php endif ?>
            
            <!-- Form para Inserir Posts -->
            <div class="card border border-0 mb-4">
                <div class="card-header  bg-dark text-center text-white">
                    <h4>Criar post</h4>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="post-form">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Título do Post</label>
                            <input type="text" class="form-control" id="postTitle" name="postTitle">
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Conteúdo do Post</label>
                            <textarea class="form-control" id="postContent" name="postContent" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postFile" class="form-label">Imagem</label>
                            <input class="form-control" name="postFile" id="postFile" type="file">
                        </div>
                        <button type="submit" class="btn btn-secondary" id="btnSubmit">Publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-8 mb-5">
            <div id="post-feed">
            </div>
        </div>
    </div>

    <!-- POSTS -->
    <div class="row justify-content-md-center">
        <h1>Feed de William</h1>
        <div class="col-md-8  mb-5">
            <?php foreach ($posts as $post) : ?>
                <div class="card border border-0 mb-3">
                    <div class="card-header bg-dark text-white">
                        <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Imagem de Perfil">
                        <?= $this->e($post->user_name) ?>
                        <a href="#!" onclick="togglerFooter(<?= $post->id ?>)" title="opções"><i class="fas fa-ellipsis-v float-end" id="toggle-footer_<?= $post->id ?>" style="cursor: pointer;"></i></a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $this->e($post->title) ?></h5>
                        <p class="card-text"><?= $this->e($post->description) ?></p>
                    </div>
                    <?php if ($this->e($post->image)): ?>
                        <img src="assets/imgs/posts/<?= $this->e($post->image) ?>" class="card-img-top" alt="Imagem do Post 1">
                    <?php endif ?>
                    <div class="card-footer" id="card-footer_<?= $post->id ?>" style="display: none;">
                        <button class="btn btn-primary" id="show-comments-button_<?= $post->id ?>"><i class="fas fa-comments"></i> Comentários</button>
                        <button class="btn btn-warning"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
                    </div>
                    <div class="comments" id="comments_<?= $post->id ?>" style="display: none;">
                        <div class="card border-bottom border-top border-start-0 border-end-0 mt-3">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle me-3" style="min-width: 50px; height: 50px; background-color: #555;"></div>
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
<?php $this->end() ?>

<script>
    

</script>