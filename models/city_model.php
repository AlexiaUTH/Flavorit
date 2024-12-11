<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle de villes
 * Classe CityModel
 */
class CityModel extends Model
{
    /**
     * Retourner tous les enregistrements de la table `city`
     *
     * @return array|boolean
     */
    public function findAll(): array|bool
    {
        // Requête SQL
        $strQuery = 'SELECT city_id, city_zip_code, city_name FROM city ORDER BY city_name';

        return $this->queryAll($strQuery);
    }
}