<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle des utilisateurs
 * Classe UserModel
 */
class UserModel extends Model
{
    /**
     * Récupérer les informations d'un utilisateur
     *
     * @param  object $objUser
     * @return array|boolean
     */
    public function find(int $intUserId): array|bool
    {
        // Requête SQL
        $strQuery  = 'SELECT user_id, user_mail, user_role FROM user WHERE user_id = :id';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':id', $intUserId, PDO::PARAM_INT)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Récupérer les informations de tous les utilisateurs
     *
     * @return array|boolean
     */
    public function findAll(): array|bool
    {
        // Requête SQL
        $strQuery  = 'SELECT user_id, user_mail, user_role, user_created_at FROM user';

        return $this->queryAll($strQuery);
    }

    /**
     * Récupérer les informations d'un utilisateur
     *
     * @param  object $objUser
     * @return array|boolean
     */
    public function findByMail(object $objUser, bool $boolPassword = false): array|bool
    {
        // Requête SQL
        $strQuery  = 'SELECT user_id, user_mail, ';
        if ($boolPassword) $strQuery .= 'user_pwd, ';
        $strQuery .= 'user_role FROM user WHERE user_mail = :mail';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':mail', $objUser->getEmail(), PDO::PARAM_STR)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Insérer un nouvel utilisateur
     *
     * @param  object $objUser
     * @param  boolean $boolInsertId
     * @return integer|boolean
     */
    public function insert(object $objUser, bool $boolInsertId = false): int|bool
    {
        // Requête SQL
        $strQuery  = 'INSERT INTO user (user_mail, user_pwd, user_created_at) VALUES (:mail, :pwd, NOW())';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':mail', $objUser->getEmail(),        PDO::PARAM_STR),
            array(':pwd',  $objUser->getPasswordHash(), PDO::PARAM_STR)
        );

        return $this->query($strQuery, $arrParams, $boolInsertId);
    }

    /**
     * Mettre à jour un utilisateur existant
     *
     * @param  object $objUser
     * @return integer|boolean
     */
    public function update(object $objUser): int|bool
    {
        // Requête SQL
        $strQuery = 'UPDATE user SET user_mail = :mail, ';
        if ($objUser->getPassword() != '') $strQuery .= 'user_pwd = :pwd, ';
        $strQuery .= 'user_updated_at = NOW() WHERE user_id = :id';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':mail', $objUser->getEmail(), PDO::PARAM_STR),
            array(':id',   $objUser->getId(),    PDO::PARAM_INT),
        );
        if ($objUser->getPassword() != '') {
            array_push($arrParams, array(
                ':pwd',  $objUser->getPasswordHash(), PDO::PARAM_STR
            ));
        }

        return $this->query($strQuery, $arrParams);
    }
}