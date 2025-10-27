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

  .example-card {
    max-width: 900px;
    margin: 0 auto;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .example-card img {
    width: 100%;
    height: 420px;
    object-fit: contain;
    /* Mostra a imagem inteira (zoom-out visual) */
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 0.5rem 0.5rem 0 0;
    transition: transform 0.3s ease;
  }

  .example-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  .example-card:hover img {
    transform: scale(1.02);
  }
</style>

<section id="inicio" class="py-5" style="background-color: #E8F1FF;">
  <div class="container text-center" style="max-width: 90%;">

    <div class="mb-5">
      <h1 class="fw-bold mb-3" style="color: #007BFF;">Potencialize seu negócio com feedbacks reais</h1>
      <p class="lead mx-auto" style="color: #1E3A8A; max-width: 800px;">
        Conecte-se com seus clientes através de formulários e avaliações personalizadas.
        Obtenha <strong>feedbacks valiosos</strong> para evoluir seus serviços e aumentar sua satisfação.
      </p>
    </div>

    <div class="text-center mb-5">
      <h2 class="h4 fw-bold mb-4" style="color: #1E3A8A;">Benefícios do sistema</h2>
      <ul class="custom-list d-inline-block text-start" style="list-style: none; padding-left: 0; font-size: 1.05rem;">
        <li style="position: relative; padding-left: 1.8rem; margin-bottom: 0.75rem;">
          <span style="position: absolute; left: 0; color: #007BFF;">✔</span>
          Receba avaliações de forma rápida e organizada.
        </li>
        <li style="position: relative; padding-left: 1.8rem; margin-bottom: 0.75rem;">
          <span style="position: absolute; left: 0; color: #007BFF;">✔</span>
          Identifique pontos fortes e oportunidades de melhoria.
        </li>
        <li style="position: relative; padding-left: 1.8rem; margin-bottom: 0.75rem;">
          <span style="position: absolute; left: 0; color: #007BFF;">✔</span>
          Melhore seus serviços com base em dados reais.
        </li>
        <li style="position: relative; padding-left: 1.8rem;">
          <span style="position: absolute; left: 0; color: #007BFF;">✔</span>
          Ganhe vantagem competitiva com insights valiosos.
        </li>
      </ul>
    </div>

    <div class="row g-4 justify-content-center mb-5">
      <div class="col-12">
        <div class="card example-card border-0 shadow-sm rounded-3">
          <img src="<?= base_url('exemplos/exemplo-criacao-form.png') ?>"
            alt="Criação de Formulário">
          <div class="card-body">
            <h4 class="fw-bold" style="color: #007BFF;">Crie Formulários</h4>
            <p class="text-muted mb-0">Monte formulários personalizados e comece a coletar feedbacks em minutos.</p>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card example-card border-0 shadow-sm rounded-3">
          <img src="<?= base_url('exemplos/exemplo-resposta-form.png') ?>"
            alt="Respostas de Clientes">
          <div class="card-body">
            <h4 class="fw-bold" style="color: #007BFF;">Receba Respostas</h4>
            <p class="text-muted mb-0">Seus clientes respondem de forma simples, rápida e totalmente anônima.</p>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card example-card border-0 shadow-sm rounded-3">
          <img src="<?= base_url('exemplos/exemplo-feedback.png') ?>"
            alt="Visualização de Feedbacks">
          <div class="card-body">
            <h4 class="fw-bold" style="color: #007BFF;">Analise os Resultados</h4>
            <p class="text-muted mb-0">Visualize métricas e insights em tempo real para decisões mais assertivas.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center">
      <h2 class="h4 fw-bold mb-2" style="color: #1E3A8A;">Clientes satisfeitos, seu negócio evoluindo 🚀</h2>
      <p class="text-muted mx-auto" style="max-width: 700px;">
        Entender os pontos de melhoria do seu produto é a chave para o sucesso.
        Nosso sistema ajuda você a transformar opiniões em resultados reais!
      </p>
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

<section id="contato" class="py-5" style="background-color: #E8F1FF;">
  <div class="container text-center">
    <div class="p-5 rounded-4 shadow-sm mx-auto" style="max-width: 700px; background-color: #FFFFFF;">
      <h2 class="mb-3 fw-bold" style="color: #007BFF;">Entre em Contato</h2>
      <p class="text-muted mb-4">Dúvidas, sugestões ou suporte? Entre em contato.</p>

      <div style="font-size: 1.1rem; color: #1E3A8A;">
        <p class="mb-2">
          <i class="bi bi-envelope-fill me-2" style="color:#007BFF;"></i>
          <strong>Email:</strong> contato@smartfeedbacks.com.br
        </p>

      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>