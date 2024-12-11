<?php
    // Chargement de la séquence de démarrage
    require('bootstrap.php');

    // Si l'utilisateur n'est pas connecté ou n'est pas un administrateur
    if (!logged_in())
    {
        // Message d'erreur
        $_SESSION['message'] = lang('error_403');

        // On le redirige vers la page de connexion
        redirect('login');
    }

    // Récupération de l'Id de la boulangerie dans l'URL
    $intBakId = $_GET['bakid'] ?? 0;

    // Instantisation d'un nouvel objet
    $objCustomerbakeryModel = model('customerbakery');

    // On affecte le résultat à un tableau
    $arrCustomerBakery = $objCustomerbakeryModel->findByBakId($intBakId);

    // Si la boulangerie existe déjà dans la table des favoris
    if ($arrCustomerBakery)
    {
        // On met à jour l'enregistrement
        $objCustomerbakeryModel->update($intBakId);

        // On affecte le résultat à un tableau
        $arrNewCustomerBakery = $objCustomerbakeryModel->findByBakId($intBakId);

        // Récupération de la dernière valeur `like` d'une boulangerie
        $boolLike = $arrNewCustomerBakery['cb_like'];

        // Messages d'information
        if ($boolLike) 
        {
            $_SESSION['message'] = lang('bakery_like');

            // Enregistrement de l'Id de la boulangerie favorite en session
            $_SESSION['bakid'] = $intBakId;
        } 
        else
        {
            $_SESSION['message'] = lang('bakery_unlike');

            // On récupère les informations de la dernière boulangerie préférée
            $arrLike = $objCustomerbakeryModel->find();

            // S'il y en a au moins une
            if ($arrLike)
            {
                // On récupère son Id et on l'enregistre dans la session
                $_SESSION['bakid'] = $arrLike['cb_bak_id'];
            }
            else
            {
                // Sinon on supprime la variable de session correspondante
                unset($_SESSION['bakid']);
            }
        }
    }
    // Sinon
    else
    {
        // On insère un nouvel enregistrement
        $objCustomerbakeryModel->insert($intBakId);

        // Message d'information
        $_SESSION['message'] = lang('bakery_like');

        // Enregistrement de l'Id de la boulangerie favorite en session
        $_SESSION['bakid'] = $intBakId;
    }

    // Redirection vers la page d'accueil
    header('Location:index.php#bakeries');