<?php
    // Variables d'affichage
    $strTitle = 'Boulangeries partenaires';

    // Variables de fonctionnement
    $strPage = 'bakery';
    
    // Inclusion de l'en-tête
    include('_partials/header-page.php');

    // Inclusion de la section principale
    include('_partials/main-page.php');

    // Instanciation d'un nouveau modèle de boulangeries
    $objBakeryModel = model('bakery');
    
    // Affectation du résultat dans un tableau
    $arrBakeries = $objBakeryModel->findAll();

    // Instanciation d'un nouveau modèle de villes
    $objCityModel = model('city');

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
                            <i class="bi bi-star-fill star-primary float-end"></i>
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

    </div><!-- . col-md-6.col-lg-4 -->
    <?php } ?>

<?php
    // Inclusion du pied de page
    include('_partials/footer-page.php');