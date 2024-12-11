<?php
    // Variables d'affichage
    $strTitle    = 'Produits';
    $strSubtitle = 'Liste des produits';

    // Variables de fonctionnement
    $strPage = 'list_product';

    // Inclusion de l'en-tête
    include('_partials/header-dashboard.php');

    // Si l'utilisateur n'est pas un super/administrateur
    if (is_user())
    {
        // Message d'erreur
        $_SESSION['message'] = lang('error_403');

        // On le redirige vers la page de connexion
        redirect('logout');
    }

    // Récupération des messages d'information
    $strMessage = $_SESSION['message'] ?? '';

    // Instanciation d'un nouveau modèle de produits
    $objProductModel = model('product');

    // Récupération des produits dans un tableau
    $arrProducts = $objProductModel->findByBakId($_SESSION['bakid']);

    // Initialisation du tableau des produits à afficher
    $arrProductToDisplay = array();

    // Remplissage de l'objet produit
    foreach($arrProducts as $arrProduct)
    {
        // Instanciation d'une nouvelle entité de l'objet produit
        $objProduct = entity('product');
        $objProduct->setId($arrProduct['prod_id']);
        $objProduct->setName($arrProduct['prod_name']);
        $objProduct->setDate($arrProduct['prod_updated_at']);
        $objProduct->setCatName($arrProduct['cat_name']);
        $arrProductToDisplay[] = $objProduct;
    }
?>

    <main class="container">

        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <h2 class="mb-0"><?= $strTitle; ?></h2>
                <h5 class="text-uppercase text-muted mb-4"><?= $strSubtitle; ?></h5>

                <?php if ($strMessage != ''): ?>
                    <?= alert('warning', array($strMessage)); ?>
                <?php endif; ?>

                <a href="<?= site_url(); ?>/add_product.php" class="btn btn-primary mb-4">
                    <i class="bi bi-plus-square me-1"></i>
                    Ajouter un produit
                </a>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Libellé</th>
                            <th>Catégorie</th>
                            <th>Date de mise à jour</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($arrProductToDisplay): ?>
                        <?php foreach($arrProductToDisplay as $intKey => $objProduct): ?>
                        <tr>
                            <td><?= ++$intKey; ?></td>
                            <td><?= $objProduct->getName(); ?></td>
                            <td><?= $objProduct->getCatName(); ?></td>
                            <td><?= $objProduct->getFormattedDate('d/m/Y'); ?></td>
                            <td class="text-end">
                                <a href="<?= site_url(); ?>/delete_product.php?prodid=<?= $objProduct->getId(); ?>" class="btn btn-warning btn-sm btn">
                                    <i class="bi bi-trash me-1"></i>
                                    Supprimer
                                </a>
                                <a href="<?= site_url(); ?>/edit_product.php?prodid=<?= $objProduct->getId(); ?>" class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Modifier
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                <?= lang('product_none'); ?>
                            </td>
                        <tr>
                    <?php endif; ?>
                    </tbody>
                </table>

            </div><!-- .col-lg-8 -->

        </div><!-- .row -->

    </main><!-- .container -->

<?php
    // Inclusion du pied de page
    include('_partials/footer.php');