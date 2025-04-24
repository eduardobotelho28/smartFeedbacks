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
    <!-- HEADER -->
    <header class="fixed-top shadow">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand fw-bold" href="#">Sistema de Feedbacks</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/') ?>">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#como-funciona">Como Funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contato">Contato</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="display: flex;">
                    <li class="nav-item">
                        <a class="nav-link" href="">Meus Formulários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Meus Feedbacks</a>
                    </li>
                    <li>
                        <?php if (session()->has('user')): ?>
                            <span class="me-2">Olá, <?= esc(session('user')['name']) ?>!</span>
                        <?php else: ?>
                            <a href="<?= site_url("authentication/login_view") ?>" class="text-white text-decoration-none nav-link" style="background-color:#1E3A8A !important; border-radius:10px">Entrar!</a>
                        <?php endif; ?>
                    </li>
                </ul>

            </div>
        </nav>
    </header>

    <main class="pt-5" style="margin-top: 80px;">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- FOOTER -->
    <footer class="mt-5 border-top text-center">
        <div class="container">
        <small>&copy; <?= date('Y') ?> Sistema de Feedbacks - Todos os direitos reservados.</small>
        </div>
    </footer>
    
    <script src="<?= base_url("assets/bootstrap//bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
