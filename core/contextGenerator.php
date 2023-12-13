<?php

class ContextGenerator
{
    private $dbManager;

    public function __construct(DatabaseManager $dbManager)
    {
        $this->dbManager = $dbManager;
    }

    public function createContext($objet)
    {
        // Vérifiez l'existence du répertoire "context" et créez-le s'il n'existe pas
        $contextDirectory = './app/context/';
        if (!file_exists($contextDirectory)) {
            mkdir($contextDirectory, 0777, true);
        }

        $className = get_class($objet);
        // Générez le nom de fichier et de classe
        $contextFileName = $className . 'Context.php';
        $contextClassName = $className . 'Context';

        // Générez le code pour la classe de contexte
        $contextCode = "<?php\n\n";
        $contextCode .= "require_once './core/DatabaseManager.php';\n\n";
        $contextCode .= "class $contextClassName extends DatabaseManager\n";
        $contextCode .= "{\n";
        $contextCode .= "    public function __construct()\n";
        $contextCode .= "    {\n";
        $contextCode .= "        parent::__construct('host', 'username', 'password', 'dbname');\n";
        $contextCode .= "    }\n\n";

        // Générez les méthodes CRUD
        $contextCode .= "    // Méthodes CRUD ici...\n\n";

        // Fin de la classe
        $contextCode .= "}\n";

        // Écrivez le code dans le fichier
        $contextFilePath = $contextDirectory . $contextFileName;
        file_put_contents($contextFilePath, $contextCode);

        // Créez la table dans la base de données
        return true;
    }
}
