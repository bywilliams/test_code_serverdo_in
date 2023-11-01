<?php $this->layout('master', ['title' => $title]) ?>

<h1>User Profile</h1>
<p>User create</p>

<form action="/user-update" method="post">
    <label for="">Nome</label>
    <input type="text" name="name" id="">
    <label for="">Sobrenome</label>
    <input type="text" name="lastname" id="">
    <label for="">E-mail</label>
    <input type="email" name="email" id="">
    <label for="">Senha</label>
    <input type="password" name="pasword" id="">
    <input type="submit" value="Salvar">
</form>