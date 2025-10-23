<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold text-primary">Crie seu formulário em segundos!</h3>
        <p class="text-muted">
            Criar por templates facilita: escolha um modelo pronto e apenas dê um nome ao seu formulário.
        </p>
    </div>

    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card template-card h-100 text-center shadow-sm border-0" id="template-all" data-template="1">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold mb-3">Todas as Métricas</h5>
                    <p class="card-text text-muted">
                        Utilize todas as métricas disponíveis na plataforma (exceto Exit Survey) para uma análise completa do desempenho do seu negócio.
                    </p>
                </div>
                <div class="img-container">
                    <img src="<?= base_url('templates/todas-metricas.png') ?>" class="card-img-preview" alt="Prévia - Todas as Métricas">
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card template-card h-100 text-center shadow-sm border-0" id="template-core" data-template="2">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold mb-3">Trio de Métricas-Chave</h5>
                    <p class="card-text text-muted">
                        Combine as três métricas mais populares — NPS, CSAT e CES — e obtenha uma visão prática e assertiva da satisfação e esforço do cliente.
                    </p>
                </div>
                <div class="img-container">
                    <img src="<?= base_url('templates/trio-chave.png') ?>" class="card-img-preview" alt="Prévia - Trio de Métricas-Chave">
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card template-card h-100 text-center shadow-sm border-0" id="template-exit" data-template="3">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold mb-3">Pesquisa de Saída</h5>
                    <p class="card-text text-muted">
                        Inclui a pergunta Exit Survey e avaliação por estrelas, ideal para entender os motivos pelos quais seus clientes estão deixando o serviço.
                    </p>
                </div>
                <div class="img-container">
                    <img src="<?= base_url('templates/pesquisa-de-saida.png') ?>" class="card-img-preview" alt="Prévia - Pesquisa de Saída">
                </div>
            </div>
        </div>
    </div>
</div>

<script> <?= view ('userForms/js/templates.js') ?> </script>

<style>
    .template-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
        border-radius: 1rem;
        overflow: hidden;
    }

    .template-card:hover {
        transform: scale(1.04);
        box-shadow: 0 0.5rem 1rem rgba(0, 123, 255, 0.25);
    }

    .template-card:active {
        transform: scale(1.02);
    }

    .img-container {
        height: 260px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        overflow: hidden;
    }

    .card-img-preview {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        display: block;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }

    .template-card:hover .card-img-preview {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .img-container {
            height: 220px;
        }
    }
</style>

<?= $this->endSection() ?>
