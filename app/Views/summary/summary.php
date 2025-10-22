<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    body {
        background-color: #f4f6fa;
        min-height: 100vh;
        padding-top: 40px;
    }

    .summary-title {
        font-weight: bold;
        color: #007BFF;
    }

    .card-summary {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        padding: 1.5rem;
        background: #fff;
        transition: transform 0.2s;
        height: 100%;
    }

    .card-summary:hover {
        transform: translateY(-5px);
    }

    .card-header {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #007BFF;
    }

    .card-header i {
        font-size: 1.5rem;
    }

    .progress {
        height: 20px;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .progress-bar {
        font-weight: bold;
        line-height: 20px;
    }

    .metric-text {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .badge-pill {
        font-size: 0.85rem;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 4px;
        font-size: 0.85rem;
    }

    @media (max-width: 767px) {
        .card-header {
            font-size: 1.1rem;
        }
    }
</style>

<div class="container mt-5">
    <h2 class="summary-title mb-4">Visão Geral do Empreendedor</h2>
    <p>Este painel mostra um resumo das métricas de desempenho de seus serviços e formulários. Aqui você consegue ter uma visão rápida do seu NPS, CSAT, CLI, CES, Avaliações por Estrelas, Exit Survey e respostas por formulário.</p>

    <div class="row g-4 mt-3">

        <!-- NPS -->
        <div class="col-md-6 col-lg-4">
            <div class="card-summary">
                <div class="card-header">
                    <i class="bi bi-hand-thumbs-up-fill"></i> NPS - Net Promoter Score
                </div>
                <p class="metric-text">Mede o quanto os clientes recomendariam sua empresa, com notas de 1 a 10.</p>
                <p class="metric-text"><strong>Cálculo:</strong> (% Promotores - % Detratores)</p>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Promotores (9-10)
                        <span class="badge bg-success rounded-pill"><?= $nps['promotores'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Neutros (7-8)
                        <span class="badge bg-secondary rounded-pill"><?= $nps['neutros'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Detratores (0-6)
                        <span class="badge bg-danger rounded-pill"><?= $nps['detratores'] ?></span>
                    </li>
                </ul>

                <div class="text-end mb-2">
                    <span class="fw-bold">NPS Final:</span>
                    <span class="fs-4 <?= $nps['npsScore'] > 0 ? 'text-success' : 'text-danger' ?>">
                        <?= $nps['npsScore'] ?>
                    </span>
                </div>

                <!-- NPS Progress Bars com labels fora -->
                <div class="progress-label">
                    <span>Promotores</span>
                    <span><?= round(($nps['promotores'] / max($nps['total'],1) * 100)) ?>%</span>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= max($nps['promotores'] / max($nps['total'],1) * 100, 0) ?>%"></div>
                </div>

                <div class="progress-label">
                    <span>Detratores</span>
                    <span><?= round(($nps['detratores'] / max($nps['total'],1) * 100)) ?>%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?= max($nps['detratores'] / max($nps['total'],1) * 100, 0) ?>%"></div>
                </div>

            </div>
        </div>

        <!-- CSAT -->
        <div class="col-md-6 col-lg-4">
            <div class="card-summary">
                <div class="card-header">
                    <i class="bi bi-emoji-smile"></i> CSAT - Customer Satisfaction
                </div>
                <p class="metric-text">Avalia a satisfação geral com a experiência do cliente (1 = muito insatisfeito, 5 = muito satisfeito).</p>
                <p class="metric-text"><strong>Cálculo:</strong> (Notas 4 ou 5 / Total) × 100%</p>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Satisfeitos (4-5)
                        <span class="badge bg-success rounded-pill"><?= $csat['satisfeitos'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total de Respostas
                        <span class="badge bg-primary rounded-pill"><?= $csat['total'] ?></span>
                    </li>
                </ul>

                <div class="text-end mb-2">
                    <span class="fw-bold">CSAT Final:</span>
                    <span class="fs-4 <?= $csat['csatPercent'] >= 70 ? 'text-success' : 'text-danger' ?>">
                        <?= $csat['csatPercent'] ?>%
                    </span>
                </div>

                <div class="progress-label">
                    <span>Satisfação</span>
                    <span><?= $csat['csatPercent'] ?>%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $csat['csatPercent'] ?>%"></div>
                </div>
            </div>
        </div>

        <!-- CLI -->
        <div class="col-md-6 col-lg-4">
            <div class="card-summary">
                <div class="card-header">
                    <i class="bi bi-repeat"></i> CLI - Client Loyalty Index
                </div>
                <p class="metric-text">Mede a fidelidade do cliente. Notas altas indicam que os clientes provavelmente voltarão.</p>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Média das notas
                        <span class="badge bg-primary rounded-pill"><?= $cli['media'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Clientes fieis (≥8)
                        <span class="badge bg-success rounded-pill"><?= $cli['qtd_fieis'] ?> (<?= $cli['percentFieis'] ?>%)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total de respostas
                        <span class="badge bg-secondary rounded-pill"><?= $cli['total'] ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- CES -->
        <div class="col-md-6 col-lg-4">
            <div class="card-summary">
                <div class="card-header">
                    <i class="bi bi-lightning-charge-fill"></i> CES - Customer Effort Score
                </div>
                <p class="metric-text">Avalia o esforço do cliente para utilizar o serviço/produto (1 = muito difícil, 7 = muito fácil).</p>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Média
                        <span class="badge bg-primary rounded-pill"><?= $ces['media'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Facilidade (%)
                        <span class="badge bg-success rounded-pill"><?= $ces['facilidadePercent'] ?>%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total de respostas
                        <span class="badge bg-secondary rounded-pill"><?= $ces['total'] ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Estrelas -->
        <div class="col-md-6 col-lg-4">
            <div class="card-summary">
                <div class="card-header">
                    <i class="bi bi-star-fill"></i> Avaliação por Estrelas
                </div>
                <p class="metric-text">Média das avaliações em estrelas pelos clientes.</p>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Média
                        <span class="badge bg-primary rounded-pill"><?= $stars['media'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total de respostas
                        <span class="badge bg-secondary rounded-pill"><?= $stars['total'] ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Exit Survey -->
        <div class="col-md-6 col-lg-4">
            <div class="card-summary">
                <div class="card-header">
                    <i class="bi bi-exclamation-circle"></i> Exit Survey
                </div>
                <p class="metric-text">Clientes que responderam o Exit Survey, indicando motivos de saída ou insatisfação.</p>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total de respostas
                        <span class="badge bg-secondary rounded-pill"><?= $exitSurvey['total_exit'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Respondidos
                        <span class="badge bg-success rounded-pill"><?= $exitSurvey['respondidos'] ?> (<?= $exitSurvey['percentRespondidos'] ?>%)</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Respostas por formulário -->
        <div class="col-12">
            <div class="card-summary">
                <div class="card-header">
                    <i class="bi bi-card-list"></i> Respostas por Formulário
                </div>
                <p class="metric-text">Quantidade de respostas recebidas por cada formulário.</p>
                <ul class="list-group list-group-flush">
                    <?php foreach($general['forms'] as $formName => $count): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $formName ?>
                            <span class="badge bg-primary rounded-pill"><?= $count ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="text-end mt-2">
                    <span class="fw-bold">Total de Respostas:</span> <?= $general['total_respostas'] ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
