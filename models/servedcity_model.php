<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle des villes desservies
 * Classe ServedcityModel
 */
class ServedcityModel extends Model
{
    /**
     * Récupérer le nombre de villes desservies distinctes
     *
     * @return array|boolean
     */
    public function numDistinctRows(): array|bool
    {
        // Requête SQL
        $strQuery = 'SELECT COUNT(DISTINCT sc_city_id) AS count FROM served_city';

        return $this->queryOne($strQuery);
    }
}