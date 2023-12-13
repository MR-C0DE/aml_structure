<?php

class WebApplication
{

    private string $route;

    public function __construct()
    {
        $home = null;
    }

    public function getHeader(): void
    {
        require_once './modules/bin/header.php';
    }

    public function redirectionDefault(string $title, string $route): void
    {
        $ViewData['title'] = $title;
        $this->route = $route;
    }

    public function run()
    {
        include './views/shared/_layout.php';
    }
}
