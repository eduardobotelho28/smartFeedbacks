<?php
    // Pega o controller e método atuais.
    $router = service('router');
    $currentController = $router->controllerName();
    $currentMethod = $router->methodName();
?>

<?php if ($currentMethod !== 'reply_view'): ?>
<header class="fixed-top shadow">
    <nav class="navbar navbar-expand-lg navbar-dark container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="#">Sistema de Feedbacks</a>

        <!-- Botão de menu hamburguer para telas pequenas -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Links do menu principal -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>">Início</a>
                </li>

                <?php if ($currentController === '\App\Controllers\Home'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#como-funciona">Como Funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contato">Contato</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Links de usuário -->
            <?php if(session()->has('user')): ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/forms') ?>">Meus Formulários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Meus Feedbacks</a>
                    </li>

                    <!-- Dropdown de usuário -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-bold px-3 py-1 rounded" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2);">
                            Olá, <?= esc(session()->get('userName')) ?>!
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= site_url('usuario/perfil') ?>">Meu Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= site_url('authentication/logout') ?>">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="<?= site_url('authentication/login') ?>" class="text-white text-decoration-none nav-link">
                            <strong>Entrar</strong>
                        </a>
                    </li>
                </ul>
            <?php endif; ?>

        </div>
    </nav>
</header>
<?php endif; ?>
