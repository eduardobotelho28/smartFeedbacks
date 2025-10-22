<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    body {
        background-color: #f4f6fa;
        min-height: 100vh;
        padding-top: 40px;
    }
    .form-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 1.5rem 1.8rem;
        max-width: 680px;
        margin: 0 auto;
        margin-bottom: 2rem;
    }
    .form-title {
        color: #007BFF;
        font-weight: bold;
        margin-bottom: 1.2rem;
        font-size: 1.5rem;
        text-align: center;
    }
    .section-title {
        font-size: 1rem;
        font-weight: 500;
        color: #343a40;
        margin-bottom: 0.4rem;
        margin-top: 2rem;
        text-align: center;
    }
    .rating-scale {
        display: flex;
        justify-content: center;
        gap: 0.4rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .rating-scale label {
        padding: 0.5rem 0.7rem;
        border: 2px solid #007BFF;
        border-radius: 8px;
        background-color: #eef6ff;
        color: #007BFF;
        font-weight: 500;
        min-width: 36px;
        text-align: center;
    }
    .label-selected {
        background-color: #007BFF !important;
        color: #fff !important;
        transform: scale(1.05);
    }
    .emoji-scale label {
        font-size: 1.4rem;
        padding: 0.4rem 0.6rem;
        border: none;
        background: none;
    }
    .emoji-selected {
        background-color: #007BFF !important;
        border-radius: 50% !important;
        color: white !important;
    }
    .star-scale {
        display: flex;
        justify-content: center;
        gap: 0.2rem;
        margin-bottom: 1.5rem;
        align-items: center;
    }
    .star-label {
        font-size: 1.8rem;
        color: #d3d3d3;
    }
    .star-label.active {
        color: #FFD700 !important;
    }
    .disabled-label {
        cursor: default;
    }
</style>

<div class="container py-4">
    <div class="form-container">
        <h2 class="form-title"><?= esc($form['name']) ?></h2>

        <!-- Nome do cliente -->
        <div class="mb-2">
            <label class="form-label">Nome do cliente:</label>
            <input type="text" class="form-control form-control-sm" 
                   value="<?= esc($reply['client_name'] ?? 'Usuário não identificado') ?>" readonly>
        </div>

        <!-- NPS -->
        <?php if ($form['add_nps']): ?>
            <div class="section-title">Chance de recomendar o produto/serviço a um amigo:</div>
            <div class="rating-scale">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <label class="disabled-label <?= ($reply['nps'] ?? null) == $i ? 'label-selected' : '' ?>"><?= $i ?></label>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <!-- CSAT -->
        <?php if ($form['add_csat']): ?>
            <div class="section-title">Satisfação geral com o serviço/produto:</div>
            <div class="rating-scale emoji-scale">
                <?php
                    $emojis = ['😠', '😕', '😐', '😊', '😍'];
                    for ($i = 1; $i <= 5; $i++):
                        $isSelected = (int) ($reply['csat'] ?? 0) === $i;
                ?>
                    <label class="disabled-label <?= $isSelected ? 'emoji-selected' : '' ?>"><?= $emojis[$i - 1] ?></label>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <!-- CES -->
        <?php if ($form['add_ces']): ?>
            <div class="section-title">Facilidade de compra (CES):</div>
            <div class="rating-scale">
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <label class="disabled-label <?= ($reply['ces'] ?? null) == $i ? 'label-selected' : '' ?>"><?= $i ?></label>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <!-- CLI -->
        <?php if ($form['add_cli']): ?>
            <div class="section-title">Chance de voltar a usar nossos serviços/produtos (CLI):</div>
            <div class="rating-scale">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <label class="disabled-label <?= ($reply['cli'] ?? null) == $i ? 'label-selected' : '' ?>"><?= $i ?></label>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <!-- Simple Star -->
        <?php if ($form['add_simple_star']): ?>
            <div class="section-title">Avaliação geral (estrelas):</div>
            <div class="star-scale">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <label class="star-label <?= ($reply['simple_star'] ?? 0) >= $i ? 'active' : '' ?>">★</label>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <!-- Exit Survey -->
        <?php if ($form['add_exit_survey']): ?>
            <div class="section-title">Motivo da saída ou insatisfação:</div>
            <textarea class="form-control form-control-sm" rows="2" readonly><?= esc($reply['exit_survey'] ?? '') ?></textarea>
        <?php endif; ?>

        <!-- Perguntas personalizadas -->
        <?php for ($i = 1; $i <= 2; $i++): ?>
            <?php if (!empty($form['free_question_' . $i])): ?>
                <div class="mb-2">
                    <label class="form-label"><?= esc($form['free_question_' . $i]) ?></label>
                    <textarea class="form-control form-control-sm" rows="2" readonly><?= esc($reply['free_question_' . $i] ?? '') ?></textarea>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>

<?= $this->endSection() ?>
