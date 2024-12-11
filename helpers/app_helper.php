<?php

// Chargement des paramètres de configuration de l'application
require_once('config/app.php');

/*
| ----------------------------------------------------
| Fonctions transversales
| ----------------------------------------------------
*/

/**
 * Fonction permettant de retourner l'adresse email de l'application
 *
 * @return string
 */
function app_email(): string
{
    return App::APP_EMAIL;
}

/**
 * Fonction permettant de retourner le nom de l'application
 *
 * @return string
 */
function app_name(): string
{
    return App::APP_NAME;
}

/**
 * Fonction permettant de retourner l'URL de base
 *
 * @return string
 */
function base_url(): string
{
    return App::APP_URL;
}

/**
 * Fonction permettant de charger automatiquement une entité et de l'instancier
 *
 * @param  string $filename
 * @return object
 */
function entity(string $filename): object
{
    $fullpath = 'entities/' . $filename . '_entity.php';
        
    if (file_exists($fullpath))
    {
        require_once($fullpath);
        $entity_name = ucfirst($filename);

        return new $entity_name;
    }
}

/**
 * Fonction permettant de convertir les caractères spéciaux en entités HTML
 *
 * @param  string $str
 * @param  string $context
 * @return string
 */
function esc(string $str, $context = ''): string 
{
    switch ($context)
    {
        case 'html':
            $str = filter_var($str, FILTER_SANITIZE_SPECIAL_CHARS);
        break;
        
        case 'url':
            $str = filter_var($str, FILTER_SANITIZE_ENCODED);
        break;
        
        default:
            $str = htmlentities($str, ENT_QUOTES);
        break;
    }

    return $str;
}

/**
 * Fonction permettant de charger automatiquement un helper
 *
 * @param  array|string $filenames
 * @return void
 */
function helper(array|string $filenames): void
{
    if (! is_array($filenames)) 
    {
        $filenames = array($filenames);
    }

    foreach($filenames as $filename)
    {
        $fullpath = 'helpers/' . $filename . '_helper.php';
        
        if (file_exists($fullpath))
        {
            include_once($fullpath);
        }
    }
}

/**
 * Fonction permettant de déterminer si le nom du fichier fourni en paramètre correspond à une page front-end
 *
 * @param  string $page
 * @return boolean
 */
function is_frontpage(string $page): bool
{
    return in_array($page, App::APP_FRONTPAGES);
}

/**
 * Fonction permettant de déterminer si l'environnement de l'application est 'production'
 *
 * @return boolean
 */
function is_production(): bool
{
    return App::APP_ENVIRONMENT === 'production';
}

/**
 * Fonction permettant 
 *
 * @param  string $str
 * @param  array  $args
 * @return string
 */
function lang(string $str, array $args = array()): string
{
    return Alert::$messages[$str];
}

/**
 * Fonction permettant de charger automatiquement un modèle et de l'instancier
 *
 * @param  string $filename
 * @return object
 */
function model(string $filename): object
{
    $fullpath = 'models/' . $filename . '_model.php';
        
    if (file_exists($fullpath))
    {
        require_once($fullpath);
        $model_name = ucfirst($filename) . 'Model';

        return new $model_name;
    }
}

/**
 * Fonction permettant de rediriger vers une autre page
 *
 * @param  string  $str
 * @param  boolean $replace
 * @param  integer $response_code
 * @return void
 */
function redirect(string $str, bool $replace = true, int $response_code = 0): void 
{
    $location = sprintf('Location:%s.php', $str);
    
    header($location, $replace, $response_code);
    exit;
}

/**
 * Fonction permettant de retourner l'URL de base sans le "/" de fin
 *
 * @return string
 */
function site_url(): string
{
    return rtrim(base_url(), '/');
}

/**
 * Fonction permettant de supprimer conditionnellement les tags HTML d'une chaîne de caractères
 *
 * @param  string  $str
 * @return void
 */
function strip_allowable_tags(string $str)
{
    return trim(strip_tags($str, App::APP_ALLOWABLE_TAGS));
}