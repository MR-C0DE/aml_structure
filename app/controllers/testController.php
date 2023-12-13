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
