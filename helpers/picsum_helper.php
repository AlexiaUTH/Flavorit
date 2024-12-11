<?php

// Chargement des paramètres de configuration de Picsum
require('config/picsum.php');

/*
| ----------------------------------------------------
| Fonctions liées au chargement des images 'Picsum'
| ----------------------------------------------------
*/

/**
 * Fonction permettant de retourner un ID Picsum aléatoire
 *
 * @param  boolean $default
 * @return integer
 */
function random_picsum_id(bool $default = false): int 
{
    return ($default) ? Picsum::DEFAULT_ID : array_rand(Picsum::IDS);
}