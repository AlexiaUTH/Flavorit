<?php
    // Chargement de la séquence de démarrage
    require('bootstrap.php');

    // Si l'utilisateur n'est pas un super administrateur
    if (!is_superadmin())
    {
        $_SESSION['message'] = lang('error_403');

        // Redirection vers la page de login
        redirect('logout');
    }

    // Récupération de l'Id de l'utilisateur dans l'URL
    $intUserId = $_GET['userid'] ?? 0;

    // Instanciation d'un nouveau modèle de produits
    $objAdminModel = model('admin');
    
    // Si la mise à jour est effective
    if ($objAdminModel->toggle($intUserId))
    {
        // Message d'information
        $_SESSION['message'] = lang('user_toggled');
    }
    // Sinon
    else
    {
        // Message d'erreur
        $_SESSION['message'] = lang('error_500');
    }

    // Redirection vers la liste des utilisateurs
    redirect('list_user');