<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="py-5" style="background-color: #f2f4f8;">
  <div class="container" style="max-width: 800px;">
    <div class="bg-white p-5 rounded shadow" style="border-left: 6px solid #3B82F6;">
      
      <!-- Headline chamativa -->
      <h2 class="mb-2 text-center" style="color: #1E3A8A;">Criar Novo Formulário</h2>
      <p class="text-center mb-4" style="color: #3B82F6; font-weight: 500;">Comece a coletar feedbacks agora!</p>

      <form id="create_form">

        <!-- Nome do Formulário -->
        <div class="mb-4">
          <label for="name" class="form-label fw-bold">Nome do Formulário</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Pesquisa de Satisfação Abril">
        </div>

        <!-- Principais Métricas -->
        <h5 class="mb-2" style="color: #1E3A8A;">Principais Métricas do mercado, personalize como quiser.</h5>
        <p class="text-muted mb-3" style="font-size: 0.9rem;">Clique em "Ver prévia" para ver a pergunta da métrica</p>

        <div class="metric-panel d-grid gap-3 mb-5">
          <?php
            $metrics = [
              'nps'  => ['label' => 'NPS (Net Promoter Score)', 'preview' => 'De 1 a 10, qual a chance de você recomendar a nossa empresa a um amigo?'],
              'csat' => ['label' => 'CSAT (Customer Satisfaction Score)', 'preview' => 'Como você avaliaria sua experiência ao utilizar nosso serviço? (Emojis)'],
              'cli'  => ['label' => 'CLI (Customer Loyalty Index)', 'preview' => 'De 1 a 10, qual a chance de você voltar a usar nossos serviços/produtos?'],
              'ces'  => ['label' => 'CES (Customer Effort Score)', 'preview' => 'De 1 a 7, o quão fácil foi comprar conosco?'],
              'exit_survey' => ['label' => 'Exit Survey', 'preview' => 'Por favor, nos diga o principal motivo de sua saída ou insatisfação.'],
              'stars' => ['label' => 'Estrelas/Avalição Simples', 'preview' => 'Como você classificaria nosso serviço de 1 a 5 estrelas?']
            ];
          ?>
          <?php foreach ($metrics as $key => $info): ?>
          <div class="metric-card" data-preview="<?= esc($info['preview']) ?>">
            <input class="form-check-input d-none" type="checkbox" id="add_<?= $key ?>" name="add_<?= $key ?>" value="1" checked>
            <label for="add_<?= $key ?>" class="metric-toggle fw-semibold fs-5">
              <?= esc($info['label']) ?>
              <span class="toggle-indicator"></span>
            </label>
            <button type="button" class="btn btn-outline-primary btn-sm mt-2 preview-btn" data-metric="<?= $key ?>">Ver prévia</button>
          </div>
          <?php endforeach; ?>
        </div>

        <hr class="my-4">

        <!-- Perguntas Personalizadas -->
        <h5 class="mb-2" style="color: #1E3A8A;">Perguntas Personalizadas</h5>
        <p class="text-muted mb-3" style="font-size: 0.9rem;">A SmartFeedbacks permite que você crie 2 perguntas totalmente personalizadas. Pergunte o que quiser para seu cliente.</p>

        <div class="mb-3">
          <label for="question_1" class="form-label">Pergunta 1</label>
          <input type="text" class="form-control" id="question_1" name="question_1" placeholder="Digite a primeira pergunta...">
        </div>

        <div class="mb-4">
          <label for="question_2" class="form-label">Pergunta 2</label>
          <input type="text" class="form-control" id="question_2" name="question_2" placeholder="Digite a segunda pergunta...">
        </div>

        <hr class="my-4">

        <div class="text-center">
          <button type="submit" class="btn btn-primary px-5 py-2" style="background-color: #007BFF; border: none;">
            Salvar Formulário
          </button>
        </div>

      </form>
    </div>
  </div>
</section>

<style>
  /* Painel de métricas */
  .metric-card {
    position: relative !important;
    background-color: #f9fafb !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 12px !important;
    padding: 15px 20px !important;
    cursor: pointer !important;
    transition: all 0.25s ease !important;
  }

  .metric-toggle {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    cursor: pointer !important;
    font-weight: 500 !important;
  }

  .metric-toggle .toggle-indicator {
    width: 40px !important;
    height: 20px !important;
    background-color: #e5e7eb !important;
    border-radius: 10px !important;
    position: relative !important;
    transition: 0.25s !important;
  }

  .metric-toggle .toggle-indicator::after {
    content: "" !important;
    width: 18px !important;
    height: 18px !important;
    background-color: white !important;
    border-radius: 50% !important;
    position: absolute !important;
    top: 1px !important;
    left: 1px !important;
    transition: 0.25s !important;
  }

  input[type="checkbox"]:checked + .metric-toggle .toggle-indicator {
    background-color: #3B82F6 !important;
  }

  input[type="checkbox"]:checked + .metric-toggle .toggle-indicator::after {
    transform: translateX(20px) !important;
  }
</style>

<script> <?= view('userForms/js/create.js') ?> </script>

<?= $this->endSection() ?>
