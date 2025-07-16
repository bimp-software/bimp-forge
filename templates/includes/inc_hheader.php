<!DOCTYPE html>

<html lang="<?= LNG; ?>">

<head>
    <base href="<?= BASEPATH; ?>">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? $title.' - '.get_sitename() : 'Bienvenido - '.get_sitename(); ?></title>
    <meta name="description" content="<?= $description; ?>">

    <meta name="author" content="Bimp Forge">
    <meta name="keywords" content="Un Framework para desarrolladores php.">

    <link rel="shortcur icon" href="<?= FAVICON.'icono-bimp.png'; ?>">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/monokai-sublime.min.css'>

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?php echo CSS ?>styles.css">

    <?php load_styles($slug); ?>

</head>

<body <?= isset($background) ? "class=\"$background\"" : ''; ?>>
    <?php $slug = $slug ?? 'home'; ?>