<?php

// Chargement de la classe mère de connexion à la BDD
require_once('models/model.php');

/**
 * 
 * Modèle des produits
 * Classe ProductModel
 */
class ProductModel extends Model
{
    /**
     * Récupérer les informations d'un seul produit
     *
     * @param  integer $intProdId
     * @return array|boolean
     */
    public function find(int $intProdId): array|bool
    {
        // Requête SQL
        $strQuery = 'SELECT prod_id, 
                            prod_name,
                            prod_weight,
                            prod_photo,
                            prod_price,
                            prod_desc,
                            prod_updated_at,
                            prod_cat_id,
                            prod_bak_id
                     FROM product
                     WHERE prod_id = :id';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':id', $intProdId, PDO::PARAM_INT)
        );

        return $this->queryOne($strQuery, $arrParams);
    }

    /**
     * Récupérer les informations de tous les produits
     *
     * @return array|boolean
     */
    public function findAll(): array|bool
    {
        // Requête SQL
        $strQuery = 'SELECT prod_id, 
                            prod_name,
                            prod_weight,
                            prod_photo,
                            prod_price,
                            prod_desc,
                            prod_updated_at,
                            cat_id,
                            cat_name,
                            prod_bak_id,
                            bak_name
                     FROM product
                     INNER JOIN category 
                        ON prod_cat_id = cat_id
                     INNER JOIN bakery 
                        ON prod_bak_id = bak_id
                     ORDER BY cat_id, prod_name';

        return $this->queryAll($strQuery);
    }

    /**
     * Récupérer les informations de tous les produits en fonction de l'Id de la boulangerie
     *
     * @param  integer $intBakId
     * @return array|boolean
     */
    public function findByBakId(int $intBakId): array|bool
    {
        // Requête SQL
        $strQuery = 'SELECT prod_id, 
                            prod_name,
                            prod_weight,
                            prod_photo,
                            prod_price,
                            prod_desc,
                            prod_updated_at,
                            cat_id,
                            cat_name
                     FROM product
                     INNER JOIN category 
                        ON prod_cat_id = cat_id
                     WHERE prod_bak_id = :bakid
                     ORDER BY cat_id, prod_name';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':bakid', $intBakId, PDO::PARAM_INT)
        );

        return $this->queryAll($strQuery, $arrParams);
    }

    /**
     * Insérer un nouveau produit
     *
     * @param  object $objProduct
     * @return boolean
     */
    public function insert(object $objProduct): bool
    {
        // Requête SQL
        $strQuery = 'INSERT product (prod_name, prod_weight, prod_photo, prod_price, prod_desc, prod_updated_at, 
                                     prod_cat_id, prod_bak_id)
                     VALUES (:name, :weight, :photo, :price, :desc, NOW(), :catid, :bakid)';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':name',   $objProduct->getName(),   PDO::PARAM_STR),
            array(':weight', $objProduct->getWeight(), PDO::PARAM_INT),
            array(':photo',  $objProduct->getPhoto(),  PDO::PARAM_STR),
            array(':price',  $objProduct->getPrice(),  PDO::PARAM_STR),
            array(':desc',   $objProduct->getDesc(),   PDO::PARAM_STR),
            array(':catid',  $objProduct->getCatId(),  PDO::PARAM_INT),
            array(':bakid',  $objProduct->getBakId(),  PDO::PARAM_INT)
        );

        return $this->query($strQuery, $arrParams);
    }

    /**
     * Mettre à jour un produit
     *
     * @param  object $objProduct
     * @return boolean
     */
    public function update(object $objProduct): bool
    {
        // Requête SQL
        $strQuery = 'UPDATE product SET prod_name = :name, prod_weight = :weight, ';   
        if ($objProduct->getPhoto() != '') $strQuery .= 'prod_photo = :photo, ';
        $strQuery .= 'prod_price = :price, prod_desc = :desc, prod_updated_at = NOW(), prod_cat_id = :catid WHERE prod_id = :id';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':name',   $objProduct->getName(),   PDO::PARAM_STR),
            array(':weight', $objProduct->getWeight(), PDO::PARAM_INT),
            array(':price',  $objProduct->getPrice(),  PDO::PARAM_STR),
            array(':desc',   $objProduct->getDesc(),   PDO::PARAM_STR),
            array(':catid',  $objProduct->getCatId(),  PDO::PARAM_INT),
            array(':id',     $objProduct->getId(),     PDO::PARAM_INT)
        );
        if ($objProduct->getPhoto() != '')
        array_push($arrParams, array(
            ':photo', $objProduct->getPhoto(), PDO::PARAM_STR)
        );

        return $this->query($strQuery, $arrParams);
    }

    /**
     * Supprimer un produit
     *
     * @param  integer $intId
     * @return boolean
     */
    public function delete(int $intId): bool
    {
        // Requête SQL
        $strQuery = 'DELETE FROM product WHERE prod_id = :id';

        // On définit la valeur des paramètres et leur type
        $arrParams = array(
            array(':id', $intId, PDO::PARAM_INT)
        );

        return $this->query($strQuery, $arrParams);
    }
}