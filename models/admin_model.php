<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle des administrateurs
 * Classe AdminModel
 */
class AdminModel extends Model
{
    /**
     * Récupérer les informations d'un administrateur
     *
     * @param  object $objUser
     * @return array|boolean
     */
    public function find(object $objUser): array|bool
    {
        // Requête SQL
        $strQuery  = 'SELECT user_active, user_bak_id FROM admin WHERE user_id = :id';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':id', $objUser->getId(), PDO::PARAM_INT)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Récupérer les informations de tous les adminstrateurs
     *
     * @return array|boolean
     */
    public function findAll(): array|bool
    {
        $strQuery = 'SELECT t1.user_id, user_mail, user_active, user_role, user_created_at
                     FROM admin AS t1
                     INNER JOIN user AS t2
                        ON t1.user_id = t2.user_id';

        return $this->queryAll($strQuery);
    }

    /**
     * Activer/desactiver un utilisateur
     *
     * @param  integer $intUserId
     * @return boolean
     */
    public function toggle(int $intUserId): bool
    {
        // Requête SQL
        $strQuery  = 'UPDATE admin SET user_active = NOT user_active WHERE user_id = :userid';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':userid', $intUserId, PDO::PARAM_INT)
        );

        return $this->query($strQuery, $arrParams);
    }
}