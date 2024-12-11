<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle des catégories
 * Classe CategoryModel
 */
class CategoryModel extends Model
{
    /**
     * Récupérer les informations de catégories d'une seule boulangerie
     *
     * @return array|boolean
     */
    public function findByBakId($intBakId): array|bool
    {
        // Requête SQL
        $strQuery  = 'SELECT cat_id, cat_name FROM category WHERE cat_bak_id = :bakid';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':bakid', $intBakId, PDO::PARAM_INT)
        );
        return $this->queryOne($strQuery);
    }

    /**
     * Récupérer les informations de toutes les catégories
     *
     * @return array|boolean
     */
    public function findAll(): array|bool
    {
        // Requête SQL
        $strQuery  = 'SELECT cat_id, cat_name FROM category';

        return $this->queryAll($strQuery);
    }

    /**
     * Insérer une nouvelle catégorie
     *
     * @param  object $objCategory
     * @return boolean
     */
    public function insert(object $objCategory): bool
    {
        // Requête SQL
        $strQuery  = 'INSERT INTO category (cat_name) VALUES (:name)';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':name', $objCategory->getName(), PDO::PARAM_STR)
        );

        return $this->query($strQuery, $arrParams);
    }
}