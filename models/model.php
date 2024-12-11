<?php

// Chargement des paramètres de configuration de la BDD
require('config/database.php');

/**
 * 
 * Connexion à BDD et fonctions permettant d'exécuter des requêtes
 * Classe Model
 */
class Model
{
    /**
     * Objet PDO
     *
     * @var object
     */
    protected object $pdo;
    
    /**
     * Paramètres optionnels de connexion à la BDD
     *
     * @var array
     */
    private array $options = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    /**
     * Constructeur
     */
    public function __construct() 
    {
        // On tente de se connecter à la BDD
        try {

            $this->pdo = new PDO('mysql:host='. Database::DB_HOST . ';dbname=' . Database::DB_NAME, 
                Database::DB_USER, 
                Database::DB_PASSWORD,
                $this->options
            );

        // Sinon on capture le message d'erreur correspondant
        } catch (PDOException $e) {

            // On affecte le message d'erreur à une variable
            $strMessage = $e->getMessage();

            // Inclusion de la page d'erreur
            require('_partials/error_exception.php');
            exit;
        }
    }

    /**
     * Fonction permettant d'exécuter une requête
     *
     * @param  string $strQuery
     * @return integer|boolean
     */
    protected function query(string $strQuery, array $arrParams = array(), bool $boolInsertId = false): int|bool 
    {
        // On prépare la requête
        $strPrepQuery = $this->pdo->prepare($strQuery);
        
        // Si le tableau des paramètres n'est pas vide
        if (count($arrParams) > 0) 
        {
            // Pour chaque élément du tableau des paramètres
            foreach ($arrParams as $arrParam)
            {
                // On définit sa valeur et son type
                $strPrepQuery->bindValue(...$arrParam);
            }
        }
        
        // On exécute la requête
        $boolResult = $strPrepQuery->execute();
        
        // Si $boolInsertId est vrai
        if ($boolInsertId === true)
        {
            // On retourne la valeur du dernier Id inséré
            return $this->pdo->lastInsertId();
        }

        // Sinon on retourne le résultat
        return $boolResult;
    }

    /**
     * Fonction permettant d'exécuter une requête et de retourner tous les résultats dans un tableau
     *
     * @param  string $strQuery
     * @return array|boolean
     */
    protected function queryAll(string $strQuery, array $arrParams = array()): array|bool 
    {
        // On prépare la requête
        $strPrepQuery = $this->pdo->prepare($strQuery);
        
        // Si le tableau des paramètres n'est pas vide
        if (count($arrParams) > 0) 
        {
            // Pour chaque élément du tableau des paramètres
            foreach ($arrParams as $arrParam)
            {
                // On définit sa valeur et son type
                $strPrepQuery->bindValue(...$arrParam);
            }
        }
        
        // On exécute la requête
        $strPrepQuery->execute();

        // On retourne les résultats dans un tableau
        return $strPrepQuery->fetchAll();
    }

    /**
     * Fonction permettant d'exécuter une requête et de retourner le résultat dans un tableau
     *
     * @param  string $strQuery
     * @return array|boolean
     */
    protected function queryOne(string $strQuery, array $arrParams = array()): array|bool 
    {
        // On prépare la requête
        $strPrepQuery = $this->pdo->prepare($strQuery);
        
        // Si le tableau des paramètres n'est pas vide
        if (count($arrParams) > 0) 
        {
            // Pour chaque élément du tableau des paramètres
            foreach ($arrParams as $arrParam)
            {
                // On définit sa valeur et son type
                $strPrepQuery->bindValue(...$arrParam);
            }
        }

        // On exécute la requête
        $strPrepQuery->execute();

        // On retourne le résultat dans un tableau
        return $strPrepQuery->fetch();
    }

    /**
     * Fonction permettant de retourner le nombre de lignes d'une table
     * 
     * @param  string $strTableName
     * @return integer
     */
    protected function queryCount(string $strTableName): int
    {
        // On prépare la requête
        $strPrepQuery = $this->pdo->prepare('SELECT COUNT(*) FROM ' . $strTableName);

        // On exécute la requête
        $strPrepQuery->execute();

        // On retourne le nombre de lignes
        return $strPrepQuery->fetchColumn();
    }
}