<?php

// Chargement de l'entité mère
require_once('entities/entity.php');

/**
 * Entité de l'objet produit 
 */
class Product extends Entity
{
    /**
     * Attributs
     */
    protected int    $_prod_id;
    private   string $_prod_name;
    private   int    $_prod_weight;
    private   string $_prod_photo;
    private   float  $_prod_price;
    private   string $_prod_desc;
    private   string $_prod_updated_at;
    private   int    $_prod_cat_id;
    private   int    $_prod_bak_id;
    private   string $_cat_name;

    /**
     * Mutateurs
     */
    public function setId(int $intId)
    {
        $this->_prod_id = $intId;
    }

    public function setName(string $strName)
    {
        $this->_prod_name = trim($strName);
    }

    public function setWeight(string $strWeight)
    {
        $this->_prod_weight = (int)$strWeight;
    }

    public function setPhoto(string $strPhoto)
    {
        $this->_prod_photo = $strPhoto;
    }

    public function setPrice(string $strPrice)
    {
        $this->_prod_price = (float)$strPrice;
    }

    public function setDesc(string $strDesc)
    {
        $this->_prod_desc = strip_allowable_tags($strDesc);
    }

    public function setDate(string $strDate)
    {
        $this->_prod_updated_at = $strDate;
    }

    public function setCatId(int $intCatId)
    {
        $this->_prod_cat_id = (int)$intCatId;
    }

    public function setBakId(int $intBakId)
    {
        $this->_prod_bak_id = (int)$intBakId;
    }

    public function setCatName(string $strCatName)
    {
        $this->_cat_name = $strCatName;
    }

    /**
     * Accesseurs
     */
    public function getId(): int
    {
        return $this->_prod_id;
    }

    public function getName(): string
    {
        return $this->_prod_name;
    }

    public function getWeight(): int
    {
        return $this->_prod_weight;
    }

    public function getPhoto(): string
    {
        return $this->_prod_photo;
    }

    public function getPrice(): float
    {
        return $this->_prod_price;
    }

    public function getDesc(): string
    {
        return $this->_prod_desc;
    }

    public function getDate(): string
    {
        return $this->_prod_updated_at;
    }

    public function getFormattedDate(string $strFormat): string
    {
        return $this->format_date($this->_prod_updated_at, $strFormat);
    }

    public function getCatId(): int
    {
        return $this->_prod_cat_id;
    }

    public function getBakId(): int
    {
        return $this->_prod_bak_id;
    }

    public function getCatName(): string
    {
        return $this->_cat_name;
    }

}