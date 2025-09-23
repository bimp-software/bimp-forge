    <footer class="bg-dark py-4 border-top text-white fixed-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <span>Desarrollado con <i class="fas fa-heart text-danger"></i> por bimp software</span>
                <span><?= sprintf('Hecho con %s %s',get_forge_name(), get_forge_version()) ?></span>
            </div>
        </div>
    </footer>

    <?php require_once INCLUDES . 'home/scripts.php'; ?>

</body> 

</html>