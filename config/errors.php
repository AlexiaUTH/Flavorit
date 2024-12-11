<?php

/*
| ----------------------------------------------------
| Gestion des erreurs
| ----------------------------------------------------
*/
if (is_production()) 
{
    ini_set('display_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
} 
else 
{
    error_reporting(-1);
    ini_set('diplay_errors', 1);
}