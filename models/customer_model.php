<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle des clients
 * Classe CustomerModel
 */
class CustomerModel extends Model
{
    /**
     * Récupérer les informations d'un client
     *
     * @param  object $objCustomer
     * @return array|boolean
     */
    public function find(object $objCustomer): array|bool
    {
        // Requête SQL
        $strQuery  = 'SELECT user_firstname, user_lastname FROM customer WHERE user_id = :id';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':id', $objCustomer->getId(), PDO::PARAM_INT)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Insérer un nouveau client
     *
     * @param  object $objCustomer
     * @return boolean
     */
    public function insert(object $objCustomer): bool
    {
        // Requête SQL
        $strQuery = 'INSERT INTO customer (user_id, user_firstname, user_lastname) VALUES (:id, :firstname, :lastname)';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':id',        $objCustomer->getId(),        PDO::PARAM_INT),
            array(':firstname', $objCustomer->getFirstname(), PDO::PARAM_STR),
            array(':lastname',  $objCustomer->getLastname(),  PDO::PARAM_STR)
        );

        return $this->query($strQuery, $arrParams);
    }

    /**
     * Mettre à jour un client existant
     *
     * @param  object $objCustomer
     * @return boolean
     */
    public function update(object $objCustomer): bool
    {
        // Requête SQL
        $strQuery = 'UPDATE customer 
                     SET user_firstname = :firstname, user_lastname = :lastname
                     WHERE user_id = :id';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':firstname', $objCustomer->getFirstname(), PDO::PARAM_STR),
            array(':lastname',  $objCustomer->getLastname(),  PDO::PARAM_STR),
            array(':id',        $objCustomer->getId(),        PDO::PARAM_INT)
        );

        return $this->query($strQuery, $arrParams);
    }
}