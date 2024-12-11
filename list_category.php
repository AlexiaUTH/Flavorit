<?php
    // Variables d'affichage
    $strTitle    = 'Catégories';
    $strSubtitle = 'Liste des catégories';

    // Variables de fonctionnement
    $strPage = 'list_category';

    // Inclusion de l'en-tête
    include('_partials/header-dashboard.php');

    // Si l'utilisateur n'est pas un administrateur
    if (!is_admin())
    {
        // Message d'erreur
        $_SESSION['message'] = lang('error_403');

        // On le redirige vers la page de connexion
        redirect('logout');
    }

    // Récupération des messages d'information
    $strMessage = $_SESSION['message'] ?? '';

    // Instanciation d'un nouveau modèle de catégories
    $objCategoryModel = model('category');

    // Récupération de tous les catégories dans un tableau
    $arrCategories = $objCategoryModel->findAll();

    // Initialisation du tableau des catégories à afficher
    $arrCategoryToDisplay = array();

    // Remplissage de l'objet produit
    foreach($arrCategories as $arrCategory)
    {
        // Instanciation d'une nouvelle entité de l'objet catégorie
        $objCategory = entity('category');
        $objCategory->setId($arrCategory['cat_id']);
        $objCategory->setName($arrCategory['cat_name']);
        $arrCategoryToDisplay[] = $objCategory;
    }

    // Récupération des messages d'information
    $strMessage = $_SESSION['message'] ?? '';
?>

    <main class="container">

        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <h2 class="mb-0"><?= $strTitle; ?></h2>
                <h5 class="text-uppercase text-muted mb-4"><?= $strSubtitle; ?></h5>

                <?php if ($strMessage != ''): ?>
                    <?= alert('warning', array($strMessage)); ?>
                <?php endif; ?>

                <a href="<?= site_url(); ?>/add_category.php" class="btn btn-primary mb-4">
                    <i class="bi bi-plus-square me-1"></i>
                    Ajouter une catégorie
                </a>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Libellé</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($arrCategoryToDisplay): ?>
                        <?php foreach($arrCategoryToDisplay as $intKey => $objCategory): ?>
                        <tr>
                            <td><?= ++$intKey; ?></td>
                            <td><?= $objCategory->getName(); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">
                                <?= lang('category_none'); ?>
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