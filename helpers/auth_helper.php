<?php

/*
| ----------------------------------------------------
| Fonctions d'authentification
| ----------------------------------------------------
*/

/**
 * Fonction permettant de déterminer si l'utilisateur est un administrateur
 *
 * @return boolean
 */
function is_admin(): bool
{
    return (isset($_SESSION['role']) && $_SESSION['role'] == 'admin');
}

/**
 * Fonction permettant de déterminer si l'utilisateur est un super administrateur
 *
 * @return boolean
 */
function is_superadmin(): bool
{
    return (isset($_SESSION['role']) && $_SESSION['role'] == 'superadmin');
}

/**
 * Fonction permettant de déterminer si l'utilisateur est un client
 *
 * @return boolean
 */
function is_user(): bool
{
    return !is_admin() && !is_superadmin();
}

/**
 * Fonction permettant de déterminer si l'utilisateur est connecté
 *
 * @return boolean
 */
function logged_in(): bool
{
    return (isset($_SESSION['userid']) && $_SESSION['userid'] > 0);
}