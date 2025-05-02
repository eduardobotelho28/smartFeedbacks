<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
  .custom-list {
    list-style: none;
    padding-left: 0;
  }

  .custom-list li {
    position: relative;
    padding-left: 1.8rem;
    margin-bottom: 0.75rem;
    line-height: 1.5;
  }

  .custom-list li::before {
    content: "✔";
    position: absolute;
    left: 0;
    color: #1E3A8A;
    font-weight: bold;
  }
</style>

<section id="inicio" class="">
  <div class="container" style="max-width: 80%;">
    <div class="p-5 rounded shadow-sm" style="background-color: #e9ecef; border-left: 4px solid #007BFF;">

      <h1 class="mb-4" style="color: #007BFF;">Potencialize seu negócio com feedbacks reais</h1>

      <h2 class="h4 mb-3">Conecte-se com seus clientes</h2>
      <p>Através de formulários e métodos de avaliações personalizados, obtenha <strong>feedbacks valiosos</strong> para seu negócio.</p>

      <h2 class="h4 mt-5 mb-3" style="margin-top: 5rem;">Benefícios do sistema</h2>
      <ul class="custom-list">
        <li>Receba avaliações de forma rápida e organizada.</li>
        <li>Identifique pontos fortes e oportunidades de melhoria.</li>
        <li>Melhore seus serviços com base em dados reais.</li>
        <li>Ganhe vantagem competitiva com insights valiosos.</li>
      </ul>

      <div class="row mt-5 align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <h2 class="h4">Clientes satisfeitos, seu negócio evoluindo 🚀</h2>
          <p>Entender os pontos de melhoria na seu produto é a chave para seu negócio prosperar!</p>
        </div>
        <div class="col-md-6 text-center">
          <img src="https://images.pexels.com/photos/3184405/pexels-photo-3184405.jpeg?auto=compress&cs=tinysrgb&h=400" alt="Cliente satisfeito" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
        </div>
      </div>

    </div>
  </div>
</section>

<section id="como-funciona" class="py-5 bg-white text-center">
  <div class="container">
    <h2 class="mb-3" style="color: #1E3A8A;">Como Funciona</h2>
    <p class="mb-5 text-muted">Veja como é simples começar a coletar feedbacks dos seus clientes.</p>

    <div class="row g-4">
      <div class="col-md-6">
        <div class="card h-100 shadow-sm" style="border-left: 5px solid #3B82F6; padding: 2rem;">
          <div class="card-body">
            <h5 class="card-title" style="color: #1E3A8A;">1. Cadastre-se</h5>
            <p class="card-text mt-3">Entre em nosso sistema através de um cadastro simples e intuitivo.</p>
            <button class="btn btn-primary" style="background-color: #007BFF"> <a href="<?= site_url('authentication/register') ?>" style="color:white">Quero me cadastrar</a></button>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card h-100 shadow-sm" style="border-left: 5px solid #3B82F6; padding: 2rem;">
          <div class="card-body">
            <h5 class="card-title" style="color: #1E3A8A;">2. Crie Formulários</h5>
            <p class="card-text mt-3">Crie seus formulários e avaliações personalizadas de acordo com a necessidade de seu negócio.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card h-100 shadow-sm" style="border-left: 5px solid #3B82F6; padding: 2rem;">
          <div class="card-body">
            <h5 class="card-title" style="color: #1E3A8A;">3. Envie para seus clientes</h5>
            <p class="card-text mt-3">Disponibilize seus formulários através de Links e QR codes!.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card h-100 shadow-sm" style="border-left: 5px solid #3B82F6; padding: 2rem;">
          <div class="card-body">
            <h5 class="card-title" style="color: #1E3A8A;">4. Receba Feedbacks</h5>
            <p class="card-text mt-3">Receba a analise seus feedbacks de maneira automatizada e centralizada em nossa ferramenta.</p>
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
