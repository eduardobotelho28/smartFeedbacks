<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Minha Aplicação') ?></title>
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap.min.css") ?>">
    
</head>
<body>
    <header>
        
        <?php if(!session()->has('user')) : ?>
            <a href="" class="btn btn-primary"> Entrar </a>
        <?php endif ?>

    </header>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> - Todos os direitos reservados</p>
    </footer>
    
    <script src="<?= base_url("assets/boostrap.bundle.min.js") ?>"></script>
</body>
</html>
