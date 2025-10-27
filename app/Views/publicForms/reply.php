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
    }

    .rating-scale {
        display: flex;
        justify-content: center;
        gap: 0.4rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
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

    .rating-scale input[type="radio"]:checked+label {
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

    .emoji-scale input[type="radio"]:checked+label {
        background-color: #007BFF;
        border-radius: 50%;
        color: white;
    }

    /* SIMPLE STAR */
    .star-scale {
        display: flex;
        justify-content: center;
        gap: 0.2rem;
        margin-bottom: 1.5rem;
        align-items: center;
    }

    .star-scale div {
        margin: 0;
        padding: 0;
    }

    .star-scale input[type="radio"] {
        display: none !important;
    }

    .star-scale .star-label {
        font-size: 1.8rem;
        color: #d3d3d3;
        cursor: pointer;
        transition: color 0.15s ease-in-out;
        padding: 0 !important;
        margin: 0 !important;
        border: none !important;
        background: none !important;
        line-height: 1;
        display: inline-block;
        min-width: unset !important;
        width: auto;
        text-align: left;
    }

    .star-scale .star-label:hover {
        color: #FFD700 !important;
    }

    .star-scale .star-label.active {
        color: #FFD700 !important;
    }

    .emoji-option {
        position: relative;
        cursor: pointer;
        font-size: 1.8rem;
        padding: 0.4rem 0.6rem;
        border-radius: 50%;
        background-color: #eef6ff;
        color: #007BFF;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .emoji-option:hover {
        transform: scale(1.2);
        background-color: #dceeff;
    }

    .emoji-option::after {
        content: attr(data-title);
        position: absolute;
        bottom: 130%;
        left: 50%;
        transform: translateX(-50%);
        background: #007BFF;
        color: #fff;
        font-size: 0.75rem;
        padding: 0.3rem 0.5rem;
        border-radius: 5px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
    }

    .emoji-option:hover::after {
        opacity: 1;
    }
</style>

<div class="container py-4">
    <div class="form-container">
        <h2 class="form-title"><?= esc($form['name']) ?></h2>

        <form id="replyForm" data-hash="<?= $form['hash'] ?>">

            <!-- Nome opcional -->
            <div class="mb-2">
                <label for="name" class="form-label">Seu nome (opcional):</label>
                <input type="text" name="name" id="name" class="form-control form-control-sm">
            </div>

            <!-- NPS -->
            <?php if ($form['add_nps']): ?>
                <div class="section-title text-center">Qual a chance de você recomendar este serviço/produto a um amigo?</div>
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
                <div class="section-title text-center">Como você avalia sua satisfação geral?</div>
                <div class="rating-scale emoji-scale">
                    <?php
                    $emojis = [
                        ['icon' => '😠', 'title' => 'Muito insatisfeito'],
                        ['icon' => '😕', 'title' => 'Insatisfeito'],
                        ['icon' => '😐', 'title' => 'Neutro'],
                        ['icon' => '😊', 'title' => 'Satisfeito'],
                        ['icon' => '😍', 'title' => 'Muito satisfeito']
                    ];
                    for ($i = 1; $i <= 5; $i++):
                    ?>
                        <div>
                            <input type="radio" id="csat<?= $i ?>" name="csat" value="<?= $i ?>">
                            <label
                                for="csat<?= $i ?>"
                                data-title="<?= $emojis[$i - 1]['title'] ?>"
                                class="emoji-option">
                                <?= $emojis[$i - 1]['icon'] ?>
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <!-- CES -->
            <?php if ($form['add_ces']): ?>
                <div class="section-title text-center">De 1 a 7, o quão fácil foi comprar conosco?</div>
                <div class="rating-scale">
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                        <div>
                            <input type="radio" id="ces<?= $i ?>" name="ces" value="<?= $i ?>">
                            <label for="ces<?= $i ?>"><?= $i ?></label>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <!-- CLI -->
            <?php if ($form['add_cli']): ?>
                <div class="section-title text-center">De 1 a 10, qual a chance de você voltar a usar nossos serviços/produtos?</div>
                <div class="rating-scale">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <div>
                            <input type="radio" id="cli<?= $i ?>" name="cli" value="<?= $i ?>">
                            <label for="cli<?= $i ?>"><?= $i ?></label>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <!-- SIMPLE STAR -->
            <?php if ($form['add_simple_star']): ?>
                <div class="section-title text-center">Como você avaliaria nossa experiência geral?</div>
                <div class="star-scale">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div>
                            <input type="radio" id="star<?= $i ?>" name="simple_star" value="<?= $i ?>" class="star-input">
                            <label for="star<?= $i ?>" class="star-label" data-value="<?= $i ?>">★</label>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <!-- EXIT -->
            <?php if ($form['add_exit_survey']): ?>
                <div class="section-title">Por favor, nos diga o principal motivo de sua saída ou insatisfação.</div>
                <div class="mb-3">
                    <textarea name="exit_survey" class="form-control form-control-sm" rows="2"></textarea>
                </div>
            <?php endif; ?>

            <!-- Perguntas personalizadas -->
            <?php for ($i = 1; $i <= 2; $i++): ?>
                <?php if (!empty($form['free_question_' . $i])): ?>
                    <div class="mb-3">
                        <label class="form-label"><?= esc($form['free_question_' . $i]) ?></label>
                        <textarea name="free_question_<?= $i ?>" class="form-control form-control-sm" rows="2"></textarea>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary btn-sm" id="submit-form">Enviar Resposta</button>
            </div>

        </form>
    </div>
</div>

<script>
    <?= view('publicForms/js/form.js') ?>
</script>

<?= $this->endSection() ?>