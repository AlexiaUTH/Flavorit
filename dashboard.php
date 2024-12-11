<?php
    // Variables d'affichage
    $strTitle = 'Tableau de bord';

    // Variables de fonctionnement
    $strPage = 'dashboard';

    // Inclusion de l'en-tête
    include('_partials/header-dashboard.php');

    // Si l'utilisateur n'est pas un administrateur
    if (!is_admin() && !is_superadmin())
    {
        // Message d'erreur
        $_SESSION['message'] = lang('error_403');

        // On le redirige vers la page de connexion
        redirect('login');
    }

    // Si l'utilisateur est un super administrateur
    if (is_superadmin())
    {
        redirect('list_user');
    }
    else 
    {
        redirect('list_product');
    }