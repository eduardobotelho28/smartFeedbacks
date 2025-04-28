<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="bg-light" style="padding-top: 50px;">
  <div class="d-flex align-items-start justify-content-center">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">

      <h2 class="text-center mb-4" style="color: #1E90FF;">Bem-vindo novamente!</h2>

      <form id="loginForm">

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
        </div>

        <div class="d-grid mb-3">
          <button type="button" class="btn text-white" style="background-color: #1E90FF;" id="loginButton">Entrar</button>
        </div>

        <div class="text-center">
          <a href="<?= site_url('authentication/register') ?>" class="text-decoration-none" style="color: #1E90FF;">
            Ainda não possui sua conta? Crie agora!
          </a>
        </div>

      </form>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
