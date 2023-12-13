<?php
include_once './modules/controller.php';
class ControllerContact extends BaseController
{
    public function __construct(string $view)
    {
        parent::__construct($view);
    }
    public function handlePost(): void
    {
        $et = new Etudiant();
        $et->setNom('Marte');

        parent::setResponse('etudiant', parent::getParam('idi'));
    }
}
