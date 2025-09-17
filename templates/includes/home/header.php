<!DOCTYPE html>
<html lang="<?= get_site_lang(); ?>">
<head>
    <base href="<?= BASE_PATH; ?>">

    <!-- Charset del sitio -->
    <meta charset="<?= get_site_charset();?>">
    <!-- Meta viewport requerido para responsividad -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($d->title) ? $d->title . ' - ' . get_sitename() : 'Bienvenido - '. get_sitename(); ?></title>

    <!-- Favicon del sitio -->
    <?= get_favicon(); ?>

    <!-- styles.php -->
    <?php require_once INCLUDES . 'home/styles.php'; ?>

    <!-- Carga de meta tags -->
    <?= get_page_og_meta_tags(); ?>
    
</head>

<body>