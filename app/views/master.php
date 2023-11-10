<?= $this->insert('_components/_topo', ['title' => $title]); ?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-md-none" href="#">
            <img src="/assets/imgs/logo2.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Início</a>
                </li>
                <a class="navbar-brand d-none d-md-block" href="#">
                    <img src="/assets/imgs/logo2.png" alt="">
                </a>
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contéudo principal -->
<main class="container mt-3">
    <?= $this->section('conteudo') ?>
</main>

<?= $this->insert('_components/_footer'); ?>