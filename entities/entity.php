<?php

/**
 * 
 * Entité mère
 * Classe Entity
 */
class Entity 
{
    
    /**
     * Fonction permettant de formater des dates
     *
     * @param  string $strDate
     * @param  string $strFormat
     * @return void
     */
    protected function format_date(string $strDate, string $strFormat = 'd/m/Y H:i')
    {
        $objDate = new DateTimeImmutable($strDate);
        
        return $objDate->format($strFormat);
    }

    /**
     * Fonction permettant de formater des numéros de téléphone
     *
     * @param  string $strPhone
     * @return string
     */
    protected function format_phone(string $strPhone): string
    {
        return preg_replace('/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/', '$1 $2 $3 $4 $5', $strPhone);
    }
}