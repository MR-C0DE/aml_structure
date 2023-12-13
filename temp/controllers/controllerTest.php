<?php
include_once './modules/controller.php';
require_once './models/etudiant.php';

class ControllerTest extends BaseController
{
    public function __construct(string $view)
    {
        parent::__construct($view);
    }

    public function handleGet(): void
    {
        $et = new Etudiant();
        $et->setNom('Marte');

        parent::setResponse('etudiant', parent::getParam('id'));
    }

    public function handlePost(): void
    {
        $et = new Etudiant();
        $et->setNom('Marte');

        parent::setResponse('etudiant', parent::getParam('nom'));
    }
}
