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

    <link rel="stylesheet" href="<?= CSS.'dashboard/sb-admin-2.min.css'; ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="<?= PLUGINS.'waitme/waitMe.min.css'; ?>">

    <link rel="stylesheet" href="<?= CSS.'dashboard/datatables/dataTables.bootstrap4.min.css'; ?>">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <?php require_once INCLUDES.'inc_hstyle.php'; ?>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once INCLUDES.'dashboard/sidebar/inc_sidebar.php'; ?>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar Navbar -->
                <?php require_once INCLUDES.'dashboard\navbar\inc_navbar.php'; ?>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <?php if(!isset($hide_title)): ?>
                            <h1 class="h3 mb-0 text-gray-800"><?php echo isset($title) ? $title : null; ?></h1>
                        <?php endif; ?>
                        <div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?php echo Bimp\Forge\Flasher\Flasher::flash(4); ?>
                        </div>
                    </div>
