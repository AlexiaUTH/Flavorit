<?php 
    // Inclusion de l'en-tête générique
    include('_partials/header.php'); 
?>

    <!-- Grille Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css">

    <!-- Feuille de de style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
</head>
<body class="page">

    <!-- En-tête -->
    <header class="cover img-overlay">

        <div class="container text-center text-white">
                
        <?php 
            // Inclusion de la barre de navigation horizontale
            include('_partials/navbar.php'); 
        ?>

        </div><!-- .container -->

    </header>
