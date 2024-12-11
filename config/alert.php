<?php

/**
 * 
 * Paramètres de configuration des messages d'alerte
 * Classe Alert
 */
Class Alert
{
    /**
     * Chemin vers le modèle d'alerte Bootstrap
     *
     * @var string
     */
    public static string $template = '_partials/alert.php';
    
    /**
     * Tableau des classes Bootstrap et autres classes CSS
     *
     * @var array
     */
    public static array $alerts = array(
        
        // Classes Bootstrap
        'primary'   => 'primary',
        'secondary' => 'secondary',
        'danger'    => 'danger',
        'info'      => 'info',
        'success'   => 'success',
        'warning'   => 'warning',

        // Autres classes CSS
        'error'     => 'danger',
    );

    /**
     * Tableau des messages d'alerte
     */
    public static array $messages = array(

        // Administrateurs
        'admin_created'           => 'Administrateur créé avec succès',
        'admin_deleted'           => 'Administrateur supprimé avec succès',
        'admin_inactive'          => 'Ce compte est inactif',
        'admin_updated'           => 'Administrateur modifié avec succès',

        // Authentification
        'login'                   => 'Vous vous êtes connecté avec succès',
        'logout'                  => 'Vous avez été déconnecté avec succès',

        // Boulangeries
        'bakery_about_required'   => 'L\'à propos de la boulangerie est obligatoire',
        'bakery_address_required' => 'L\'adresse postale de la boulangerie est obligatoire',
        'bakery_created'          => 'Boulangerie créée avec succès',
        'bakery_deleted'          => 'Boulangerie supprimée avec succès',
        'bakery_maps_required'    => 'Le code d\'intégration Google Maps est obligatoire',
        'bakery_name_required'    => 'Le nom de la boulangerie est obligatoire',
        'bakery_opening_required' => 'Les horaires d\'ouverture sont obligatoires',
        'bakery_phone_required'   => 'Le numéro de téléphone de la boulangerie est obligatoire',
        'bakery_updated'          => 'Boulangerie modifiée avec succès',

        // Catégories
        'category_created'        => 'Catégorie créée avec succès',
        'category_name_required'  => 'Le libellé de la catégorie est requis',
        'category_none'           => 'Aucune catégorie à afficher',

        // Champs de formulaire
        'credentials_invalid'     => 'L\'adresse email ou le mot de passe est erroné',
        'confirm_required'        => 'La confirmation du mot de passe est obligatoire',
        'email_invalid'           => 'L\'adresse email n\'est pas valide',
        'email_required'          => 'L\'adresse email est obligatoire',
        'firstname_required'      => 'Le prénom est obligatoire',
        'lastname_required'       => 'Le nom est obligatoire',
        'password_required'       => 'Le mot de passe est obligatoire',

        // Clients
        'customer_created'        => 'Client créé avec succès',
        'customer_deleted'        => 'Client supprimé avec succès',
        'customer_updated'        => 'Client modifié avec succès',

        // Codes HTTP
        'error_403'               => 'Vous n\'êtes pas autorisé à accéder à cette ressource',
        'error_500'               => 'Nous sommes désolés, mais une erreur interne est survenue',

        // Erreurs génériques
        'retry_later'             => 'Une erreur est survenue, veuillez réessayer ultérieurement',

        // Favoris
        'bakery_like'             => 'Boulangerie ajoutée en favori avec succès',
        'bakery_unlike'           => 'Boulangerie retirée des favoris avec succès',

        // Fichiers
        'file_move_error'         => 'Le fichier n\'a pas pu être déplacé',
        'file_type_error'         => 'Le type de fichier n\'est pas autorisé',

        // Produits
        'product_created'         => 'Produit créé avec succès',
        'product_deleted'         => 'Produit supprimé avec succès',
        'product_none'            => 'Aucun produit à afficher',
        'product_updated'         => 'Produit modifié avec succès',
        'product_name_required'   => 'Le libellé du produit est obligatoire',
        'product_weight_required' => 'Le poids du produit est obligatoire',
        'product_photo_required'  => 'La photo du produit est obligatoire',
        'product_price_required'  => 'Le prix du produit est obligatoire',
        'product_desc_required'   => 'La description du produit est obligatoire',
        'product_cat_id_required' => 'La catégorie du produit est obligatoire',
        
        // Utilisateurs
        'user_created'            => 'Utilisateur créé avec succès',
        'user_mail_duplicate'     => 'Cette adresse email existe déjà dans notre système',
        'user_none'               => 'Aucun utilisateur à afficher',
        'user_toggled'            => 'Utilisateur activté/desactivé avec succès',
        'user_updated'            => 'Utilisateur modifié avec succès',

        // Villes
        'city_created'            => 'Ville créée avec succès',
        'city_deleted'            => 'Ville supprimée avec succès',
        'city_name_required'      => 'Le nom de la ville est obligatoire',
        'city_updated'            => 'Ville modifiée avec succès',
    );
}