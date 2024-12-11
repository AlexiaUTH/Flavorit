<?php
    // Variables d'affichage
    $strTitle    = 'Catégories';
    $strSubtitle = 'Ajouter une catégorie';

    // Variables de fonctionnement
    $strPage  = 'add_category';

    // Inclusion de l'en-tête
    include('_partials/header-dashboard.php');

    // Si l'utilisateur n'est pas un administrateur
    if (is_admin() === false)
    {
        $_SESSION['message'] = lang('error_403');

        // Redirection vers la page de connexion
        redirect('login');
    }

    // Instanciation d'un nouveau modèle de catégories
    $objCategoryModel = model('category');

    // Récupération des variables du formulaire
    $strName = $_POST['name'] ?? '';

    // Initialisation du tableau des erreurs
    $arrErrors = array();
    
    // Instanciation d'une nouvelle entité de l'objet catégorie
    $objCategory = entity('category');

    // Remplissage de l'entité de l'objet catégorie
    $objCategory->setName($strName);

    // Si le formulaire a été envoyé
    if (count($_POST) > 0)
    {
        // Gestion des erreurs
        if ($objCategory->getName() == '') $arrErrors['name'] = lang('category_name_required');
        
        // S'il n'y a pas d'erreur
        if (count($arrErrors) == 0)
        {
            // Si l'insertion est effective
            if ($objCategoryModel->insert($objCategory))
            {
                // Message d'information
                $_SESSION['message'] = lang('category_created');

                // Redirection vers la liste des produits
                redirect('list_category');
            }
            else
            {
                // Message d'erreur
                $_SESSION['message'] = lang('error_500');
            }
        }
    }
?>

    <main class="container">

        <div class="row">
            
            <div class="col-lg-8 offset-lg-2">

                <h2 class="mb-0"><?= $strTitle; ?></h2>
                <h5 class="text-uppercase text-muted mb-4"><?= $strSubtitle; ?></h5>

                <?php if (count($arrErrors) > 0): ?>
                    <?= alert('error', $arrErrors); ?>
                <?php endif; ?>

                <form action="<?= site_url(); ?>/add_category.php" method="POST">

                    <div class="mb-3">
                        <label for="name" class="form-label">Libellé <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control <?php if (isset($arrErrors['name'])) echo 'is-invalid'; ?>" value="<?= $objCategory->getName(); ?>" placeholder="Libellé de la catégorie">
                    </div>

                    <footer class="py-4">
                        <button type="submit" class="btn btn-primary me-1">Enregistrer</button>
                        <a href="<?= site_url(); ?>/list_category.php" class="btn btn-outline-dark">Annuler</a>
                    </footer>

                </form>

            </div>
            
        </div>

    </main>

<?php 
    // Inclusion du pied de page
    include('_partials/footer.php');