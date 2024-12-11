<?php
    // Chargement de la séquence de démarrage
    require('bootstrap.php');

    // Si l'utilisateur n'est pas un administrateur
    if (!is_admin())
    {
        $_SESSION['message'] = lang('error_403');

        // Redirection vers la page de login
        redirect('login');
    }

    // Récupération de l'Id du produit dans l'URL
    $intProdId = $_GET['prodid'] ?? 0;

    // Instanciation d'un nouveau modèle de produits
    $objProductModel = model('product');
    
    // Si la suppression est effective
    if ($objProductModel->delete($intProdId))
    {
        // Message d'information
        $_SESSION['message'] = lang('product_deleted');
    }
    // Sinon
    else
    {
        // Message d'erreur
        $_SESSION['message'] = lang('error_500');
    }

    // Redirection vers la liste des produits
    redirect('list_product');