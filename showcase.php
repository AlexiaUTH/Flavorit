<?php
    // Variables d'affichage
    $strTitle = 'Page vitrine';

    // Variables de fonctionnement
    $strPage = 'showcase';

    // Inclusion de l'en-tête
    include('_partials/header-showcase.php');

    // Instanciation d'un nouvel objet du modèle de boulangeries
    $objBakeryModel = model('bakery');

    // Instanciation d'un nouvelle entité de l'objet boulangerie
    $objBakery = entity('bakery');

    // Instanciation d'un nouvelle entité de l'objet ville
    $objCity = entity('city');

    // Récupération de l'Id de la boulangerie dans l'URL
    $intBakId = $_GET['bakid'] ?? 0;
    
    // Si l'identifiant de la boulangerie inférieur à 1
    if ($intBakId < 1)
    {
        // On redirige l'utilisateur vers la page d'accueil
        redirect('index');
    }

    // Affectation du résultat dans un tableau
    $arrBakery = $objBakeryModel->find($intBakId);

    // Remplissage de l'entité de l'objet boulangerie avec les données de la BDD
    $objBakery->setId($arrBakery['bak_id']);
    $objBakery->setType($arrBakery['bak_type']);
    $objBakery->setName($arrBakery['bak_name']);
    $objBakery->setAddress($arrBakery['bak_address']);
    $objBakery->setPhone($arrBakery['bak_phone']);
    $objBakery->setOpeningHours($arrBakery['bak_opening_hours']);
    $objBakery->setAbout($arrBakery['bak_about']);
    $objBakery->setMaps($arrBakery['bak_maps']);
    $objBakery->setImg($arrBakery['bak_img']);
    $objBakery->setEmail($arrBakery['bak_email']);

    // Remplissage de l'entité de l'objet ville avec les données de la BDD
    $objCity->setZipCode($arrBakery['city_zip_code']);
    $objCity->setName($arrBakery['city_name']);

    // Instanciation d'un nouveau modèle de produits
    $objProductModel = model('product');

    // On récupère les informations des produits de la boulangerie
    $arrProducts = $objProductModel->findByBakId($intBakId);

    // On initialise un tableau
    $arrUniqueProd = array();

    // On boucle sur les produits
    foreach ($arrProducts as $arrProduct)
    {
        $arrUniqueProd[] = $arrProduct['cat_id'];
    }
    $arrUniqueProd = array_unique($arrUniqueProd);
?>

    <!-- En-tête -->
    <header class="img-overlay" style="background-image: url('<?= $objBakery->getImg(); ?>'), radial-gradient(transparent, rgba(0, 0, 0, .67))">

        <div class="container text-center text-white">

            <div class="h-100vh">
                
                <?php 
                // Inclusion de la barre de navigation des pages vitrines 
                include('_partials/navbar-showcase.php');
                ?>

                <div class="text-shadow">
                    <h1 class="page-title"><?= $objBakery->getName(); ?></h1>
                    <p class="subtitle text-uppercase"><?= $objBakery->getType(); ?></p>
                </div>

            </div>

        </div><!-- .container -->

    </header>

    <main class="bg-white">

        <section>

            <div class="container">

                <div class="row">

                    <div class="col-lg-6">
                        <img src="<?= $objBakery->getImg(); ?>" alt="<?= $objBakery->getName(); ?>" class="img-fluid">
                    </div>

                    <div class="col-lg-6">

                        <h2><?= $objBakery->getName(); ?></h2>
                        <?= $objBakery->getAbout(); ?>

                    </div>

                </div><!-- .row -->

            </div><!-- .container -->

        </section>

        <section>

            <div class="container">

                <div class="row">

                    <div class="col-lg-6 order-1 order-lg-0">

                        <h2>Nos produits</h2>
                        <h3>Découvrez nos produits artisanaux et pains spéciaux</h3>
                        <p>&nbsp;</p>
                        <a href="<?= site_url(); ?>/product.php?bakid=<?= $intBakId; ?>" class="btn btn-outline-dark">Voir tous nos produits</a>

                    </div>

                    <div class="col-lg-6">

                        <div class="row g-3">

                            <?php if (in_array(1, $arrUniqueProd)): ?>
                            <div class="col-sm-6">
                                <div style="background-image: url('<?= base_url(); ?>assets/img/pain.jpg'), linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, .9));" class="img-overlay img-height position-relative">
                                    <h2 class="img-title">Pains</h2>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (in_array(2, $arrUniqueProd)): ?>
                            <div class="col-sm-6">
                                <div style="background-image: url('<?= base_url(); ?>assets/img/viennoiserie.jpg'), linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, .9));" class="img-overlay img-height position-relative">
                                    <h2 class="img-title">Viennoiseries</h2>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (in_array(3, $arrUniqueProd)): ?>
                            <div class="col-sm-6">
                                <div style="background-image: url('<?= base_url(); ?>assets/img/patisserie.jpg'), linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, .9));" class="img-overlay img-height position-relative">
                                    <div class="img-title">Pâtisseries</div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (in_array(4, $arrUniqueProd)): ?>
                            <div class="col-sm-6">
                                <div style="background-image: url('<?= base_url(); ?>assets/img/sandwich.jpg'), linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, .9));" class="img-overlay img-height position-relative">
                                    <h2 class="img-title">Sandwiches</h2>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>

                    </div>

                </div><!-- .row -->

            </div><!-- .container -->

        </section>

        <section>

            <div class="container">

                <div class="row">

                    <div class="col-lg-6">
                        <div class="ratio ratio-1x1">
                            <?= $objBakery->getMaps(); ?>
                        </div>    
                    </div>
                    
                    <div class="col-lg-6">

                        <h2>Près de chez vous</h2>
                        <h3>Sur <?= $objCity->getName(); ?> et environs</h3>
                        <h4><?= $objBakery->getName(); ?></h4>
                        <h5><?= $objBakery->getType(); ?></h5>
                        <p>
                            <?= $objBakery->getAddress(); ?><br>
                            <?= $objCity->getZipCode(); ?> <?= $objCity->getName(); ?><br>
                            Tél. <?= $objBakery->getPhone(); ?>
                        </p>
                        <h5>Horaires d'ouverture</h5>
                        <p><?= $objBakery->getOpeningHours(); ?></p>
                        <p><a class="btn btn-outline-dark" 
                              href="mailto:<?= $objBakery->getEmail(); ?>">Nous contacter</a>
                        </p>

                    </div>

                </div><!-- .row -->

            </div><!-- .container -->

        </section>

    </main><!-- main -->

<?php
    // Inclusion du pied de page
    include('_partials/footer-frontpage.php');