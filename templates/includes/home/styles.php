<!-- CSS Framework | Configurado en settings.php | defecto = Bootstrap 5 -->
<?= get_css_framework(); ?>

<!-- Font awesome 6 -->
<?= get_fontawesome(); ?>

<!-- Todo plugin adicional debe ir debajo de está línea -->

<!-- Sweet alert 2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">

<!-- Toastr css -->
<?= get_toastr('styles'); ?>

<!-- Waitme css -->
<?= get_waitMe('styles'); ?>

<!-- Lightbox -->
<?= get_lightbox('styles'); ?>

<!-- CDN Vue js 3 | definido en settings.php -->
<?= get_vuejs(); ?>

<!-- Estilos personalizados deben ir en main.css o abajo de esta línea -->
<link rel="stylesheet" href="<?= CSS ?>main.css">

<!-- Estilos registrados manualmente -->
<?= load_styles(); ?>