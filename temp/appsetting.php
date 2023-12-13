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
