<?php require_once INCLUDES.'inc_hheader.php'; ?>
<?php if(is_local()): ?>
    <section class="container justify-item-center aling-item-center p-5">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center"><?= $error ?></h2>
                <p class="text-center"><?= $file ?></p>
                <p class="text-center"><?= $trace ?></p>
                <a href="home" class="btn btn-primary w-100">Volver al inico</a>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="container justify-item-center aling-item-center p-5">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Erro 404</h2>
                <p class="text-center">Página no encontrada</p>
                <a href="home" class="btn btn-primary w-100">Volver al inico</a>
            </div>
        </div>
    </section>
<?php endif; ?>

    

<?php require_once INCLUDES.'inc_hfooter.php'; ?>