<?php
    // Variables d'affichage
    $strTitle = 'Produits';

    // Variables de fonctionnement
    $strPage = 'product';
    
    // Inclusion de l'en-tête
    include('_partials/header-page.php');

    // Récupération de l'Id de la boulangerie dans l'URL ou dans la session
    $intBakId = $_GET['bakid'] ?? (is_user() ? $_SESSION['bakid'] ?? 0 : 0);

    // Instanciation d'un nouvel objet
    $objCategoryModel = model('category');

    // Récupération de toutes les caatégories
    $arrCategories = $objCategoryModel->findAll();

    // Instanciation d'un nouvel objet
    $objProductModel = model('product');

    // Si l'identifiant de boulangerie existe
    if ($intBakId > 0)
    {
        // Récupération des produits selon l'Id de la boulangerie
        $arrProducts = $objProductModel->findByBakId($intBakId);

        // Instanciation d'un nouvel objet
        $objBakeryModel = model('bakery');

        // Récupération des informations de la boulangerie
        $arrBakery = $objBakeryModel->find($intBakId);
    }
    else
    {
        // Récupération de tous les produits
        $arrProducts = $objProductModel->findAll();

        // Initialisation d'un tableau vide
        $arrBakery = array();
    }

    // Inclusion de la section principale
    include('_partials/main-page.php');
?>

    <div class="row">

        <?php foreach($arrCategories as $arrCategory): ?>

            <h3><?= esc($arrCategory['cat_name']); ?></h3>
            
            <?php if ($arrProducts): ?>

                <?php foreach($arrProducts as $arrProduct): ?>
                
                    <?php if ($arrProduct['cat_id'] == $arrCategory['cat_id']): ?>

                        <div class="col-lg-4 col-sm-6">
                            
                            <div class="card mb-4">
                                <?php if (isset($arrProduct['bak_name'])): ?>
                                <a href="<?= site_url(); ?>/showcase.php?bakid=<?= (int)$arrProduct['prod_bak_id']; ?>">
                                <?php endif; ?>
                                    <img class="card-img-top" 
                                        src="<?= base_url(); ?><?= Paths::UPLOAD_PATH; ?><?= esc($arrProduct['prod_photo']); ?>" 
                                        alt="<?= $arrProduct['prod_name']; ?>">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                        <?php 
                                            // Si la mise à jour de la fiche a été effectuée il y moins de 30 jours
                                            if (strtotime($arrProduct['prod_updated_at']) > strtotime('-30 days')): ?>
                                            <span class="float-end badge badge-primary">NEW</span>
                                        <?php endif; ?>
                                        <?= esc($arrProduct['prod_name']); ?>
                                        </h4>
                                        <p class="card-text mb-2">
                                            <i class="bi bi-box-seam text-muted text-indent-n me-1"></i>
                                            <?= esc($arrProduct['prod_weight']); ?> g
                                            <i class="bi bi-dot text-muted mx-1"></i>
                                            <i class="bi bi-tag text-muted me-1"></i>
                                            <?= esc($arrProduct['prod_price']); ?> €
                                        </p>
                                        <p class="card-text mt-0">
                                            <i class="bi bi-chat-left-text text-muted text-indent-n me-1"></i>
                                            <?= strip_allowable_tags($arrProduct['prod_desc']); ?>
                                        </p>
                                        <?php if (isset($arrProduct['bak_name'])): ?>
                                        <p class="card-text mt-0">
                                            <i class="bi bi-shop text-indent-n me-1"></i>
                                            <strong><?= $arrProduct['bak_name']; ?></strong>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                <?php if (isset($arrProduct['bak_name'])): ?>
                                </a>
                                <?php endif; ?>
                            </div>

                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            <?php else: ?>

                <p><?= lang('product_none'); ?></p>

            <?php endif; ?>

        <?php endforeach; ?>
    
    </div><!-- .row -->

<?php
    // Inclusion du pied de page
    include('_partials/footer-page.php');