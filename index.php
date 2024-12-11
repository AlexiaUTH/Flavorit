<?php
    // Variables d'affichage
    $strTitle = 'Accueil';

    // Variables de fonctionnement
    $strPage = 'index';
    
    // Inclusion de l'en-tête
    include('_partials/header-frontpage.php');

    // Instanciation d'un nouveau modèle de boulangerie
    $objBakeryModel = model('bakery');

    // On vérifie si l'utilisateur a un favori dans sa session
    $boolHasLike = is_user() && ! empty($_SESSION['bakid']);
    
    // Affectation du résultat dans un tableau
    if ($boolHasLike)
    {
        $arrBakeries = $objBakeryModel->findAll(0, true);
    }
    else
    {
        $arrBakeries = $objBakeryModel->findAll(3);
    }

    // Instanciation d'un nouveau modèle de villes desservies
    $objServedcityModel = model('servedcity');

    // On récupère le résultat dans un tableau
    $arrServedcities = $objServedcityModel->numDistinctRows();

    // Récupération des messages d'information
    $strMessage = $_SESSION['message'] ?? '';
?>

    <!-- Section principale -->
    <main>

        <section class="bg-white">

            <div class="container">

                <h2 class="mb-4" id="bakeries">
                    Boulangeries <?= $boolHasLike ? 'préférées (' . count($arrBakeries) . ')' : 'partenaires'; ?>
                </h2>
                <div class="row">

                    <?php 
                    // Pour chaque ligne du tableau des boulangeries
                    foreach($arrBakeries as $arrBakery) 
                    {
                        // Instanciation d'une nouvelle entité de l'objet boulangerie
                        $objBakery = entity('bakery');

                        // Remplissage de l'entité de l'objet boulangerie avec les données de la BDD
                        $objBakery->setId($arrBakery['bak_id']);
                        $objBakery->setName($arrBakery['bak_name']);
                        $objBakery->setAddress($arrBakery['bak_address']);
                        $objBakery->setPhone($arrBakery['bak_phone']);
                        $objBakery->setOpeningHours($arrBakery['bak_opening_hours']);
                        $objBakery->setAddress($arrBakery['bak_address']);
                        $objBakery->setImg($arrBakery['bak_img']);

                        // Instanciation d'une nouvelle entité de l'objet ville
                        $objCity = entity('city');

                        // Remplissage de l'entité de l'objet ville avec les données de la BDD
                        $objCity->setZipCode($arrBakery['city_zip_code']);
                        $objCity->setName($arrBakery['city_name']);
                    ?>
                    <div class="col-md-6 col-lg-4">

                        <div class="card mb-4">
                            <a href="<?= site_url(); ?>/showcase.php?bakid=<?= $objBakery->getId(); ?>">
                                <img class="card-img-top" 
                                    src="<?= base_url(); ?><?= $objBakery->getImg(); ?>" 
                                    alt="<?= $objBakery->getName(); ?>">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <?= $objBakery->getName(); ?>
                                        <?php if (logged_in()): ?>
                                        <a href="<?= site_url(); ?>/add_to_favorite.php?bakid=<?= $objBakery->getId(); ?>">
                                        <?php if (!is_admin()): ?>
                                            <?php if ($arrBakery['cb_like'] == 1): ?>
                                            <i class="bi bi-star-fill float-end"></i>
                                            <?php else: ?>
                                            <i class="bi bi-star float-end"></i>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        </a>
                                        <?php endif; ?>
                                    </h4>
                                    <p class="card-text mb-2">
                                        <i class="bi bi-geo-alt-fill text-muted text-indent-n"></i>
                                        <?= $objBakery->getAddress(); ?><br>
                                        <?= $objCity->getZipCode(); ?> <?= $objCity->getName(); ?><br>
                                        <strong><?= $objBakery->getPhone('Tél. '); ?></strong>
                                    </p>
                                    <p class="card-text mt-0">
                                        <!-- <i class="bi bi-watch text-lightgray text-indent-n"></i> -->
                                        <?= $objBakery->getOpeningHours(); ?>
                                    </p>
                                </div>
                            </a>
                        </div><!-- .card -->

                    </div><!-- . col-lg-4 -->
                    <?php } ?>

                </div><!-- .row -->

                <a href="<?= site_url(); ?>/bakery.php" class="btn btn-outline-dark mb-4">
                    Voir toutes les Boulangeries
                </a>

            </div><!-- .container -->

        </section><!-- .bg-white -->

        <section class="bg-yellow">

            <div class="container">

                <h2 class="mb-5">Choisir sa boulangerie préférée</h2>
                
                <div class="row text-center">
                    <div class="d-none d-xl-block">
                        <img src="<?= base_url(); ?>assets/img/etapes.png" class="img-fluid" alt="Étapes à suivre">
                    </div>
                    <div class="col-lg-6 d-xl-none">
                        <img src="<?= base_url(); ?>assets/img/etape1.png" width="400" class="img-fluid" alt="Étape #1">
                    </div>
                    <div class="col-lg-6 d-xl-none">
                        <img src="<?= base_url(); ?>assets/img/etape2.png" width="400" class="img-fluid" alt="Étape #2">
                    </div>
                    <div class="col-lg-6 offset-lg-3 d-xl-none">
                        <img src="<?= base_url(); ?>assets/img/etape3.png" width="400" class="img-fluid" alt="Étape #3">
                    </div>
                </div><!-- .row -->

            </div><!-- .container -->

        </section><!-- .bg-yellow -->

        <section class="bg-dark text-white" id="odometer-section">

            <div class="container">

                <div class="row">

                    <div class="col-lg-6 order-2 order-md-1">

                        <h2>Chiffres clés</h2>
                        
                        <p class="lead"><strong>Flavor’it</strong> vous permet de découvrir les saveurs des produits d’artisans locaux présents sur notre territoire. En effet, notre plateforme vous met en relation avec nos boulangeries partenaires via une page vitrine vous présentant leurs produits.</p>

                        <p class="lead">Des boulangeries vous proposant des produits locaux et biologiques prêtant une attention particulière à la sélection des ingrédients.</p>
                        
                        <a href="<?= site_url(); ?>/about.php" class="btn btn-outline-white">
                            À propos de nous
                        </a>
                        
                    </div><!-- .col-6 -->
                    
                    <div class="col-lg-6 order-1 order-md-2">

                        <div class="text-end">

                            <div class="number-1">
                                <span class="odometer-target"><?= $objBakeryModel->numRows(); ?></span>
                                <span class="text-lightgray">#</span><span id="odometer">0</span>
                            </div>
                            <h3 class="mt-0">Boulangeries partenaires</h3>
                            
                            <div class="number-2"><?= esc($arrServedcities['count']); ?></div>
                            <h5 class="mt-0">Villes desservies</h5>
                            
                        </div>

                    </div><!-- .col-6 -->

                </div><!-- .row -->

            </div><!-- .container -->

        </section><!-- .bg-dark -->

    </main>

<?php
    // Inclusion des scripts JS
    $arrScripts = array('odometer', 'odometer.js');

    // Inclusion du pied de page
    include('_partials/footer-frontpage.php');