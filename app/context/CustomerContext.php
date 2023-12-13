<?php

require_once './core/DatabaseManager.php';

class CustomerContext extends DatabaseManager
{
    public function __construct()
    {
        parent::__construct('host', 'username', 'password', 'dbname');
    }

    // Méthodes CRUD ici...

}
