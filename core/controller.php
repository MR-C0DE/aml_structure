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
