<!DOCTYPE html>

<html lang="<?= LNG; ?>">

<head>
    <base href="<?= BASEPATH; ?>">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? $title.' - '.get_sitename() : 'Bienvenido - '.get_sitename(); ?></title>
    <meta name="description" content="<?= $description; ?>">

    <!-- Autor y palabras clave (SEO) -->
    <meta name="author" content="BIMP Software SpA">
    <meta name="keywords" content="educación, software, boletas, banco escolar, bimp, tiajo, juegos educativos, facturación, Chile">

    <link rel="shortcur icon" href="<?= FAVICON.'icono-bimp.png'; ?>">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/lenis@1.3.4/dist/lenis.min.js"></script>

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?php echo CSS ?>styles.css">

    <?php require_once INCLUDES.'inc_hstyle.php'; ?>

</head>

<body <?= isset($background) ? "class=\"$background\"" : ''; ?>>
    <?php $slug = $slug ?? 'home'; ?>