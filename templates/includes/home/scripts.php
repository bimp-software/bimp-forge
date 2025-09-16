<!-- jQuery | definido en .env -->
<?= get_jquery(); ?>

<!-- jQuery easing -->
<?= get_jquery_easing(); ?>

<!-- CSS Framework scripts | Por defecto Bootstrap 5 | definido en .env -->
<?= get_css_framework_scripts(); ?>

<!-- Axios -->
<?= get_axios(); ?>

<!-- SweetAlert2 -->
<?= get_sweetalert2(); ?>

<!-- Toastr js -->
<?= get_toastr(); ?>

<!-- waitMe js -->
<?= get_waitMe(); ?>

<!-- Lightbox js -->
<?= get_lightbox(); ?>

<!-- Objeto Forge Javascript registrado -->
<?= load_forge_obj(); ?>

<!-- Scripts registrados manualmente -->
<?= load_scripts(); ?>

<!-- Scripts personalizados Forge Framework -->
<script src="<?= JS . 'main.min.js?v=' . get_asset_version(); ?>"></script>