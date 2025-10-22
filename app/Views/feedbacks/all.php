<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    
    #filtroNps {
        background-color: #198754;
        color: white;
        border: 1px solid #198754;
        font-weight: 600;
    }

    #filtroNps option {
        background-color: white;
        color: black;
    }

    #filtroCsat {
        background-color: #198754;
        /* azul bootstrap */
        color: white;
        border: 1px solid #198754;
        font-weight: 600;
    }

    #filtroCsat option {
        background-color: white;
        color: black;
    }

    #filtroMes {
        background-color: #007BFF;
        /* amarelo bootstrap */
        color: white;
        border: 1px solid #007BFF;
        font-weight: 600;
    }

    #filtroMes option {
        background-color: white;
        color: black;
    }

    #filtroFormulario option {
        background-color: white;
        color: black;
    }

    #filtroFormulario {
        background-color: #007BFF;
        /* amarelo bootstrap */
        color: white;
        border: 1px solid #007BFF;
        font-weight: 600;
    }
</style>

<div class="container mt-5">

    <h3 class="mb-4">Respostas Recebidas</h3>
    <p>Veja toda a linha do tempo de respostas dos seus clientes.</p>

    <?php if (!empty($feedbacks)): ?>

        <div class="row mb-4">
            <!-- Linha 1 -->
            <div class="col-md-6 mb-3">
                <select id="filtroNps" class="form-select">
                    <option value="">Filtrar por NPS</option>
                    <option value="positivo">Somente NPS Positivos (9-10)</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <select id="filtroCsat" class="form-select">
                    <option value="">Filtrar por CSAT</option>
                    <option value="positivo">Somente CSAT Positivos (4-5)</option>
                </select>
            </div>

            <!-- Linha 2 -->
            <div class="col-md-6 mb-3">
                <select id="filtroMes" class="form-select">
                    <option value="">Filtrar por Mês</option>
                    <?php
                    $meses = [];
                    foreach ($feedbacks as $fb):
                        $mes = date('Y-m', strtotime($fb['created_at']));
                        $rotulo = date('m/Y', strtotime($fb['created_at']));
                        $meses[$mes] = $rotulo;
                    endforeach;
                    foreach (array_unique($meses) as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <select id="filtroFormulario" class="form-select">
                    <option value="">Filtrar por Formulário</option>
                    <?php
                    $formularios = [];
                    foreach ($feedbacks as $fb):
                        $formularios[$fb['form_hash']] = $fb['form_name'];
                    endforeach;
                    foreach (array_unique($formularios) as $hash => $nome): ?>
                        <option value="<?= $hash ?>"><?= esc($nome) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($feedbacks as $reply): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border feedback-card"
                        data-nps="<?= $reply['nps'] ?>"
                        data-csat="<?= $reply['csat'] ?>"
                        data-ces="<?= $reply['ces'] ?>"
                        data-cli="<?= $reply['cli'] ?>"
                        data-simple_star="<?= $reply['simple_star'] ?>"
                        data-exit-survey="<?= $reply['exit_survey'] ?>"
                        data-formhash = "<?= $reply['form_hash']  ?>"
                        data-mes="<?= date('Y-m', strtotime($reply['created_at'])) ?>">

                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong><?= esc($reply['form_name']) ?></strong>
                            <small class="text-muted"><?= date('d/m/Y H:i', strtotime($reply['created_at'])) ?></small>
                        </div>

                        <div class="card-body">

                            <p class="mb-2">
                                <?php if (!empty($reply['nps'])): ?>
                                    <i class="bi bi-hand-thumbs-up-fill ms-3 me-1 <?= $reply['nps'] >= 9 ? 'text-success' : ($reply['nps'] >= 7 ? 'text-secondary' : 'text-danger') ?>"></i>
                                    <span class="small">NPS: <?= esc($reply['nps']) ?></span>
                                <?php endif; ?>

                                <?php if (!empty($reply['csat'])): ?>
                                    <i class="bi bi-emoji-smile-fill ms-3 me-1 <?= $reply['csat'] >= 4 ? 'text-success' : 'text-danger' ?>"></i>
                                    <span class="small">CSAT: <?= esc($reply['csat']) ?></span>
                                <?php endif; ?>

                                <?php if (!empty($reply['ces'])): ?>
                                    <i class="bi bi-lightning-charge-fill ms-3 me-1 <?= $reply['ces'] >= 5 ? 'text-success' : ($reply['ces'] >= 3 ? 'text-secondary' : 'text-danger') ?>"></i>
                                    <span class="small">CES: <?= esc($reply['ces']) ?></span>
                                <?php endif; ?>

                                <?php if (!empty($reply['cli'])): ?>
                                    <i class="bi bi-repeat ms-3 me-1 <?= $reply['cli'] >= 8 ? 'text-success' : ($reply['cli'] >= 5 ? 'text-secondary' : 'text-danger') ?>"></i>
                                    <span class="small">CLI: <?= esc($reply['cli']) ?></span>
                                <?php endif; ?>

                                <?php if (!empty($reply['simple_star'])): ?>
                                    <i class="bi bi-star-fill ms-3 me-1 text-warning"></i>
                                    <span class="small">Estrelas: <?= esc($reply['simple_star']) ?>/5</span>
                                <?php endif; ?>
                            </p>

                            <p class="text-muted small mb-3">
                                <i class="bi bi-person-circle me-1 ms-3"></i>
                                <?= $reply['client_name'] ? esc($reply['client_name']) : 'Usuário não identificado' ?>
                            </p>

                            <div class="d-flex justify-content-end">
                                <a href="<?= site_url('feedbacks/view/' . $reply['hash']) ?>" class="btn btn-sm btn-primary me-2">Ver</a>
                                <a href="<?= site_url('feedbacks/delete/' . $reply['hash']) ?>" class="btn btn-sm btn-outline-danger">Excluir</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <div class="alert alert-info text-center">
            Nenhum feedback recebido até o momento.
        </div>
    <?php endif; ?>
</div>

<script>
    <?= view('feedbacks/js/filters.js') ?>
</script>

<?= $this->endSection() ?>