<?php
    // Chargement de la séquence de démarrage
    require('bootstrap.php');

    // On récupère le contenu de la variable de session `message` le cas échéant
    if (isset($_SESSION['message']) && $_SESSION['message'] == lang('admin_inactive'))
    {
        $strMessage = $_SESSION['message'];
    }
    else
    {
        $strMessage = lang('logout');
    }

    // Destruction de la session
    session_destroy();

    // Redémarrage de la session
    session_start();

    // Message d'information
    $_SESSION['message'] = $strMessage;

    // Redirection vers le formulaire de connexion
    redirect('login');