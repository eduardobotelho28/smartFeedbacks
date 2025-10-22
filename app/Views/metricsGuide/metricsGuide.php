<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    body {
        background-color: #f4f6fa;
    }
    .metrics-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    .metric-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        padding: 1.5rem 1.8rem;
        margin-bottom: 1.8rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }
    .metric-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 0.8rem;
    }
    .metric-header i {
        font-size: 1.6rem;
        color: #007BFF;
    }
    .metric-title {
        font-weight: bold;
        font-size: 1.25rem;
        color: #333;
    }
    .metric-description {
        color: #555;
        line-height: 1.5;
        font-size: 0.95rem;
    }
    .metric-question {
        margin-top: 1rem;
        background: #f8f9fa;
        padding: 0.9rem;
        border-left: 4px solid #007BFF;
        border-radius: 6px;
        font-style: italic;
        color: #444;
    }
</style>

<div class="metrics-container">
    <h2 class="text-center mb-4 fw-bold text-primary">Guia de Métricas</h2>
    <p class="text-muted text-center mb-5">
        Entenda as principais métricas utilizadas em nossos formulários de feedback e como cada uma delas ajuda a avaliar e aprimorar a experiência do cliente.
    </p>

    <!-- NPS -->
    <div class="metric-card">
        <div class="metric-header">
            <i class="bi bi-hand-thumbs-up-fill"></i>
            <span class="metric-title">NPS — Net Promoter Score</span>
        </div>
        <div class="metric-description">
            O NPS mede o grau de lealdade dos clientes, avaliando a probabilidade de recomendarem sua empresa a outras pessoas.
            Criado por Fred Reichheld, é uma das métricas mais usadas para medir satisfação geral e potencial de crescimento.
            Ele classifica os clientes em promotores, neutros e detratores, ajudando a identificar pontos fortes e áreas de melhoria.
        </div>
        <div class="metric-question">
            “De 1 a 10, qual a chance de você recomendar a nossa empresa a um amigo?”
        </div>
    </div>

    <!-- CSAT -->
    <div class="metric-card">
        <div class="metric-header">
            <i class="bi bi-emoji-smile"></i>
            <span class="metric-title">CSAT — Customer Satisfaction Score</span>
        </div>
        <div class="metric-description">
            O CSAT mede diretamente a satisfação do cliente com um produto, serviço ou atendimento específico.
            É uma métrica simples e eficaz, geralmente usada logo após uma interação com o cliente, ajudando a identificar experiências positivas e negativas em tempo real.
        </div>
        <div class="metric-question">
            “Como você avaliaria sua experiência ao utilizar nosso serviço?”
        </div>
    </div>

    <!-- CLI -->
    <div class="metric-card">
        <div class="metric-header">
            <i class="bi bi-repeat"></i>
            <span class="metric-title">CLI — Client Loyalty Index</span>
        </div>
        <div class="metric-description">
            O CLI avalia o nível de lealdade do cliente, mensurando a probabilidade de ele continuar comprando ou utilizando seus serviços.
            Essa métrica ajuda a prever retenção e valor de longo prazo, indicando se os clientes estão propensos a se manter engajados com a marca.
        </div>
        <div class="metric-question">
            “De 1 a 10, qual a chance de você voltar a usar nossos serviços/produtos?”
        </div>
    </div>

    <!-- CES -->
    <div class="metric-card">
        <div class="metric-header">
            <i class="bi bi-lightning-charge-fill"></i>
            <span class="metric-title">CES — Customer Effort Score</span>
        </div>
        <div class="metric-description">
            O CES mede o esforço necessário que um cliente precisou fazer para resolver um problema, realizar uma compra ou usar um serviço.
            Pesquisas mostram que quanto menor o esforço exigido, maior a fidelização. Essa métrica é essencial para melhorar processos e reduzir atritos na jornada do cliente.
        </div>
        <div class="metric-question">
            “De 1 a 7, o quão fácil foi comprar conosco?”
        </div>
    </div>

    <!-- Exit Survey -->
    <div class="metric-card">
        <div class="metric-header">
            <i class="bi bi-exclamation-circle"></i>
            <span class="metric-title">Exit Survey — Pesquisa de Saída</span>
        </div>
        <div class="metric-description">
            A pesquisa de saída é usada para entender as razões pelas quais clientes deixam de usar um produto ou serviço.
            Ela fornece insights valiosos sobre pontos de insatisfação e ajuda a prevenir cancelamentos futuros, melhorando retenção e relacionamento.
        </div>
        <div class="metric-question">
            “Por favor, nos diga o principal motivo de sua saída ou insatisfação.”
        </div>
    </div>

    <!-- Star Rating -->
    <div class="metric-card">
        <div class="metric-header">
            <i class="bi bi-star-fill"></i>
            <span class="metric-title">Star Rating — Avaliação por Estrelas</span>
        </div>
        <div class="metric-description">
            O sistema de estrelas é uma forma simples e intuitiva de medir a percepção geral do cliente.
            Amplamente usado em plataformas digitais, ele traduz rapidamente o nível de satisfação em uma escala visual, ajudando a identificar a média da experiência geral.
        </div>
        <div class="metric-question">
            “Como você avaliaria nossa experiência geral?”
        </div>
    </div>

</div>

<?= $this->endSection() ?>
