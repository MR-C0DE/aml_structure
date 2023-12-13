<?php
include_once './modules/controller.php';
require_once './models/etudiant.php';
class ControllerFormulaire extends BaseController
{
    public function __construct(string $view)
    {
        parent::__construct($view);
    }

    public function handleGet(): void
    {
        $et = new Etudiant();
        $et->setNom(parent::getParam('etudiant'));
        parent::setResponse('etudiant', $et);
    }

    public function handlePost(): void
    {
        $et = new Etudiant();
        $et->setNom(parent::getParam('etudiant'));

        parent::setResponse('etudiant', $et);
    }
}
