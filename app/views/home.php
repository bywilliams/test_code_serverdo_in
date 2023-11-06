<?php echo $this->insert('_components/_topo', ['title' => $title]); ?>

<div class="container-fluid d-flex align-items-center justify-content-center" id="container-form">
    <div class="form-container" id="login-form">
        <?php  if ($status !== '') : ?>
            <div class="d-block status-message <?= $status ?>"><?= $status_message ?></div>
        <?php endif ?>
        <div class="text-center">
            <i class="fas fa-people-arrows fa-5x mb-3"></i>
        </div>
        <h1>Login</h1>
            <form>
                <label for="username">E-mail</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
            <p>Cadastrar-se gratis? <a href="#" id="signup-link">Cadastrar</a></p>
        </div>

        <div class="form-container" id="signup-form" style="display: none;">
            <div class="text-center">
                <i class="fas fa-people-arrows fa-5x mb-3"></i>
            </div>
            <h1>Registrar</h1>
            <form>
                <label for="new-email">E-mail</label>
                <input type="email" id="new-email" name="new-email" required placeholder="seu melhor e-mail">
                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="new-password" required placeholder="sua melhor senha">
                <button type="submit">Cadastrar</button>
            </form>
            <p>Já possuo uma conta? <a href="#" id="login-link">Login</a></p>
        </div>
    </div>

<?php echo $this->insert('_components/_footer'); ?>

<script>
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const loginLink = document.getElementById('login-link');
    const signupLink = document.getElementById('signup-link');

    loginLink.addEventListener('click', (event) => {
        event.preventDefault();
        signupForm.style.display = 'none';
        loginForm.style.display = 'block';

        setTimeout(() => {
            signupForm.style.opacity = 0;
            loginForm.style.opacity = 1;
        }, 10);
    });

    signupLink.addEventListener('click', (event) => {
        event.preventDefault();
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';

        setTimeout(() => {
            loginForm.style.opacity = 0;
            signupForm.style.opacity = 1;
        }, 10);
    });
</script>