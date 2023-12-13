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
