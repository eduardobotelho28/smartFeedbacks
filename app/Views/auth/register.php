<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Criar Conta</h2>

        <form id="registerForm" method="post" action="<?= site_url('authentication/register') ?>">

            <div class="mb-3">
                <label for="firstname" class="form-label">Nome</label>
                <input type="text" class="form-control" id="first_name" name="firstname">
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="last_name" name="lastname">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn text-white" style="background-color: #1E90FF;" id="loginButton">Criar Conta</button>
            </div>

        </form>
    </div>
</div>

<script> <?= view('auth/js/register.js') ?> </script>


<?= $this->endSection() ?>
