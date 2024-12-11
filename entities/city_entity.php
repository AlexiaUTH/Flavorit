<?php

// Chargement de l'entité mère
require_once('entities/entity.php');

/**
 * Entité de l'objet client 
 */
class City extends Entity
{
    /**
     * Attributs
     */
    private int    $_city_id;
    private string $_city_zip_code;
    private string $_city_name;

    /**
     * Mutateurs
     */
    public function setId(int $intId)
    {
        $this->_city_id = $intId;
    }

    public function setZipCode(string $strZipCode)
    {
        $this->_city_zip_code = esc($strZipCode);
    }

    public function setName(string $strName)
    {
        $this->_city_name = esc($strName);
    }

    /**
     * Accesseurs
     */
    public function getId(): int
    {
        return $this->_city_id;
    }

    public function getZipCode(): string
    {
        return $this->_city_zip_code;
    }

    public function getName(): string
    {
        return $this->_city_name;
    }
}
