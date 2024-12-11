<?php

/**
 * 
 * Paramètres de configuration des assets
 * Classe Assets
 */
class Assets
{
    /**
     * Tableau contenant les chemins vers les dossiers `assets`
     *
     * @var array
     */
    public static array $folders = array(
        'css'  => 'assets/css/',
        'js'   => 'assets/js/',
        'libs' => 'assets/libs/'
    );

    /**
     * Tableau contenant les URL des CDN des scripts JS
     *
     * @var array
     */
    public static array $scripts = array(

        'odometer' => array(
            'src' => 'https://cdn.jsdelivr.net/npm/odometer@0.4.8/odometer.min.js'
        ),

        'tinymce' => array(
            'src' => 'https://cdn.jsdelivr.net/npm/tinymce/tinymce.min.js'
        ),

    );

    /**
     * Tableau contenant les URL des CDN des styles CSS
     *
     * @var array
     */
    public static array $styles = array(

        'odometer' => array(
            'href' => 'https://cdn.jsdelivr.net/npm/odometer@0.4.8/themes/odometer-theme-default.min.css'
        ),
        
        'tinymce' => array(
            'href' => 'https://cdn.jsdelivr.net/npm/tinymce/skins/ui/oxide/content.min.css'
        ),
    
    );
}