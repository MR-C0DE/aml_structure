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
