<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle de boulangeries
 * Classe BakeryModel
 */
class BakeryModel extends Model
{
    /**
     * Fonction permettant de retourner le nombre d'enregistrements de la table `bakery`
     *
     * @return integer
     */
    public function numRows(): int
    {
        // On retourne le nombre de lignes
        return $this->queryCount('bakery');
    }

    /**
     * Récupérer les informations d'une boulangerie par son Id
     *
     * @return array|boolean
     */
    public function find(int $intId): array|bool 
    {
        // Requête SQL
        $strQuery = 'SELECT bak_id, 
                            bak_type, 
                            bak_name, 
                            bak_address, 
                            city_zip_code, 
                            city_name,
                            bak_phone,
                            bak_email,
                            bak_opening_hours,
                            bak_about,
                            bak_maps,
                            bak_img
                     FROM bakery
                     INNER JOIN city 
                        ON bak_city_id = city_id
                     WHERE bak_id = :id';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':id', $intId, PDO::PARAM_INT)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Récupérer les informations de toutes les boulangeries
     *
     * @return array|boolean
     */
    public function findAll(int $intLimit = 0, bool $boolLike = false): array|bool 
    {
        // Requête SQL
        $strQuery = 'SELECT bak_id, 
                            bak_type, 
                            bak_name, 
                            bak_address, 
                            city_zip_code, 
                            city_name,
                            bak_phone,
                            bak_email,
                            bak_opening_hours,
                            bak_about,
                            bak_maps,
                            bak_img,
                            cb_like
                     FROM bakery
                     INNER JOIN city 
                        ON bak_city_id = city_id
                     LEFT OUTER JOIN customer_bakery
                        ON cb_bak_id = bak_id';

        if ($boolLike) $strQuery .= ' WHERE cb_like = 1';
        $strQuery .= ' ORDER BY bak_id DESC';   
        if ($intLimit > 0) $strQuery .= ' LIMIT ' . $intLimit . ';';

        return $this->queryAll($strQuery);
    }
}