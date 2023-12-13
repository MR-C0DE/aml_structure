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



// Affichage de la page demandée, ou erreur 404 si le fichier n'existe pas
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
