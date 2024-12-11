<?php
    // Inclusion de l'en-tête générique
    include('_partials/header.php');
?>

    <!-- Bootstrap 5 personnalisé -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-custom.min.css">
</head>
<body>

    <!-- En-tête -->
     <header class="mb-4 pb-5">
        <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand mb-0 h1" href="<?= site_url(); ?>/dashboard.php"">
                    <img src="<?= base_url(); ?>favicon.ico" alt="Logo" width="30" class="d-inline-block align-text-top me-1">
                    <?= app_name(); ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: 1.125rem;">
                        <?php if (is_admin()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-list"></i>
                                Gérer les listes
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li><a class="dropdown-item" href="<?= site_url(); ?>/edit_bakery">Votre boulangerie</a></li>
                                <li><hr class="dropdown-divider"></li> -->
                                <li><a class="dropdown-item" href="<?= site_url(); ?>/list_category.php">Catégories</a></li>
                                <li><a class="dropdown-item" href="<?= site_url(); ?>/list_product.php">Produits</a></li>
                            
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <div>
                        Bonjour, <?= (is_superadmin()) ? 'Super administrateur' : 'Administrateur'; ?>
                        <span class="text-secondary mx-2">|</span>
                        <a href="<?= site_url(); ?>/logout.php" class="btn btn-outline-dark btn-sm">
                            Se déconnecter
                            <i class="bi bi-box-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div><!-- .container -->
        </nav><!-- .navbar -->
    </header>
