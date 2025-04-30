<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section id="inicio" class="py-5 text-center" style="background-color: #1E3A8A; color: white;">
  <div class="container">
    <h2 class="mb-4">Bem-vindo ao Sistema de Feedbacks</h2>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec feugiat ipsum ac arcu fermentum, sed finibus magna pretium.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac felis nec lorem pretium pharetra. In vitae neque id magna posuere tempus.</p>
  </div>
</section>

<section id="como-funciona" class="py-5 bg-white text-center">
  <div class="container">
    <h2 class="mb-4" style="color: #1E3A8A;">Como Funciona</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm" style="border-left: 5px solid #3B82F6;">
          <div class="card-body">
            <h5 class="card-title" style="color: #1E3A8A;">1. Cadastre-se</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nec finibus ex.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm" style="border-left: 5px solid #3B82F6;">
          <div class="card-body">
            <h5 class="card-title" style="color: #1E3A8A;">2. Crie Formulários</h5>
            <p class="card-text">Nullam ut libero in urna eleifend fermentum. Suspendisse vel dolor vitae ligula fermentum bibendum.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm" style="border-left: 5px solid #3B82F6;">
          <div class="card-body">
            <h5 class="card-title" style="color: #1E3A8A;">3. Receba Feedbacks</h5>
            <p class="card-text">Praesent commodo nulla non ante convallis, sed ultrices ex convallis. Proin at magna nisi.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="contato" class="py-5 text-center" style="background-color: #3B82F6; color: white;">
  <div class="container">
    <h2 class="mb-4">Contato</h2>
    <p class="lead">Entre em contato conosco para dúvidas, sugestões ou suporte.</p>
    <p>Email: contato@sistemadefeedbacks.com.br</p>
    <p>Telefone: (11) 99999-9999</p>
  </div>
</section>

<?= $this->endSection() ?>
