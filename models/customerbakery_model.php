<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle de boulangeries
 * Classe CustomerbakeryModel
 */
class CustomerbakeryModel extends Model
{
    /**
     * Récupérer les informations d'une boulangerie mise en favori
     *
     * @return array|boolean
     */
    public function find(): array|bool 
    {
        // Requête SQL
        $strQuery = 'SELECT cb_id,
                            cb_like,
                            cb_date,
                            cb_user_id,
                            cb_bak_id
                     FROM customer_bakery
                     WHERE cb_like = 1 AND cb_user_id = :userid
                        ORDER BY cb_date DESC
                     LIMIT 1';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':userid', $_SESSION['userid'], PDO::PARAM_INT)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Récupérer les informations de statut `like` de la dernière boulangeries de son Id
     *
     * @param  integer $intBakId
     * @return array|boolean
     */
    public function findByBakId(int $intBakId): array|bool 
    {
        // Requête SQL
        $strQuery = 'SELECT cb_id,
                            cb_like,
                            cb_date,
                            cb_user_id,
                            cb_bak_id
                     FROM customer_bakery
                     WHERE cb_user_id = :userid 
                        AND cb_bak_id  = :bakid
                     ORDER BY cb_date DESC
                     LIMIT 1';
        
        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':userid', $_SESSION['userid'], PDO::PARAM_INT),
            array(':bakid',  $intBakId,           PDO::PARAM_INT)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Insertion d'une nouvelle boulangerie favorite
     *
     * @param  integer $intBakId
     * @return boolean
     */
    public function insert(int $intBakId): bool
    {
        // Requête SQL
        $strQuery = 'INSERT INTO customer_bakery (cb_like, cb_date, cb_user_id, cb_bak_id) 
                     VALUES (1, NOW(), :userid, :bakid)';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':userid', $_SESSION['userid'], PDO::PARAM_INT),
            array(':bakid',  $intBakId,           PDO::PARAM_INT)
        );

        //
        return $this->query($strQuery, $arrParams);
    }

    /**
     * Mise à jour d'une boulangerie favorite
     *
     * @param  integer $intBakId
     * @return boolean
     */
    public function update(int $intBakId): bool
    {
        // Requête SQL
        $strQuery = 'UPDATE customer_bakery 
                     SET cb_like = NOT cb_like, cb_date = NOW()
                     WHERE cb_user_id = :userid AND cb_bak_id = :bakid';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':userid', $_SESSION['userid'], PDO::PARAM_INT),
            array(':bakid',  $intBakId,           PDO::PARAM_INT)
        );

        return $this->query($strQuery, $arrParams);
    }
}