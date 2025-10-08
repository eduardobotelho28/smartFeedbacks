<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .thank-you-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        padding: 3rem 2.5rem;
        max-width: 500px;
        margin: 5rem auto;
        text-align: center;
    }
    .thank-you-title {
        color: #007BFF;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .thank-you-text {
        color: #495057;
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }
</style>

<div class="container">
    <div class="thank-you-container">
        <h1 class="thank-you-title">Obrigado pelo seu feedback :)</h1>
        <p class="thank-you-text">Sua opinião é muito importante para nós e nos ajuda a melhorar continuamente nossos serviços.</p>
    </div>
</div>

<?= $this->endSection() ?>
