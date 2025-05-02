
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Minha Aplicação') ?></title>
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/styles.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/mediaQueries.css") ?>">
</head>

<!-- Toast container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div id="liveToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastMessage" style="white-space: pre-line;">
        Erro ao processar.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
    </div>
  </div>
</div>

<body>

    <!-- variáveis js -->
    <script>
      const site_url      = '<?= site_url() ?>'
      window.toastMessage = <?= json_encode(session()->getFlashdata('toast_message')) ?>
    </script>

    <!-- HEADER -->
    <?= view('layouts/header.php') ?>

    <!-- MAIN CONTENT -->
    <main class="pt-5" style="margin-top: 80px;">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- FOOTER -->
    <?= view('layouts/footer.php') ?>
    
    <script src="<?= base_url("assets/bootstrap/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url("assets/bootstrap/popper.min.js") ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

</body>

</html>
