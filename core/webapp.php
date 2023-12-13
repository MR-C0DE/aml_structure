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
