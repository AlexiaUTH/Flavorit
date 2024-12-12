# Flavor’it

## LE LIEN POUR ACCEDER A LA PLATEFORME WEB : 
Il manque le dossier "asssets" (à ajouter dans le github) + voir comment lier php et github.io
## Qu'est-ce que Flavor’it ?

[Flavor’it](https://flavorit.fr) est une plateforme en ligne développée en PHP pour des boulangeries souhaitant s'orienter vers de la livraison à domicile.

## Installation

### Configuration

Le fichier de configuration principal de l'application se trouve dans le dossier [config/app.php](https://github.com/enderlinp-uha/flavorit/blob/main/config/app.php).

Avant la mise en production, modifiez l'affectation de la constante `APP_ENVIRONMENT` en `production` tel quel figuré ci-après, laisser `development` dans le cas contraire. 

```php
<?php

/**
 * 
 * Paramètres de configuration de l'application
 * Classe App
 */
class App
{
    ...

    /**
     * Environnement de l'application
     */
    public const APP_ENVIRONMENT = 'production';
```

Puis modifiez, l'URL de base de l'application en n'oubliant pas d'insérer un "/" de fin :

```php
<?php
    ...

    /**
     * URL de base de d'application
     */
    public const APP_URL = 'https://flavorit.fr/';
```

Enfin, dans le fichier [config/database.php](https://github.com/enderlinp-uha/flavorit/blob/main/config/database.php), modifiez les paramètres de connexion à votre base de données, tel que figuré ci-dessous :

```php
<?php

/**
 * 
 * Paramètres de configuration de la BDD de l'application
 * Classe Database
 */
class Database
{
    /**
     * Nom d'hôte de la base de données
     */
    public const DB_HOST = '';

    /**
     * Nom de la base de données
     */
    public const DB_NAME = 'flavorit';

    /**
     * Nom d'utilisateur de la base de données
     */
    public const DB_USER = '';
    
    /**
     * Mot de passe de la base de données
     */
    public const DB_PASSWORD = '';
```

### Téléversement des fichiers

Téléversez l'ensemble des dossiers et fichiers dans le dossier `www`, `htdocs` ou équivalent de votre serveur web.

### Importation de la base de données

Dans PhpMyAdmin ou tout autre visualiseur de base de données, importez le fichier [database/migrations/create_database.sql](https://github.com/enderlinp-uha/flavorit/blob/main/database/migrations/create_database.sql).

Veuillez noter que le script d'installation crée une base de données intitulée `flavorit`.
\
Si vous souhaitez la créer vous-même, commentez les lignes `CREATE DATABASE flavorit;` et `USE flavorit;` avant importation, comme ceci :

```sql
-- 
-- Création de la base de données
--
# CREATE DATABASE flavorit;

-- 
-- Utilisation de la base de données
--
# USE flavorit;
```

## Exigences du serveur

PHP version 8.1 ou supérieure est requise.
\
MySQL version 5.7 ou supérieure est requise.

## Licence

&copy; 2024 Flavor’it. Reproduction interdite sans autorisation de leurs auteurs.
