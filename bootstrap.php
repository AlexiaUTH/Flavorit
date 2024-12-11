<?php
    // Démarrage de la session
    session_start();

    // Version minimum de PHP requise
    $strMinPhpVersion = '8.1';
    if (version_compare(PHP_VERSION, $strMinPhpVersion, '<')) {
        $strMessage = sprintf(
            'Votre version de PHP doit être au moins égale à %s. Votre version de PHP est : %s',
            $strMinPhpVersion,
            PHP_VERSION
        );

        exit($strMessage);
    }

    // Chargement des fonctions transversales de l'application
    require('helpers/app_helper.php');

    // Chargement des fonctions d'alertes de l'application
    require('helpers/alert_helper.php');

    // Chargement des fonctions d'authentification
    require('helpers/auth_helper.php');

    // Chargement des fonctions de gestion des assets de l'application
    require('helpers/assets_helper.php');

    // Chargement de la gestion des erreurs de l'application
    require('config/errors.php');

    // Chargement des chemins de l'application
    require('config/paths.php');