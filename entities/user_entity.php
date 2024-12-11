<?php

// Chargement de l'entité mère
require_once('entities/entity.php');

/**
 * Entité de l'objet utilisateur 
 */
class User extends Entity
{
    /**
     * Attributs
     */
    protected int    $_user_id;
    private   string $_user_mail;
    private   string $_user_pwd;
    private   string $_user_role;
    private   bool   $_user_active;
    private   string $_user_created_at;

    /**
     * Mutateurs
     */
    public function setId(int $intId)
    {
        $this->_user_id = $intId;
    }

    public function setEmail(string $strEmail)
    {
        $this->_user_mail = strtolower(trim($strEmail));
    }

    public function setPassword(string $strPassword)
    {
        $this->_user_pwd = $strPassword;
    }

    public function setRole(string $strRole)
    {
        $this->_user_role = $strRole;
    }

    public function setActive(bool $boolActive)
    {
        $this->_user_active = $boolActive;
    }

    public function setCreatedAt(string $strDate)
    {
        $this->_user_created_at = $strDate;
    }

    /**
     * Accesseurs
     */
    public function getId(): int
    {
        return $this->_user_id;
    }
    
    public function getEmail(): string
    {
        return $this->_user_mail;
    }

    public function getPassword(): string
    {
        return $this->_user_pwd;
    }

    public function getPasswordHash(string $strAlgo = PASSWORD_DEFAULT): string
    {
        return password_hash($this->_user_pwd, $strAlgo);
    }

    public function getRole(): string
    {
        return $this->_user_role;
    }

    public function getActive(): bool
    {
        return $this->_user_active;
    }

    public function getFormattedCreatedAt(): string
    {
        return $this->format_date($this->_user_created_at);
    }
}
