<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="py-5" style="background-color: #f2f4f8;">
  <div class="container" style="max-width: 800px;">
    <div class="bg-white p-5 rounded shadow" style="border-left: 6px solid #3B82F6;">
      <h2 class="mb-4 text-center" style="color: #1E3A8A;">Criar Novo Formulário</h2>

      <form id="create_form">

        <div class="mb-4">
          <label for="name" class="form-label fw-bold">Nome do Formulário</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Pesquisa de Satisfação Abril">
        </div>

        <h5 class="mb-4" style="color: #1E3A8A;">Perguntas Padrão</h5>

        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" id="add_nps" name="add_nps" value="1" checked>
          <label class="form-check-label fw-semibold fs-5" for="add_nps">
            Incluir pergunta NPS
          </label>
          <p class="ms-4 mt-2 text-muted">
            <small>* NPS (Net Promoter Score) mede a lealdade do cliente. Pergunta: <em>"De 0 a 10, qual a chance de você recomendar a nossa empresa a um amigo?"</em></small>
          </p>
        </div>

        <div class="form-check mb-5">
          <input class="form-check-input" type="checkbox" id="add_csat" name="add_csat" value="1" checked>
          <label class="form-check-label fw-semibold fs-5" for="add_csat">
            Incluir pergunta CSAT
          </label>
          <p class="ms-4 mt-2 text-muted">
            <small>* CSAT (Customer Satisfaction Score) mede satisfação geral. Pergunta: <em>"Como você avaliaria sua experiência ao utilizar nosso serviço?"</em></small>
          </p>
        </div>

        <hr class="my-4">

        <h5 class="mb-3" style="color: #1E3A8A;">Perguntas Personalizadas</h5>

        <div class="mb-3">
          <label for="question_1" class="form-label">Pergunta 1</label>
          <input type="text" class="form-control" id="question_1" name="question_1" placeholder="Digite a primeira pergunta...">
        </div>

        <div class="mb-3">
          <label for="question_2" class="form-label">Pergunta 2</label>
          <input type="text" class="form-control" id="question_2" name="question_2" placeholder="Digite a segunda pergunta...">
        </div>

        <div class="mb-4">
          <label for="question_3" class="form-label">Pergunta 3</label>
          <input type="text" class="form-control" id="question_3" name="question_3" placeholder="Digite a terceira pergunta...">
        </div>

        <hr class="my-5">

        <div class="text-center">
          <button type="submit" class="btn btn-primary px-5 py-2" style="background-color: #007BFF; border: none;">
            Salvar Formulário
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
