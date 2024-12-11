<?php

// Chargement des paramètres de configuration des alertes
require('config/alert.php');

/*
| ----------------------------------------------------
| Fonctions d'alertes
| ----------------------------------------------------
*/

/**
 * Fonction permettant de générer des alertes Bootstrap
 *
 * @param  string $key
 * @param  array $message
 * @return void
 */
function alert(string $intKey, array $arrMessages = array()): void
{
    if (count($arrMessages) > 0) 
    {
        // Récupération de la classe CSS
        $strClass = Alert::$alerts[$intKey];

        // Inclusion du modèle d'alerte HTML
        include(Alert::$template);

        // Si la variable de session 'message' existe on la supprime
        if (isset($_SESSION['message'])) unset($_SESSION['message']);
    }
}