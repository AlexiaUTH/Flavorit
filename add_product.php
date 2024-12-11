<?php
    // Variables d'affichage
    $strTitle    = 'Produits';
    $strSubtitle = 'Ajouter un produit';

    // Variables de fonctionnement
    $strPage  = 'add_product';

    // Inclusion de l'en-tête
    include('_partials/header-dashboard.php');

    // Si l'utilisateur n'est pas un administrateur
    if (!is_admin())
    {
        $_SESSION['message'] = lang('error_403');

        // Redirection vers la page de connexion
        redirect('logout');
    }

    // Instanciation d'un nouveau modèle de produits
    $objProductModel = model('product');

    // Instanciation d'un nouveau modèle de catégories
    $objCategoryModel = model('category');

    // On récupère les informations de toutes les catégories
    $arrCategories = $objCategoryModel->findAll();

    // Récupération des variables du formulaire
    $strName     = $_POST['name']     ?? '';
    $intWeight   = $_POST['weight']   ?? 0;
    $floatPrice  = $_POST['price']    ?? 0;
    $strDesc     = $_POST['desc']     ?? '';
    $intCatId    = $_POST['catid']    ?? 0;
    $intBakId    = $_SESSION['bakid'] ?? 0;
    $arrFile     = $_FILES['file']    ?? array();

    // Initialisation du tableau des erreurs
    $arrErrors = array();
    
    // Instanciation d'une nouvelle entité de l'objet produit
    $objProduct = entity('product');

    // Remplissage de l'entité de l'objet produit
    $objProduct->setName($strName);
    $objProduct->setWeight($intWeight);
    $objProduct->setPrice($floatPrice);
    $objProduct->setDesc($strDesc);
    $objProduct->setCatId($intCatId);
    $objProduct->setBakId($intBakId);

    // Si le formulaire a été envoyé
    if (count($_POST) > 0)
    {
        // Gestion des erreurs
        if ($objProduct->getName()   == '') $arrErrors['name']   = lang('product_name_required');
        if ($objProduct->getWeight() == 0)  $arrErrors['weight'] = lang('product_weight_required');

        // Si le fichier est absent
        if ($arrFile['error'] == 4)
        {
            $arrErrors['photo'] = lang('product_photo_required');   
        }
        // Si le type de fichier n'est pas autorisé
        elseif (!in_array($arrFile['type'], App::APP_MIME_TYPES['image']))
        {
            $arrErrors['photo'] = lang('file_type_error'); 
        }
        elseif ($arrFile['error'] > 0)
        {
            $arrErrors['photo'] = lang('file_error');
        }
        // S'il n'y a aucune erreur sur le fichier image
        if ($arrFile['error'] == 0)
        {
            // Nom du fichier original
            $strOriginalName = $arrFile['name'];

            // Nom du fichier temporaire
            $strTempName = $arrFile['tmp_name'];

            // Si le déplacement du fichier est effectif
            if (move_uploaded_file($strTempName, Paths::UPLOAD_PATH . $strOriginalName))
            {
                // On remplit l'entité de l'objet produit
                $objProduct->setPhoto($strOriginalName);
            }
            // Sinon
            else
            {
                // Message d'erreur
                $arrErrors['photo'] = lang('file_move_error'); 
            }
        }
        
        if ($objProduct->getPrice() == 0) $arrErrors['price'] = lang('product_price_required');
        if ($objProduct->getCatId() == 0) $arrErrors['catid'] = lang('product_cat_id_required');
        
        // S'il n'y a pas d'erreur
        if (count($arrErrors) == 0)
        {
            // Si l'insertion est effective
            if ($objProductModel->insert($objProduct))
            {
                // Message d'information
                $_SESSION['message'] = lang('product_created');

                // Redirection vers la liste des produits
                redirect('dashboard');
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
                <h5 class="text-uppercase text-muted mb-3"><?= $strSubtitle; ?></h5>

                <?php if (count($arrErrors) > 0): ?>
                    <?= alert('error', $arrErrors); ?>
                <?php endif; ?>

                <form action="<?= site_url(); ?>/add_product.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="name" class="form-label">Libellé <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control <?php if (isset($arrErrors['name'])) echo 'is-invalid'; ?>" value="<?= $objProduct->getName(); ?>" placeholder="Libellé du produit">
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Poids <span class="text-danger">*</span></label>
                        <input type="number" name="weight" id="weight" min="0" class="form-control <?php if (isset($arrErrors['weight'])) echo 'is-invalid'; ?>" value="<?= $objProduct->getWeight(); ?>" placeholder="Poids en grammes">
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photographie <span class="text-danger">*</span></label>
                        <input type="file" name="file" id="photo" class="form-control <?php if (isset($arrErrors['photo'])) echo 'is-invalid'; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Prix <span class="text-danger">*</span></label>
                        <input type="number" name="price" id="price" min="0" step="0.01" class="form-control <?php if (isset($arrErrors['price'])) echo 'is-invalid'; ?>" value="<?= $objProduct->getPrice(); ?>" placeholder="Prix en euros">
                    </div>

                    <div class="mb-3">
                        <label for="mytextarea" class="form-label">Description</label>
                        <textarea name="desc" id="mytextarea" class="form-control" rows="4" placeholder="Description du produit, allergènes, etc."><?= $objProduct->getDesc(); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="catid" class="form-label">Catégorie du produit <span class="text-danger">*</span></label>
                        <select name="catid" id="catid" class="form-control <?php if (isset($arrErrors['catid'])) echo 'is-invalid'; ?>">
                            <option value="0">-- Sélectionner une catégorie</option>
                            <?php foreach($arrCategories as $arrCategory): ?>
                            <option value="<?= $arrCategory['cat_id']; ?>" <?php if ($arrCategory['cat_id'] == $objProduct->getCatId()) echo 'selected'; ?>><?= esc($arrCategory['cat_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <footer class="py-4">
                        <button type="submit" class="btn btn-primary me-1">Enregistrer</button>
                        <a href="<?= site_url(); ?>/list_product.php" class="btn btn-outline-dark">Annuler</a>
                    </footer>

                </form>

            </div>
            
        </div>

    </main>

<?php 
    // Inclusion des scripts JS
    $arrScripts = array('tinymce', 'tinymce.js');

    // Inclusion du pied de page
    include('_partials/footer.php');