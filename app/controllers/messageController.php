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
