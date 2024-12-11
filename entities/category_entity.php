<?php

// Chargement de l'entité mère
require_once('entities/entity.php');

/**
 * Entité de l'objet prodcatégorieuit 
 */
class Category extends Entity
{
    /**
     * Attributs
     */
    protected int    $_cat_id;
    private   string $_cat_name;

    /**
     * Mutateurs
     */
    public function setId(int $intId)
    {
        $this->_cat_id = $intId;
    }

    public function setName(string $strName)
    {
        $this->_cat_name = trim($strName);
    }

    /**
     * Accesseurs
     */
    public function getId(): int
    {
        return $this->_cat_id;
    }

    public function getName(): string
    {
        return $this->_cat_name;
    }
}