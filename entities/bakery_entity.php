<?php

// Chargement de l'entité mère
require_once('entities/entity.php');

/**
 * Entité de l'objet boulangerie
 */
class Bakery extends Entity
{
    /**
     * Attributs
     */
    private int    $_bak_id;
    private string $_bak_type;
    private string $_bak_name;
    private string $_bak_siret;
    private string $_bak_address;
    private string $_bak_phone;
    private string $_bak_email;
    private string $_bak_opening_hours;
    private string $_bak_about;
    private string $_bak_maps;
    private string $_bak_img;
    private string $_bak_created_at;
    private string $_bak_updated_at;

    /**
     * Mutateurs
     */
    public function setId(int $intId)
    {
        $this->_bak_id = $intId;
    }

    public function setType(string $strType)
    {
        $this->_bak_type = esc($strType);
    }

    public function setName(string $strName)
    {
        $this->_bak_name = esc($strName);
    }

    public function setAddress(string $strAddress)
    {
        $this->_bak_address = esc($strAddress);
    }

    public function setPhone(string $strPhone)
    {
        $this->_bak_phone = esc($strPhone);
    }

    public function setEmail(string $strMail)
    {
        $this->_bak_email = esc($strMail);
    }

    public function setOpeningHours(string $strOpeningHours)
    {
        $this->_bak_opening_hours = strip_allowable_tags($strOpeningHours);
    }

    public function setAbout(?string $strAbout)
    {
        $this->_bak_about = $strAbout ?? '';
    }

    public function setMaps(?string $strMaps)
    {
        $this->_bak_maps = $strMaps ?? '';
    }

    public function setImg(?string $strImg)
    {
        $this->_bak_img = $strImg ?? '';
    }

    /**
     * Accesseurs
     */
    public function getId(): int
    {
        return $this->_bak_id;
    }

    public function getName(): string
    {
        return $this->_bak_name;
    }

    public function getType(): string
    {
        return $this->_bak_type;
    }

    public function getAddress(): string
    {
        return $this->_bak_address;
    }

    public function getPhone(string $strPrefix = ''): string
    {
        return $strPrefix . $this->format_phone($this->_bak_phone);
    }

    public function getEmail(): string
    {
        return $this->_bak_email;
    }

    public function getOpeningHours(): string
    {
        return $this->_bak_opening_hours;
    }

    public function getAbout(): string
    {
        return $this->_bak_about;
    }

    public function getMaps(): string
    {
        return $this->_bak_maps;
    }

    public function getImg(): string
    {
        return Paths::UPLOAD_PATH . $this->_bak_img;
    }
}