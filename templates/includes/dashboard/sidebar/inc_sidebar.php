<ul class="navbar-nav bg-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <a href="dashboard" class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="<?= FAVICON.'logo-tiajobank.png'; ?>" alt="Logo tiajo bank" style="height: 40px;">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <?php if(is_admin(get_user_role())): ?>
        <?php require_once COMPONENTS.'sidebar/admin/sidebar_admin.php'; ?>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-mode-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>