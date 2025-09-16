<!DOCTYPE html>
<html lang="<?= get_site_lang(); ?>">
<head>
    <!-- Agregar basepath para definir a partir de donde se deben generar los enlaces y la carga de archivos -->
    <base href="<?= get_basepath(); ?>">
    <!-- Charset del sitio -->
    <meta charset="<?= get_site_charset();?>">
    <title><?= isset($d->title) ? $d->title . ' - ' . get_sitename() : 'Bienvenido - '. get_sitename(); ?></title>
    <!-- Meta viewport requerido para responsividad -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Retro compatibilidad con internet explorer / edge -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon del sitio -->
    <?= get_favicon(); ?>

    <!-- styles.php -->
    <?php require_once INCLUDES . 'home/styles.php'; ?>

    <!-- Carga de meta tags -->
    <?= get_page_og_meta_tags(); ?>
    
</head>

<body>