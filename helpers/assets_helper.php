<?php

// Chargement des paramètres de configuration des assets
require('config/assets.php');

/**
 * Fonction permettant d'insérer une balise `link` ou `script` selon son type
 *
 * @param  string $key
 * @param  string $type
 * @return string
 */
function asset_link(string $key, string $type): string
{
    $tag = '';
    switch ($type)
    {
        case 'css':
            if (array_key_exists($key, Assets::$styles))
            {
                $link = Assets::$styles[$key];
            } 
            else 
            {
                $link['href'] = base_url() . Assets::$folders[$type] . $key;
            }

            $tag = link_tag($link) . PHP_EOL;
        break;

        case 'js':
        case 'libs':
            if (array_key_exists($key, Assets::$scripts))
            {
                $link = Assets::$scripts[$key];
            } 
            else 
            {
                $link['src'] = base_url() . Assets::$folders[$type] . $key;
            }

            $tag = script_tag($link) . PHP_EOL;
        break;
    }

    return $tag;
}

/**
 * Fonction permettant d'insérer une balise `link`
 *
 * @param  string $link
 * @return string
 */
function link_tag(array $link): string
{
    return '<link href="'. esc($link['href']) .'" rel="stylesheet">';
}

/**
 * Fonction permettant d'insérer une balise `script`
 *
 * @param  string $link
 * @return string
 */
function script_tag(array $link): string
{
    return '<script src="' . esc($link['src']). '"></script>';
}