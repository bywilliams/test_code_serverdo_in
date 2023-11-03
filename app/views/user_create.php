<?php $this->layout('master', ['title' => $title]) ?>

<?php $this->start('conteudo') ?>

<h1>User Create</h1>
<p>Faça cadastro no sistema</p>

<section id="create-user">
    <form action="/user-update" method="post">
        <div class="form-group">
            <h4>Nome</h4>
            <input class="form-control" type="text" name="name" id="" placeholder="Digite seu nome">
        </div>
        <div class="form-group">
            <h4>Sobrenome</h4>
            <input class="form-control" type="text" name="lastname" id="" placeholder="Digite seu sobrenome">
        </div>
        <div class="form-group">
            <h4>E-mail</h4>
            <input class="form-control" type="email" name="email" id="" placeholder="Digite seu melhor e-mail">
        </div>
        <div class="form-group">
            <h4>Senha</h4>
            <input class="form-control" type="password" name="pasword" id="" placeholder="Digite sua melhor senha">
        </div>
        <br>
        <input class="btn btn-lg btn-success" type="submit" value="Salvar">
    </form>
</section>
<?php $this->end() ?>