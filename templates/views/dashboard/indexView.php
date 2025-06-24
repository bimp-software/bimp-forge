<?php require_once INCLUDES.'dashboard/inc_header.php'; ?>

    <?php if(is_admin(get_user_role())): ?>
        <?php require_once COMPONENTS.'dashboard/admin/dash_admin.php'; ?>
    <?php endif; ?>

<?php require_once INCLUDES.'dashboard/inc_footer.php'; ?>