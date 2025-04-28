
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Minha Aplicação') ?></title>
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap//bootstrap.min.css") ?>">
    <style>
        html, body {
            height: 100%;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #F8F9FA;
        }

        main {
            flex: 1;
        }

        header {
            background-color: #007BFF;
        }

        header a.nav-link {
            color: white !important;
        }

        header a.nav-link:hover {
            color: #cce5ff !important;
        }

        header .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        header .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #007BFF;
            color: white;
            padding: 1rem 0;
        }

        a {
            transition: all 0.3s ease; 
        }

        a:hover, a:focus {
            color: #3B82F6; 
            text-decoration: underline; 
        }

        a:active {
            color: #1E3A8A; 
        }

        #navbarNav {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<!-- Toast container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div id="liveToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastMessage">
        Erro ao processar.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
    </div>
  </div>
</div>

<body>

    <!-- variáveis js -->
    <script>
        const site_url = '<?= site_url() ?>'
    </script>

    <!-- HEADER -->
    <?= view('layouts/header.php') ?>

    <main class="pt-5" style="margin-top: 80px;">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- FOOTER -->
    <?= view('layouts/footer.php') ?>
    
    <script src="<?= base_url("assets/bootstrap//bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>
