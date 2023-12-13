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
