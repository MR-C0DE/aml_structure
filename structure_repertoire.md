Dossier: ./
Fichier: ./.htaccess
# Active la réécriture d'URL
RewriteEngine On

# Définissez la règle de réécriture pour rediriger toutes les requêtes vers index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [NC,L]


Fichier: ./c.py
import os
import chardet  # Bibliothèque pour la détection de l'encodage

# Répertoire où vous souhaitez exécuter le script
repertoire_courant = "./"

# Nom du fichier de sortie
nom_fichier_sortie = "structure_repertoire.md"

# Liste des sous-répertoires à ne pas prendre en compte
sous_repertoires_a_exclure = ["./temp", "./public", "./app"]

# Fonction pour déterminer l'encodage d'un fichier
def detecter_encodage(chemin_fichier):
    with open(chemin_fichier, 'rb') as fichier_binaire:
        resultat = chardet.detect(fichier_binaire.read())
    return resultat['encoding']

# Fonction pour parcourir le répertoire et ses sous-répertoires
def parcourir_repertoire(repertoire):
    contenu = ""
    for dossier, sous_dossiers, fichiers in os.walk(repertoire):
        if os.path.basename(dossier) not in sous_repertoires_a_exclure:
            contenu += f"Dossier: {dossier}\n"
            for fichier in fichiers:
                chemin_fichier = os.path.join(dossier, fichier)
                encodage = detecter_encodage(chemin_fichier)
                try:
                    with open(chemin_fichier, 'r', encoding=encodage) as fichier_ouvert:
                        contenu += f"Fichier: {chemin_fichier}\n"
                        contenu += fichier_ouvert.read() + "\n\n"
                except UnicodeDecodeError:
                    contenu += f"Erreur de décodage pour le fichier: {chemin_fichier}\n\n"
    return contenu

# Appel de la fonction pour parcourir le répertoire
contenu_repertoire = parcourir_repertoire(repertoire_courant)

# Écriture du contenu dans le fichier de sortie
with open(nom_fichier_sortie, 'w', encoding='utf-8') as fichier_sortie:
    fichier_sortie.write(contenu_repertoire)

print(f"Le fichier '{nom_fichier_sortie}' a été créé avec succès.")


Fichier: ./index.php
<?php

require_once("./core/webapp.php");


// Create a new instance of the WebApplication class
$webApp = new WebApplication();

// Run the web application
$webApp->run();


Fichier: ./info.json
{
    "name": "phpaml",
    "version": "1.0.0",
    "description": "PHP Application with MVC Architecture",
    "scripts": {
      "start": "php -S localhost:8000"
    },
    "dependencies": {
      "php": "^7.0.0"
    }
  }
  

Dossier: ./app
Dossier: ./app\context
Fichier: ./app\context\CustomerContext.php
<?php

require_once './core/DatabaseManager.php';

class CustomerContext extends DatabaseManager
{
    public function __construct()
    {
        parent::__construct('host', 'username', 'password', 'dbname');
    }

    // Méthodes CRUD ici...

}


Fichier: ./app\context\PersonContext.php
<?php

require_once './core/DatabaseManager.php';

class PersonContext extends DatabaseManager
{
    public function __construct()
    {
        parent::__construct('host', 'username', 'password', 'dbname');
    }

    // Méthodes CRUD ici...

}


Fichier: ./app\context\RyanContext.php
<?php

require_once './core/DatabaseManager.php';

class RyanContext extends DatabaseManager
{
    public function __construct()
    {
        parent::__construct('host', 'username', 'password', 'dbname');
    }

    // Méthodes CRUD ici...

}


Dossier: ./app\controllers
Fichier: ./app\controllers\contactController.php
<?php

require_once("./core/controller.php");

/**
 * Controller for the Contact page.
 */
class ContactController extends Controller
{
    /**
     * Constructor for ContactController
     */
    public function __construct()
    {
        parent::__construct();
        $this->route("/contact", $this);
    }

    /**
     * Handles GET requests for the Contact page.
     */
    public function handleGet(): void
    {
        // Your logic for handling GET requests on the Contact page goes here
        // For example, you can set the view to display the Contact page content

        $this->setViewAndData("contact.php", ['name' => [$_GET['name'], $_GET['lastname']]]);
    }

    /**
     * Handles POST requests for the Contact page.
     */
    public function handlePost(): void
    {
        // Your logic for handling POST requests on the Contact page goes here
    }
}


Fichier: ./app\controllers\formController.php
<?php

require_once("./core/controller.php");

/**
 * Controller for the Contact page.
 */
class FormController extends Controller
{
    /**
     * Constructor for ContactController
     */
    public function __construct()
    {
        parent::__construct();
        $this->route("/form", $this);
    }

    /**
     * Handles GET requests for the Contact page.
     */
    public function handleGet(): void
    {
        // Your logic for handling GET requests on the Contact page goes here
        // For example, you can set the view to display the Contact page content

        //$this->setViewAndData("contact.php", ['name' => [$_GET['name'], $_GET['lastname']]]);
        $this->setViewAndData("form.php", ['age' => $_GET['age']]);
    }

    /**
     * Handles POST requests for the Contact page.
     */
    public function handlePost(): void
    {
        // Your logic for handling POST requests on the Contact page goes here
    }
}


Fichier: ./app\controllers\homeController.php
<?php

require_once("./core/controller.php");

/**
 * Controller for the home page.
 */
class HomeController extends Controller
{
    /**
     * Constructor for HomeController
     */
    public function __construct()
    {
        parent::__construct();
        $this->route("/", $this);
    }

    /**
     * Handles GET requests for the home page.
     */
    public function handleGet(): void
    {
        // Your logic for handling GET requests on the home page goes here
        // For example, you can set the view to display the home page content
        $this->setView("home.php");
    }

    /**
     * Handles POST requests for the home page.
     */
    public function handlePost(): void
    {
        // Your logic for handling POST requests on the home page goes here
    }
}


Fichier: ./app\controllers\messageController.php
<?php

require_once("./core/controller.php");

/**
 * Controller for the home page.
 */
class MessageController extends Controller
{
    /**
     * Constructor for HomeController
     */
    public function __construct()
    {
        parent::__construct();
        $this->route("/message", $this);
    }

    /**
     * Handles GET requests for the home page.
     */
    public function handleGet(): void
    {
        // Your logic for handling GET requests on the home page goes here
        // For example, you can set the view to display the home page content
        $this->setViewAndData("message.php", ["person" => ["age" => 10, "nom" => "clement"]]);
    }

    /**
     * Handles POST requests for the home page.
     */
    public function handlePost(): void
    {
        // Your logic for handling POST requests on the home page goes here
    }
}


Fichier: ./app\controllers\testController.php
<?php

require_once("./core/controller.php");
require_once("./app/models/etudiant.php");

/**
 * Controller for the home page.
 */
class TestController extends Controller
{
    /**
     * Constructor for HomeController
     */
    public function __construct()
    {
        parent::__construct();
        $this->route("/test", $this);
    }

    /**
     * Handles GET requests for the home page.
     */
    public function handleGet(): void
    {
        $person = new Person("Toto");
        // Your logic for handling GET requests on the home page goes here
        // For example, you can set the view to display the home page content
        $this->setViewAndData("test.php", ["person" => $person]);
    }

    /**
     * Handles POST requests for the home page.
     */
    public function handlePost(): void
    {
        $person = new Person($_POST['nom']);
        $this->setViewAndData("test.php", ["person" => $person]);
        // Your logic for handling POST requests on the home page goes here
    }
}


Dossier: ./app\models
Fichier: ./app\models\customer.php
<?php

class Customer
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private DateTimeImmutable $registrationDate;

    public function __construct(int $id, string $firstName, string $lastName, string $email, DateTimeImmutable $registrationDate)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->registrationDate = $registrationDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRegistrationDate(): DateTimeImmutable
    {
        return $this->registrationDate;
    }

    public function __toString(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}


Fichier: ./app\models\etudiant.php
<?php

class Person
{
    private string $name;

    public function __construct(string $name = "Inc")
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}


Fichier: ./app\models\ryan.php
<?php


class Ryan
{
    private int $age;
    private string $name;
}


Dossier: ./app\public
Dossier: ./app\views
Fichier: ./app\views\contact.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Contact</h1>

    <?php

    print_r($name)

    ?>
</body>

</html>

Fichier: ./app\views\form.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Form


        <?php
        print_r($age);

        ?>
    </h1>
</body>

</html>

Fichier: ./app\views\home.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Home</h1>

</body>

</html>

Fichier: ./app\views\message.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Message</h1>

    <p><?php
        print_r($person);
        ?></p>
</body>

</html>

Fichier: ./app\views\test.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>test</h1>
    <?php

    print_r($person);
    ?>
    <form method="post" action="test">
        <input type="text" name="name">
        <input type="submit" value="Envoyer">
    </form>

</body>

</html>

Dossier: ./configs
Fichier: ./configs\conf.controllers.php
<?php
// Recursive function to include all files in a directory and its subdirectories
function includeAllControllers($directory)
{
    if (is_dir($directory)) {
        // Get a list of files and directories in the specified directory
        $items = scandir($directory);
        foreach ($items as $item) {
            if ($item != '.' && $item != '..') {
                $path = $directory . '/' . $item;
                if (is_dir($path)) {
                    includeAllControllers($path); // Recursive call if it's a subdirectory
                } else {
                    if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                        // Include only PHP files
                        require_once $path;

                        // Extract the class name from the file name
                        $class_name = ucfirst(pathinfo($item, PATHINFO_FILENAME));

                        // Check if the class exists
                        if (class_exists($class_name)) {
                            // Create an instance of the class (if needed)
                            $instance = new $class_name();
                            unset($instance); // Clean up the instance if not used
                        }
                    }
                }
            }
        }
    }
}


Dossier: ./core
Fichier: ./core\contextGenerator.php
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


Fichier: ./core\controller.php
<?php
require_once("./core/router.php");

/**
 * Controller - The base class for handling HTTP requests and responses.
 */
class Controller
{
    protected string $view; // The name of the view to be displayed
    private array $viewData = []; // Data to pass to the view

    /**
     * Constructor for the Controller class
     */
    protected function __construct()
    {
    }

    /**
     * Handles GET requests.
     */
    public function handleGet(): void
    {
        // Code to handle GET requests goes here
    }

    /**
     * Handles POST requests.
     */
    public function handlePost(): void
    {
        // Code to handle POST requests goes here
    }

    /**
     * Returns the name of the current view to be displayed.
     *
     * @return string The name of the view to be displayed
     */
    public function getViewName(): string
    {
        return $this->view;
    }

    /**
     * Sets the name of the view to be displayed.
     *
     * @param string $newViewName The new name of the view to be displayed
     */
    public function setView(string $newView): void
    {
        $this->view = $newView;
    }

    /**
     * Handles routing to a specific controller.
     *
     * @param string $url The URL to route
     * @param Controller $destinationController The destination controller
     */
    protected function route(string $url, Controller $destinationController): void
    {
        Router::route($url, $destinationController);
    }

    /**
     * Sets the name of the view to be displayed and the data to pass to it.
     *
     * @param string $newView The new name of the view to be displayed
     * @param array $newViewData Data to pass to the view
     */
    public function setViewAndData(string $newView, array $newViewData): void
    {
        $this->view = $newView;
        $this->viewData = $newViewData;
    }

    /**
     * Generates the content of the current view.
     *
     * @return string The content of the view
     */
    public function generateViewContent(): string
    {
        // Check if the view file exists
        $viewFilePath = './app/views/' . $this->view;
        if (file_exists($viewFilePath)) {
            // Extract data to make it accessible in the view file
            ob_start();
            extract($this->viewData);

            // Load data into the view
            include $viewFilePath;
            return ob_get_clean();
        } else {
            // Handle the case where the view file doesn't exist
            return "File " . $this->view . " not found (Error 404).";
        }
    }
}


Fichier: ./core\cookieManager.php
<?php

// Fichier : ./core/CookieManager.php

class CookieManager
{
    /**
     * Définit un cookie.
     *
     * @param string $name    Nom du cookie.
     * @param mixed  $value   Valeur du cookie.
     * @param int    $expire  Date d'expiration du cookie (timestamp).
     * @param string $path    Chemin où le cookie est disponible.
     * @param string $domain  Domaine où le cookie est disponible.
     * @param bool   $secure  Indique si le cookie doit être sécurisé (HTTPS).
     * @param bool   $httponly Indique si le cookie doit être accessible uniquement via HTTP.
     */
    public static function set($name, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * Récupère la valeur d'un cookie.
     *
     * @param string $name     Nom du cookie.
     * @param mixed  $default  Valeur par défaut à retourner si le cookie n'est pas défini.
     *
     * @return mixed Valeur du cookie ou la valeur par défaut si le cookie n'est pas défini.
     */
    public static function get($name, $default = null)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default;
    }

    /**
     * Supprime un cookie.
     *
     * @param string $name Nom du cookie à supprimer.
     */
    public static function delete($name)
    {
        if (isset($_COOKIE[$name])) {
            // Réinitialise le cookie avec une date d'expiration passée pour le supprimer
            setcookie($name, '', time() - 3600, '/');
            unset($_COOKIE[$name]);
        }
    }
}


Fichier: ./core\databaseManager.php
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


Fichier: ./core\router.php
<?php
require_once("./core/controller.php");

/**
 * Router - A class for routing and handling HTTP requests.
 */
class Router
{
    private string $basePath; // The base path of the application
    private static array $routes = []; // Associative array to store routes and controllers

    /**
     * Constructor for the Router class.
     */
    public function __construct()
    {
        // Set the base path of the application based on the URL structure
        $this->basePath = '/' . explode('/', $_SERVER['REQUEST_URI'])[1] . '/';
    }

    /**
     * Define a route and associate it with a controller.
     *
     * @param string $url The URL path to associate with the controller
     * @param Controller $controller The controller to associate with the URL
     */
    public static function route(string $url, Controller $controller): void
    {
        $url = rtrim($url, '/');
        self::$routes[$url] = $controller;
    }

    /**
     * Configure the router and handle incoming requests.
     */
    public function configuration(): void
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = $this->removeBasePath($url);
        $url = $this->processQueryString($url);

        $url = rtrim($url, '/');

        if (isset(self::$routes[$url])) {
            $controller = self::$routes[$url];

            $this->handleRequestMethod($controller);
            $this->cancelRequest();
            echo $controller->generateViewContent();
        } else {
            $this->show404Error();
        }
    }

    /**
     * Remove the base path from the URL.
     *
     * @param string $url The original URL
     * @return string The URL with the base path removed
     */
    private function removeBasePath(string $url): string
    {
        return str_replace($this->basePath, '/', $url);
    }

    /**
     * Process the query string and populate the $_GET array.
     *
     * @param string $url The URL to process
     * @return string The URL without the query string
     */
    private function processQueryString(string $url): string
    {
        $queryString = '';

        if (strpos($url, '?') !== false) {
            list($url, $queryString) = explode('?', $url, 2);
        }

        parse_str($queryString, $queryParameters);

        foreach ($queryParameters as $key => $value) {
            $_GET[$key] = urldecode($value);
        }

        return $url;
    }

    /**
     * Handle the request method (GET or POST) for the associated controller.
     *
     * @param Controller $controller The controller to handle the request
     */
    private function handleRequestMethod(Controller $controller): void
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $controller->handleGet();
                break;
            case 'POST':
                $controller->handlePost();
                break;
            default:
                // Handle other methods if necessary
                break;
        }
    }

    /**
     * Cancel the request by resetting $_GET and $_POST arrays.
     */
    private function cancelRequest(): void
    {
        $_GET = null;
        $_POST = null;
    }

    /**
     * Show a 404 error response.
     */
    private function show404Error(): void
    {
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
    }
}


Fichier: ./core\sessionManager.php
<?php


class SessionManager
{
    /**
     * Démarre ou reprend une session.
     */
    public static function start()
    {
        session_start();
    }

    /**
     * Enregistre une variable de session.
     *
     * @param string $key   Clé de la variable de session.
     * @param mixed  $value Valeur de la variable de session.
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Récupère une variable de session.
     *
     * @param string $key     Clé de la variable de session.
     * @param mixed  $default Valeur par défaut à retourner si la variable n'est pas définie.
     *
     * @return mixed Valeur de la variable de session ou la valeur par défaut si elle n'est pas définie.
     */
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Supprime une variable de session.
     *
     * @param string $key Clé de la variable de session à supprimer.
     */
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Détruit la session en cours.
     */
    public static function destroy()
    {
        session_destroy();
    }
}


Fichier: ./core\webapp.php
<?php

require_once("./core/router.php");
require_once("./configs/conf.controllers.php");
includeAllControllers("./app/controllers");

/**
 * WebApplication - Main class for running the web application.
 */
class WebApplication
{
    private Router $router; // Router instance for handling requests

    /**
     * Constructor for the WebApplication class.
     */
    public function __construct()
    {
        // Initialize any necessary data here
        // Create an instance of the Router and perform routing
        $this->router = new Router();
    }

    /**
     * Run the web application by configuring the router.
     */
    public function run(): void
    {
        $this->router->configuration();
    }
}


Dossier: ./data
Dossier: ./temp
Fichier: ./temp\.DS_Store
   Bud1           
                                                           r o l l e r                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           c o n t r o l l e r slg1Scomp      K    c o n t r o l l e r smoDDblob      Z³ÍÄA    c o n t r o l l e r smodDblob      Z³ÍÄA    c o n t r o l l e r sph1Scomp      @     m o d e l slg1Scomp      2    m o d e l smoDDblob      ®eÍÄA    m o d e l smodDblob      ®eÍÄA    m o d e l sph1Scomp           m o d u l e slg1Scomp      "-    m o d u l e smoDDblob      ËðbÅA    m o d u l e smodDblob      ËðbÅA    m o d u l e sph1Scomp      p     p u b l i clg1Scomp          p u b l i cmoDDblob   …¬’ÊÂcÅA    p u b l i cmodDblob   …¬’ÊÂcÅA    p u b l i cph1Scomp            v i e w slg1Scomp      #    v i e w smoDDblob   -“ÊÂcÅA    v i e w smodDblob   -“ÊÂcÅA    v i e w sph1Scomp      À                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   @      €                                        @      €                                          @      €                                          @                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   E  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       DSDB                                 `          €                                         @      €                                          @      €                                          @                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              

Fichier: ./temp\.htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [NC,L]

Fichier: ./temp\appsetting.php
<?php
include_once './controllers/controllerHome.php';
include_once './controllers/controllerTest.php';
include_once './controllers/controllerContact.php';
include_once './controllers/controllerFormulaire.php';

class ApplicationSetting
{
    private ArrayObject $routes;

    /**
     * Constructor to initialize the class and configure the routes.
     */
    public function __construct()
    {
        $this->routes = new ArrayObject();
        $this->configuration();
    }

    /**
     * Function to configure the routes.
     * 
     * @param void
     * @return void
     */
    private function configuration(): void
    {
        // TODO
        $this->routes['/'] = new ControllerHome('home');
        $this->routes['/home'] = new ControllerHome('home');
        $this->routes['/test'] = new ControllerTest('test');
        $this->routes['/contact'] = new ControllerContact('contact');
        $this->routes['/formulaire'] = new ControllerFormulaire('formulaire');
    }

    /**
     * Function to get the appropriate view based on the given route.
     * 
     * @param string $route The route for which the view is requested.
     * @return BaseController Returns an instance of the BaseController.
     */
    public function getView(string $route): BaseController
    {
        if ($this->routes->offsetExists($route)) {
            return $this->routes[$route];
        }
        return BaseController::ERROR();
    }
}


Fichier: ./temp\index.php
<?php

include_once './modules/bin/webapp.php';

$app = new WebApplication();
$app->getHeader();
$app->redirectionDefault('Home Page', '/mvc/home');
$app->run();


Fichier: ./temp\readme.md
https://www.youtube.com/watch?v=Q9PZXoe-aAE


Dossier: ./temp\controllers
Fichier: ./temp\controllers\controllerContact.php
<?php
include_once './modules/controller.php';
class ControllerContact extends BaseController
{
    public function __construct(string $view)
    {
        parent::__construct($view);
    }
    public function handlePost(): void
    {
        $et = new Etudiant();
        $et->setNom('Marte');

        parent::setResponse('etudiant', parent::getParam('idi'));
    }
}


Fichier: ./temp\controllers\controllerFormulaire.php
<?php
include_once './modules/controller.php';
require_once './models/etudiant.php';
class ControllerFormulaire extends BaseController
{
    public function __construct(string $view)
    {
        parent::__construct($view);
    }

    public function handleGet(): void
    {
        $et = new Etudiant();
        $et->setNom(parent::getParam('etudiant'));
        parent::setResponse('etudiant', $et);
    }

    public function handlePost(): void
    {
        $et = new Etudiant();
        $et->setNom(parent::getParam('etudiant'));

        parent::setResponse('etudiant', $et);
    }
}


Fichier: ./temp\controllers\controllerHome.php
<?php
include_once './modules/controller.php';
class ControllerHome extends BaseController
{
    public function __construct(string $view)
    {
        parent::__construct($view);
    }

    public function handlePost(): void
    {
    }
}


Fichier: ./temp\controllers\controllerTest.php
<?php
include_once './modules/controller.php';
require_once './models/etudiant.php';

class ControllerTest extends BaseController
{
    public function __construct(string $view)
    {
        parent::__construct($view);
    }

    public function handleGet(): void
    {
        $et = new Etudiant();
        $et->setNom('Marte');

        parent::setResponse('etudiant', parent::getParam('id'));
    }

    public function handlePost(): void
    {
        $et = new Etudiant();
        $et->setNom('Marte');

        parent::setResponse('etudiant', parent::getParam('nom'));
    }
}


Dossier: ./temp\models
Fichier: ./temp\models\etudiant.php
<?php

class Etudiant
{
    private string $nom;

    public function __construct()
    {
        $this->nom = 'INCONNU';
    }

    public function getNom(): string
    {
        return $this->nom;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
}


Dossier: ./temp\modules
Fichier: ./temp\modules\controller.php
<?php
 

/**
 * The base class for controllers.
 * This class handles HTTP requests and responses.
 */
class BaseController
{
    protected HttpResponse $response; // HTTP response object
    protected HttpRequest $request; // HTTP request object
    protected string $view; // The view to be displayed

    /**
     * Constructor for BaseController class
     *
     * @param string $view The view to be displayed
     */
    protected function __construct(string $view)
    {
        $this->view = $view;
        $this->response = new HttpResponse();
        $this->request = new HttpRequest();
    }

    /**
     * Handles GET requests
     */
    public function handleGet(): void
    {
    }

    /**
     * Handles POST requests
     */
    public function handlePost(): void
    {
    }

    /**
     * Returns the view to be displayed
     *
     * @return string The view to be displayed
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * Adds an attribute to the HTTP response
     *
     * @param string $key The name of the attribute
     * @param mixed $data The value of the attribute
     */
    public function setResponse(string $key, $data)
    {
        $this->response->setAttribute($key, $data);
    }

    /**
     * Returns the HTTP response object
     *
     * @return HttpResponse The HTTP response object
     */
    public function getResponse(): HttpResponse
    {
        return $this->response;
    }

    /**
     * Returns the value of an HTTP request parameter
     *
     * @param string $name The name of the parameter
     * @return mixed The value of the parameter
     */
    public function getParam($name)
    {
        return $this->request->getParam($name);
    }

    /**
     * Returns an instance of BaseController with a 404 view
     *
     * @return BaseController An instance of BaseController with a 404 view
     */
    public static function ERROR(): BaseController
    {
        return new BaseController('404');
    }
}


Dossier: ./temp\modules\bin
Fichier: ./temp\modules\bin\body.php
<?php

require_once './appsetting.php';


class Body
{

    public static function Render()
    {


        $url = $_SERVER['REQUEST_URI'];


        if (strpos($url, '?')) {
            $cut = explode('?', $url);
            $_GET['url'] = [$cut[0], $cut[1]];
            $url = $cut[0];
        }

        $site = explode('/', $url);
        $basePath = '/' . $site[1] . '/';
        function getAction($basePath)
        {
            $urlAction = $_SERVER['REQUEST_URI'];
            $path = parse_url($urlAction, PHP_URL_PATH);
            $action = rtrim($path, '/');

            if (strpos($action, $basePath) === 0) {
                $action = substr($action, strlen($basePath));
            }
            $action = '/' . $action;
            return $action;
        }


        $app = new ApplicationSetting();

        // Suppression de la partie du chemin correspondant au nom du site

        if (strpos($url, $basePath) === 0) {
            $url = substr($url, strlen($basePath));
        }


        $lastChar = substr($url, -1);
        if ($lastChar == '/') {
            $url = substr($url, 0, -1);
        }

        // Ajout de l'extension ".php" pour obtenir le nom de fichier
        $controller = $app->getView('/' . $url);
        $filename =  './views/' . $controller->getView() . '.php';



        // Affichage de la page demandÃ©e, ou erreur 404 si le fichier n'existe pas
        if (file_exists($filename)) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $controller->handleGet();
                    break;
                case 'POST':
                    $actionRoute = getAction($basePath);
                    $controller = $app->getView($actionRoute);
                    $controller->handlePost();
                    break;
                default:
                    //print_r($_SERVER['REQUEST_METHOD']);
                    break;
            }

            $response = $controller->getResponse();
            include $filename;
        } else {
            header("HTTP/1.0 404 Not Found");
            include  './views/404.php';
        }
    }
}


Fichier: ./temp\modules\bin\header.php
<?php

#variable permetant de definir les entete.
$ViewData = [];


Fichier: ./temp\modules\bin\request.php
<?php


class HttpRequest
{
    private array $post;
    private array $get;

    public function __construct()
    {
        $this->post = array();
        $this->get = array();
        $this->post = array_merge($this->post, $_POST);
        $this->get = array_merge($this->get, $_GET);
    }

    public function getParam($key): string
    {
        $param = $this->controlRequest();
        if (!array_key_exists($key, $param)) {
            return 'UNDEFINED KEY ERROR';
        }
        return $param[$key];
    }

    private function controlRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->formatageGet();
            return $this->get;
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->post;
        }
    }

    private function formatageGet()
    {
        if (gettype($_GET['url']) === 'array') {
            $content = $_GET['url'];
            $param = $content[1];
            if (strpos($param, '&')) {
                $param = explode('&', $param);
                foreach ($param as $value) {
                    $element = $this->create_array($value, '=');
                    $this->get[$element[0]] = $element[1];
                }
            } else {

                $param = $this->create_array($param, '=');
                $this->get[$param[0]] = $param[1];
            }
        }
    }

    private function create_array($str, $element)
    {
        $i_index = strpos($str, $element);
        $result = array(substr($str, 0, $i_index));
        if ($i_index + 1 < strlen($str)) {
            array_push($result, substr($str, $i_index + 1));
        }
        return $result;
    }
}


Fichier: ./temp\modules\bin\response.php
<?php

class HttpResponse
{
    private ArrayObject $data;

    public function __construct()
    {
        $this->data = new ArrayObject();
    }

    public function setAttribute($name, $data)
    {

        $this->data[$name] = $data;
    }

    public function getAttribute($name)
    {
        return $this->data[$name];
    }
}


Fichier: ./temp\modules\bin\router.php
<?php
require_once './appsetting.php';




$url = $_SERVER['REQUEST_URI'];


if (strpos($url, '?')) {
    $cut = explode('?', $url);
    $_GET['url'] = [$cut[0], $cut[1]];
    $url = $cut[0];
}

$site = explode('/', $url);
$basePath = '/' . $site[1] . '/';
function getAction($basePath)
{
    $urlAction = $_SERVER['REQUEST_URI'];
    $path = parse_url($urlAction, PHP_URL_PATH);
    $action = rtrim($path, '/');

    if (strpos($action, $basePath) === 0) {
        $action = substr($action, strlen($basePath));
    }
    $action = '/' . $action;
    return $action;
}


$app = new ApplicationSetting();

// Suppression de la partie du chemin correspondant au nom du site

if (strpos($url, $basePath) === 0) {
    $url = substr($url, strlen($basePath));
}


$lastChar = substr($url, -1);
if ($lastChar == '/') {
    $url = substr($url, 0, -1);
}

// Ajout de l'extension ".php" pour obtenir le nom de fichier
$controller = $app->getView('/' . $url);
$filename =  './views/' . $controller->getView() . '.php';



// Affichage de la page demandÃ©e, ou erreur 404 si le fichier n'existe pas
if (file_exists($filename)) {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $controller->handleGet();
            break;
        case 'POST':
            $actionRoute = getAction($basePath);
            $controller = $app->getView($actionRoute);
            $controller->handlePost();
            break;
        default:
            //print_r($_SERVER['REQUEST_METHOD']);
            break;
    }

    $response = $controller->getResponse();
    include $filename;
} else {
    header("HTTP/1.0 404 Not Found");
    include  './views/404.php';
}


Fichier: ./temp\modules\bin\webapp.php
<?php

class WebApplication
{

    private string $route;

    public function __construct()
    {
        $home = null;
    }

    public function getHeader(): void
    {
        require_once './modules/bin/header.php';
    }

    public function redirectionDefault(string $title, string $route): void
    {
        $ViewData['title'] = $title;
        $this->route = $route;
    }

    public function run()
    {
        include './views/shared/_layout.php';
    }
}


Dossier: ./temp\public
Fichier: ./temp\public\.DS_Store
   Bud1           	                                                          1Scomp                                                                                                                                                                                                                                                                                                                                                                                                                                                 c s slg1Scomp            c s smoDDblob      ØJÌÄA    c s smodDblob      ØJÌÄA    c s sph1Scomp            i m glg1Scomp            i m gmoDDblob      ÜJÌÄA    i m gmodDblob      ÜJÌÄA    i m gph1Scomp            j slg1Scomp            j smoDDblob      ÔJÌÄA    j smodDblob      ÔJÌÄA    j sph1Scomp            l i blg1Scomp            l i bmoDDblob      åJÌÄA    l i bmodDblob      åJÌÄA    l i bph1Scomp                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  @      €                                        @      €                                          @      €                                          @                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   E  	                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       DSDB                                 `          €                                         @      €                                          @      €                                          @                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              

Dossier: ./temp\public\css
Dossier: ./temp\public\img
Dossier: ./temp\public\js
Dossier: ./temp\public\lib
Dossier: ./temp\temp
Fichier: ./temp\temp\attribute.php
<?php

class HttpAttribute
{
    private array $attributes = [];

    public function setAttribute(string $name, $data): void
    {
        $this->attributes[$name] = $data;
    }

    public function getAttribute(string $name, $default = null)
    {
        return $this->attributes[$name] ?? $default;
    }

    public function hasAttribute(string $name): bool
    {
        return array_key_exists($name, $this->attributes);
    }

    public function removeAttribute(string $name): void
    {
        if ($this->hasAttribute($name)) {
            unset($this->attributes[$name]);
        }
    }

    public function getAllAttributes(): array
    {
        return $this->attributes;
    }
}


Fichier: ./temp\temp\request.php
<?php

class Request
{
    private array $postData;
    private array $getData;

    public function __construct()
    {
        $this->postData = $_POST;
        $this->getData = $_GET;
        $this->sanitizeData();
    }

    public function getParam(string $key): string
    {
        if (array_key_exists($key, $this->getData)) {
            return $this->getData[$key];
        } elseif (array_key_exists($key, $this->postData)) {
            return $this->postData[$key];
        } else {
            return 'UNDEFINED KEY ERROR';
        }
    }

    private function sanitizeData()
    {
        // Sanitize data in $_GET and $_POST arrays if needed
        $this->getData = $this->sanitizeArray($this->getData);
        $this->postData = $this->sanitizeArray($this->postData);
    }

    private function sanitizeArray(array $data): array
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) {
            $sanitizedKey = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            $sanitizedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $sanitizedData[$sanitizedKey] = $sanitizedValue;
        }
        return $sanitizedData;
    }
}


Dossier: ./temp\views
Fichier: ./temp\views\.DS_Store
   Bud1           	                                                           u t slg1Sco                                                                                                                                                                                                                                                                                                                                                                                                                                           l a y o u t slg1Scomp       L    l a y o u t smoDDblob      ÄHÌÄA    l a y o u t smodDblob      ÄHÌÄA    l a y o u t sph1Scomp           p a r t i a l slg1Scomp       ¡    p a r t i a l smoDDblob      ¼HÌÄA    p a r t i a l smodDblob      ¼HÌÄA    p a r t i a l sph1Scomp            s h a r e dlg1Scomp      w    s h a r e dmoDDblob      “VÏÄA    s h a r e dmodDblob      “VÏÄA    s h a r e dph1Scomp                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          @      €                                        @      €                                          @      €                                          @                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   E  	                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       DSDB                                 `          €                                         @      €                                          @      €                                          @                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              

Fichier: ./temp\views\404.php
<div>
    <h2>Error : 404</h2>
</div>

Fichier: ./temp\views\contact.php
<h2>Contact</h2>

Fichier: ./temp\views\formulaire.php
<form method="post" action="test">
    <p>Donnee : <?php print_r($response->getAttribute('etudiant')) ?></p>
    <label for="n">
        <p>Nom</p>
        <input id="n" type="text" name="nom">
    </label>
    <input type="submit" value="Envoyer">
</form>

Fichier: ./temp\views\home.php
<h2>Bonjour les amis</h2>

Fichier: ./temp\views\test.php
<div>
    <p>TEst</p>
    <?php
    print_r($response->getAttribute('etudiant'));
    ?>
</div>

Dossier: ./temp\views\layouts
Fichier: ./temp\views\layouts\main.php
<main>
    <?php
    include('./modules/bin/router.php');
    ?>
</main>

Dossier: ./temp\views\partials
Fichier: ./temp\views\partials\footer.php
<footer>
    <p>&copy; Architecture AML</p>
</footer>

Fichier: ./temp\views\partials\header.php
<header>
    <h2>Header</h2>
    <p>ceci est un lien : <a href="test?id=45">Click moi</a></p>
</header>

Dossier: ./temp\views\shared
Fichier: ./temp\views\shared\404.php
<div>
    <h2>Error : 404</h2>
</div>

Fichier: ./temp\views\shared\_layout.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ViewData['title'] ?></title>
</head>

<body>
    <div>
        <?php
        include('./views/partials/header.php');
        ?>
    </div>
    <div>
        <?php
        include('./views/layouts/main.php');
        ?>
    </div>
    <div>
        <?php
        include('./views/partials/footer.php');
        ?>
    </div>
</body>

</html>

