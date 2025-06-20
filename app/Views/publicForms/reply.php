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
    .rating-scale input[type="radio"] {
        display: none;
    }
    .rating-scale label {
        cursor: pointer;
        padding: 0.5rem 0.7rem;
        border: 2px solid #007BFF;
        border-radius: 8px;
        background-color: #eef6ff;
        color: #007BFF;
        font-weight: 500;
        transition: 0.2s;
        min-width: 36px;
        text-align: center;
    }
    .rating-scale input[type="radio"]:checked + label {
        background-color: #007BFF;
        color: #fff;
        transform: scale(1.05);
    }
    .emoji-scale label {
        font-size: 1.4rem;
        padding: 0.4rem 0.6rem;
        border: none;
        background: none;
    }
    .emoji-scale input[type="radio"]:checked + label {
        background-color: #007BFF;
        border-radius: 50%;
        color: white;
    }
</style>

<div class="container py-4">
    <div class="form-container">
        <h2 class="form-title"><?= esc($form['name']) ?></h2>

        <form id="replyForm" data-hash="<?= $form['hash']?>">

            <!-- Nome opcional -->
            <div class="mb-2">
                <label for="name" class="form-label">Seu nome (opcional):</label>
                <input type="text" name="name" id="name" class="form-control form-control-sm">
            </div>

            <!-- NPS -->
            <?php if ($form['add_nps']): ?>
                <div class="section-title">Qual a chance de você recomendar este serviço/produto a um amigo?</div>
                <div class="rating-scale">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <div>
                            <input type="radio" id="nps<?= $i ?>" name="nps" value="<?= $i ?>">
                            <label for="nps<?= $i ?>"><?= $i ?></label>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <!-- CSAT -->
            <?php if ($form['add_csat']): ?>
                <div class="section-title">Como você avalia sua satisfação geral?</div>
                <div class="rating-scale emoji-scale">
                    <?php
                        $emojis = ['😠', '😕', '😐', '😊', '😍'];
                        for ($i = 1; $i <= 5; $i++):
                    ?>
                        <div>
                            <input type="radio" id="csat<?= $i ?>" name="csat" value="<?= $i ?>">
                            <label for="csat<?= $i ?>"><?= $emojis[$i - 1] ?></label>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <!-- Perguntas personalizadas -->
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <?php if (!empty($form['question_' . $i])): ?>
                    <div class="mb-2">
                        <label class="form-label"><?= esc($form['question_' . $i]) ?></label>
                        <textarea name="question_<?= $i ?>" class="form-control form-control-sm" rows="2"></textarea>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary btn-sm" id="submit-form">Enviar Resposta</button>
            </div>

        </form>
    </div>
</div>

<script> <?= view('publicForms/js/form.js') ?> </script>

<?= $this->endSection() ?>
