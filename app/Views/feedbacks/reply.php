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
        margin-top: 1.2rem;
    }

    .rating-scale {
        display: flex;
        justify-content: center;
        gap: 0.4rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
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
            <input type="text" class="form-control form-control-sm" value="<?= esc($reply['client_name'] ?? 'Usuário não identificado') ?>" readonly>
        </div>

        <!-- NPS -->
        <?php if ($form['add_nps']): ?>
            <div class="section-title">Chance de recomendar o produto/serviço a um amigo:</div>
            <div class="rating-scale">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <label class="disabled-label <?= $reply['nps'] == $i ? 'label-selected' : '' ?>"><?= $i ?></label>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <?php if ($form['add_csat']): ?>

            <div class="section-title">Satisfação geral com o serviço/produto:</div>
            <div class="rating-scale emoji-scale">
                <?php
                    $emojis = ['😠', '😕', '😐', '😊', '😍'];
                    for ($i = 1; $i <= 5; $i++):
                        $isSelected = (int) $reply['csat'] === $i; 
                ?>
                    <label class="disabled-label <?= $isSelected ? 'emoji-selected' : '' ?>"><?= $emojis[$i - 1] ?></label>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <!-- Perguntas -->
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <?php if (!empty($form['question_' . $i])): ?>
                <div class="mb-2">
                    <label class="form-label"><?= esc($form['question_' . $i]) ?></label>
                    <textarea class="form-control form-control-sm" rows="2" readonly><?= esc($reply['question_' . $i] ?? '') ?></textarea>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>

<?= $this->endSection() ?>
