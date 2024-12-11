<?php

/**
 * 
 * Paramètres de configuration de l'application
 * Classe App
 */
class App
{        
    /**
     * Balises HTML autorisées
     */
    public const APP_ALLOWABLE_TAGS = '<h1><h2><h3><h4><h5><br><span><ol><ul><li><a><strong><em><u>';

    /**
     * Courriel de l'application
     */
    public const APP_EMAIL = 'contact@flavorit.fr';

    /**
     * Environnement de l'application
     */
    public const APP_ENVIRONMENT = 'production';
    
    /**
     * Pages front-end de l'application
     */
    public const APP_FRONTPAGES = array(
        'index',
        'about',
        'bakery',
        'legal',
        'privacy',
        'product',
        'showcase',
    );

    /**
     * Types de fichiers autorisés
     */
    public const APP_MIME_TYPES = array(
        'image' => array(
            'image/jpg', 
            'image/jpeg', 
            'image/png'
        )
    );

    /**
     * Nom de l'application
     */
    public const APP_NAME = 'Flavor’it';

    /**
     * URL de base de d'application
     */
    public const APP_URL = 'https://flavorit.fr/';

    /**
     * Version de l'application
     */
    public const APP_VERSION = '1.0.0';
}