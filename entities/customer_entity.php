<?php

// Chargement de l'entité parente
require_once('entities/user_entity.php');

/**
 * Entité de l'objet client 
 */
class Customer extends User
{
    /**
     * Attributs
     */
    private string $_user_firstname;
    private string $_user_lastname;

    /**
     * Mutateurs
     */
    public function setFirstname(string $strFirstname)
    {
        $this->_user_firstname = trim($strFirstname);
    }

    public function setLastname(string $strLastname, bool $boolUpper = false)
    {
        if ($boolUpper === true) 
        {
            $strLastname = strtoupper($strLastname);
        }
        
        $this->_user_lastname = trim($strLastname);
    }

    /**
     * Accesseurs
     */
    public function getFirstname(): string
    {
        return $this->_user_firstname;
    }

    public function getLastname(): string
    {
        return $this->_user_lastname;
    }
}
