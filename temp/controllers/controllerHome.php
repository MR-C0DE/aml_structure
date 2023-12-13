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
