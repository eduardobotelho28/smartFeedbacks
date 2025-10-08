<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    body {
        background-color: #F8F9FA;
        min-height: 100vh;
        padding-top: 40px;
    }
    .profile-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 2rem 2.5rem;
        max-width: 640px;
        margin: 0 auto;
        margin-bottom: 2rem;
    }
    .profile-title {
        color: #007BFF;
        font-weight: bold;
        margin-bottom: 1.5rem;
        font-size: 1.6rem;
        text-align: center;
    }
    label {
        font-weight: 500;
        color: #343a40;
    }
    .btn-save {
        background-color: #007BFF;
        color: white;
        font-weight: 500;
        border: none;
        transition: 0.2s;
    }
    .btn-save:hover {
        background-color: #0056b3;
        color: white;
    }
</style>

<div class="container py-4">
    <div class="profile-container">
        <h2 class="profile-title">Meu Perfil</h2>

        <form id="profileForm">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstname" class="form-label">Nome</label>
                    <input 
                        type="text" 
                        id="firstname" 
                        name="firstname" 
                        class="form-control form-control-sm"
                        value="<?= esc($user['firstname']) ?>"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lastname" class="form-label">Sobrenome</label>
                    <input 
                        type="text" 
                        id="lastname" 
                        name="lastname" 
                        class="form-control form-control-sm"
                        value="<?= esc($user['lastname']) ?>"
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control form-control-sm"
                    value="<?= esc($user['email']) ?>"
                >
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-save btn-sm" id="saveProfile">Salvar alterações</button>
            </div>
        </form>
    </div>
</div>

<script>
    <?= view('user/js/profile.js') ?>
</script>

<?= $this->endSection() ?>
