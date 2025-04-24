
<?php
    //pega o controller atual. 
    //serve para controlar os links do header. ex: 'como funciona' e 'contato' só devem aparecer quando estivermos na HOME.      
    $router = service('router')                     ;
    $currentController = $router->controllerName()  ;
?>

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
                <?php if ($currentController === '\App\Controllers\Home'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#como-funciona">Como Funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contato">Contato</a>
                    </li>
                <?php endif; ?>
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