<?php
require_once("./core/contextGenerator.php");


class DatabaseManager
{
    private $db; // L'objet PDO pour la connexion à la base de données
    private $host;
    private $username;
    private $password;
    private $dbname;

    private ContextGenerator $contextGenerator;

    public function __construct($host, $username, $password, $dbname)
    {

        try {
            $this->contextGenerator = new ContextGenerator($this);
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;

            // Connexion à la base de données
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Création de la base de données si elle n'existe pas
            $this->createDatabase($dbname);

            // Sélection de la base de données
            $this->db->exec("USE $dbname");
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Crée une base de données si elle n'existe pas déjà
    private function createDatabase($dbname)
    {
        $query = "CREATE DATABASE IF NOT EXISTS $dbname";
        $this->db->exec($query);
    }

    // Crée une table à partir d'un modèle de classe
    public function createTableFromClass($objet)
    {
        if (!$this->contextGenerator->createContext($objet)) {
            return;
        }

        $className = get_class($objet);
        $table = strtolower($className); // Nom de la table basé sur le nom de la classe
        $fields = [];

        // Récupère les propriétés de classe comme des colonnes de table
        $refClass = new ReflectionClass($className);
        $properties = $refClass->getProperties();

        foreach ($properties as $property) {
            $name = $property->getName();
            $type = $this->getPropertyType($property);
            $fields[] = "$name $type";
        }

        $fields = implode(", ", $fields);

        $query = "CREATE TABLE IF NOT EXISTS $table ($fields)";
        $this->db->exec($query);
    }

    // Obtient le type de données SQL correspondant au type de propriété de classe
    private function getPropertyType($property)
    {
        $type = 'VARCHAR(255)'; // Par défaut, utilisez VARCHAR

        if ($property->hasType()) {
            $typeHint = (string)$property->getType();
            switch ($typeHint) {
                case 'int':
                    $type = 'INT';
                    break;
                case 'string':
                    $type = 'VARCHAR(255)';
                    break;
                    // Ajoutez d'autres cas pour d'autres types de données si nécessaire
            }
        }

        return $type;
    }

    // Exécute une requête SQL
    public function executeQuery($sql)
    {
        return $this->db->exec($sql);
    }

    // Exécute une requête SQL et retourne les résultats en tant qu'objet PDOStatement
    public function executeQueryWithResults($sql)
    {
        return $this->db->query($sql);
    }

    // Prépare et exécute une requête SQL paramétrée avec des valeurs liées
    public function executePreparedStatement($sql, $values)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }


    // Getter pour $host
    public function getHost()
    {
        return $this->host;
    }

    // Setter pour $host
    public function setHost($host)
    {
        $this->host = $host;
    }

    // Getter pour $username
    public function getUsername()
    {
        return $this->username;
    }

    // Setter pour $username
    public function setUsername($username)
    {
        $this->username = $username;
    }

    // Getter pour $password
    public function getPassword()
    {
        return $this->password;
    }

    // Setter pour $password
    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Getter pour $dbname
    public function getDBName()
    {
        return $this->dbname;
    }

    // Setter pour $dbname
    public function setDBName($dbname)
    {
        $this->dbname = $dbname;
    }
}
