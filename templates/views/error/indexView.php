<?php require_once INCLUDES.'home/header.php'; ?>
<?php require_once INCLUDES.'home/navbar.php'; ?>

<div class="container py-5 main-wrapper">
    <div class="row">
        <div class="col-12">
            <?= Bimp\Forge\Flasher\Flasher::flash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-12 text-center offset-xl-3 py-5">
            <a href="<?= get_base_url(); ?>">
                Bimp Forge
            </a>

            <h1 class="mt-5 mb-3 text-warning d-block" style="font-size: 100px;">
                <?= $code; ?>
            </h1>
            <h2 class="fw-bold">Pagina no encontrada</h2>

            <p class="text-center text-muted">Entraste a otra dimensión</p>

            <div class="mt-5">
                <a href="<?= get_default_controller(); ?>" class="btn btn-outline-success btn-lg">
                    <i class="fas fa-undo fa-fw"></i>
                    Regresar
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES.'home/footer.php'; ?>