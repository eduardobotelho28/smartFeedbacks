<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Meus Formulários</h2>
        <div>
            <a href="<?= site_url('forms/create') ?>" class="btn btn-success">Criar novo formulário personalizado</a>
            <a href="<?= site_url('templates/choose') ?>" class="btn" style="background-color:#007BFF; color:white">Criar novo formulário por template</a>
        </div>
    </div>

    <?php if (!empty($forms)): ?>
        <div class="row">
            <?php foreach ($forms as $form): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($form['name']) ?></h5>
                            
                            <p class="card-text">
                                <i class="me-2 <?= $form['add_nps'] == '1' ? 'text-success bi-hand-thumbs-up-fill' : 'text-secondary bi-hand-thumbs-up' ?>"></i> NPS<br>
                                <i class="me-2 <?= $form['add_csat'] == '1' ? 'text-success bi-emoji-smile-fill' : 'text-secondary bi-emoji-smile' ?>"></i> CSAT
                            </p>

                            <!-- Botões que acionam os modais -->
                            <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalUrl<?= $form['id'] ?>">URL</button>
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalQr<?= $form['id'] ?>">Mostrar QR Code</button>

                            <a href="<?= site_url('forms/delete/' . $form['hash']) ?>"
                                class="btn btn-danger btn-sm"
                                >Excluir
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal URL -->
                <div class="modal fade" id="modalUrl<?= $form['id'] ?>" tabindex="-1" aria-labelledby="urlModalLabel<?= $form['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="urlModalLabel<?= $form['id'] ?>">Link Público</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="urlInput<?= $form['id'] ?>" value="<?= esc($form['public_link']) ?>" readonly>
                                    <button class="btn btn-outline-secondary" onclick="copyToClipboard('urlInput<?= $form['id'] ?>')">Copiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal QR Code -->
                <div class="modal fade" id="modalQr<?= $form['id'] ?>" tabindex="-1" aria-labelledby="qrModalLabel<?= $form['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content text-center">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qrModalLabel<?= $form['id'] ?>">QR Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <?php if (!empty($form['qr_code_path'])): ?>
                                    <img src="<?= base_url($form['qr_code_path']) ?>" alt="QR Code" class="img-fluid">
                                <?php else: ?>
                                    <p class="text-muted">QR Code ainda não gerado.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" style="background-color: #007BFF; color:white">
            <h5>Você ainda não possui formulários cadastrados.</h5>
            <p>Clique no botão "Criar novo formulário" para começar a coletar feedbacks!</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function copyToClipboard(inputId) {
        const input = document.getElementById(inputId);
        const text = input.value;

        navigator.clipboard.writeText(text)
            .then(() => {
                showToast('Copiado com sucesso!', 'success')
            })
            .catch(err => {
                console.log(err)
            });
    }
</script>

<?= $this->endSection() ?>
